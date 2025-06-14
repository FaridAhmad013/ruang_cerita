<?php

namespace App\Http\Controllers\Master;

use App\DataTables\KategoriPertanyaanDataTable;
use App\Helpers\AuthCommon;
use App\Helpers\ResponseConstant;
use App\Http\Controllers\Controller;
use App\Models\KategoriPertanyaan;
use Illuminate\Http\Request;

class KategoriPertanyaanController extends Controller
{
    private $module, $module_name, $service, $help_key, $folder, $allow;

    function __construct()
    {
        $this->module = 'kategori_pertanyaan';
        $this->module_name = 'Kategori Pertanyaan';
        $this->folder = 'master.kategori_pertanyaan';

    }

    public function index()
    {
        $user = AuthCommon::user() ?? null;
        if (!in_Array(@$user->role->role, ['Admin'])) abort('403');

        $allow = json_encode($this->allow);

        $group = "Master";
        $icon = "fas fa-th-large";
        $module = $this->module;
        $module_name = $this->module_name;
        return view('pages.' . $this->folder . '.list', compact('allow', 'group', 'icon', 'module', 'module_name'));
    }

    public function show($id)
    {
        try {
            $auth = AuthCommon::user() ?? null;
            $data = KategoriPertanyaan::where('id', $id)->first();
            if(!in_array($auth->role->role, ['Admin'])) {
                $body = '<h3>403 | Forbidden</h3>';
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
            }else{
                $body = view('pages.'.$this->folder.'.show', compact('data'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
            }

            return [
                'title' => 'Detail '.$this->module_name,
                'body' => $body,
                'footer' => $footer
            ];
        } catch (\Throwable $th) {
            //throw $th;

            return response([
                "status" => false,
                "message" => "Bad Request",
                "data" => [],
                "error" => $th->getMessage()
            ], 400);
        }
    }

    public function create()
    {
        $user = AuthCommon::user();
        if (!in_Array(@$user->role->role, ['Admin'])) {
            $body = '<h3>403 | Forbidden</h3>';
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        } else {
            $body = view('pages.' . $this->folder . '.create', [
                'module' => $this->module,
                'module_name' => $this->module_name,
                'folder' => $this->folder,
            ])->render();
            $footer = '<button type="button" class="btn btn-secondary text-responsive" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary text-responsive" onclick="save()">Simpan</button>';
        }

        return [
            'title' => $this->module_name,
            'body' => $body,
            'footer' => $footer
        ];
    }


    public function store(Request $request)
    {
        $rules = [
            'kategori' => 'required',
        ];

        $message = [
            'kategori.required' => 'Kolom Kategori tidak boleh kosong',
        ];
        $request->validate($rules, $message);

        $formData = $request->only([
            'kategori',
        ]);

        try {
            KategoriPertanyaan::create($formData);

            return response([
                'status' => true,
                'message' => ResponseConstant::RM_CREATE_SUCCESS
            ]);
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => ResponseConstant::RM_UPDATE_FAILED
            ], 400);
        }
    }

    public function edit($id)
    {
        try {
            $data = KategoriPertanyaan::findOrFail($id);

            $auth = AuthCommon::user() ?? null;
             if (!in_array(@$auth->role->role, ['Admin'])) {
                $body = '<h3>403 | Forbidden</h3>';
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
            } else {
                $body = view('pages.' . $this->folder . '.edit', [
                    'id' => $id,
                    'data' => $data,
                    'folder' => $this->folder,
                    'module' => $this->module,
                    'module_name' => $this->module_name,
                ])->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="save()">Simpan</button>';
            }

            return [
                'title' => 'Edit ' . $this->module_name,
                'body' => $body,
                'footer' => $footer
            ];
        } catch (\Throwable $th) {
            return response([
                "status" => false,
                "message" => "Bad Request",
                "data" => [],
                "error" => $th->getMessage()
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $auth = AuthCommon::user() ?? null;
        if (!in_array(@$auth->role->role, ['Admin'])) {
            return response([
                'status' => false,
                'message' => '403 | Forbidden'
            ], 400);
        }

        $rules = [
            'kategori' => 'required',
        ];

        $message = [
            'kategori.required' => 'Kolom Kategori tidak boleh kosong',
        ];

        $request->validate($rules, $message);

        $formData = $request->only([
            'kategori',
        ]);

        try {
            KategoriPertanyaan::where('id', $id)->update($formData);

            return response([
                "status" => true,
                "message" => ResponseConstant::RM_UPDATE_SUCCESS,
                "data" => isset($run->data) ? $run->data : null
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
             return response([
                "status" => false,
                "message" => ResponseConstant::RM_UPDATE_FAILED,
                "data" => []
            ], 400);
        }

    }

    public function destroy($id)
    {
        $auth = AuthCommon::user() ?? null;
        if (!in_array(@$auth->role->role, ['Admin'])) {
            return response([
                'status' => false,
                'message' => '403 | Forbidden'
            ], 400);
        }

        try {
            KategoriPertanyaan::where('id', $id)->delete();

            return response([
                'status' => true,
                'message' => ResponseConstant::RM_DELETE_SUCCESS
            ]);
        } catch (\Throwable $th) {
            return response([
                "status" => false,
                "message" => ResponseConstant::RM_DELETE_FAILED,
                "error" => $th->getMessage()
            ], 400);
        }
    }

    public function select2(Request $request){
        try {
            $limit = $request->limit;
            $start = $limit * ($request->page - 1);

            $term = isset($request->term) ? strtolower($request->term) : '';

            $data = KategoriPertanyaan::orderBy('created_at', 'asc');

            if($term){
                $data->where(function($query) use($term){
                    $query->whereRaw('LOWER(kategori) LIKE ?', ['%'.strtolower($term).'%']);
                });
            }

            $res['items'] = [];
            $res['total'] = $data->count();
            $res['page'] = $request->page;

            if (isset($data)) {
                $res['items'] = $data->offset($start)
                    ->limit($limit)
                    ->get()->toArray();
            }

            return $res;
        } catch (\Throwable $th) {
            return response()->json([
                "items" => [],
                "total" => 0
            ]);
        }
    }

    public function datatable(KategoriPertanyaanDataTable $dataTable){
        return $dataTable->render('datatable');
    }
}

<?php

namespace App\Http\Controllers\Manajamen;

use App\DataTables\UserDataTable;
use App\Helpers\AuthCommon;
use App\Helpers\ResponseConstant;
use App\Helpers\Util;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $module, $module_name, $service, $help_key, $folder, $allow;

    function __construct()
    {
        $this->module = 'user';
        $this->module_name = 'Pengguna';
        $this->folder = 'manajemen.user';

    }

    public function index()
    {
        $user = AuthCommon::user() ?? null;
        if (!in_Array(@$user->role->role, ['Admin'])) abort('403');

        $allow = json_encode($this->allow);

        $group = "Manajemen";
        $icon = "fas fa-users";
        $module = $this->module;
        $module_name = $this->module_name;
        return view('pages.' . $this->folder . '.list', compact('allow', 'group', 'icon', 'module', 'module_name'));
    }

    public function show($id)
    {
        try {
            $auth = AuthCommon::user() ?? null;
            $data = User::where('id', $id)->with('role')->first();
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
            'username' => 'required|unique:users|regex:/^(?!.*[_.]{2})(?![_.])[a-zA-Z0-9._]{3,20}(?<![_.])$/',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role_id' => 'required'

        ];

        $message = [
            'username.required' => 'Kolom Username tidak boleh kosong',
            'username.unique' => 'Username sudah digunakan',
            'username.regex' => 'Username hanya boleh berisi huruf, angka, titik, dan underscore tanpa simbol berurutan atau di awal/akhir.',
            'nama_depan.required' => 'Kolom Nama Depan tidak boleh kosong',
            'nama_belakang.required' => 'Kolom Nama Belakang tidak boleh kosong',
            'email.required' => 'Kolom Email tidak boleh kosong',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Kolom Password tidak boleh kosong',
            'password.confirmed' => 'Kolom Password tidak sama',
            'role_id.required' => 'Kolom Role tidak boleh kosong'
        ];
        $request->validate($rules, $message);

        if(!Util::isPasswordValid($request->password, $request->username)){
            return response([
                'status' => false,
                'message' => 'Password harus terdiri dari setidaknya satu angka (0-9), satu huruf kecil (a-z), satu huruf besar (A-Z), satu karakter khusus (@, #, $, %, ^, &, +, =, !), setidaknya berjumlah 8 dan tidak mengandung username'
            ], 400);
        }

        $formData = $request->only([
            'username',
            'nama_depan',
            'nama_belakang',
            'email',
            'password',
        ]);

        $formData['password'] = bcrypt($formData['password']);
        $formData['status'] = '1';
        $formData['role_id'] = 2;

        try {
            User::create($formData);

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
            $data = User::with('role')->findOrFail($id);

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
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id), // <- ini bagian pentingnya
            ],
            'role_id' => 'required'
        ];

        $message = [
            'nama_depan.required' => 'Kolom Nama Depan tidak boleh kosong',
            'nama_belakang.required' => 'Kolom Nama Belakang tidak boleh kosong',
            'email.required' => 'Kolom Email tidak boleh kosong',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Kolom Password tidak boleh kosong',
            'password.confirmed' => 'Kolom Password tidak sama',
            'role_id.required' => 'Kolom Role tidak boleh kosong'
        ];

        $request->validate($rules, $message);

        $formData = $request->only([
            'nama_depan',
            'nama_belakang',
            'email',
            'role_id'
        ]);

        try {
            User::where('id', $id)->update($formData);

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

    public function change_status($id, Request $request)
    {
        $auth = AuthCommon::user() ?? null;
        if(!in_array(@$auth->role->role, ['Admin'])) {
            return response([
                'status' => false,
                'message' => '403 | Forbidden'
            ], 400);
        }
        $status = $request->blocked == 'true' ? 1 : 0;
        try {
            User::where('id', $id)->update([
                'status' => $status
            ]);

            return response([
                "status" => true,
                "message" => ResponseConstant::RM_UPDATE_SUCCESS,
            ]);
        } catch (\Throwable $th) {
            return response([
                "status" => false,
                "message" => ResponseConstant::RM_UPDATE_FAILED,
                "error" => $th->getMessage()
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
            User::where('id', $id)->delete();

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

    public function datatable(UserDataTable $dataTable){
        return $dataTable->render('datatable');
    }
}

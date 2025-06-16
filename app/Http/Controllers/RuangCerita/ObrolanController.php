<?php

namespace App\Http\Controllers\RuangCerita;

use App\Helpers\AuthCommon;
use App\Helpers\GeminiUtility;
use App\Helpers\ResponseConstant;
use App\Http\Controllers\Controller;
use App\Models\JawabanUser;
use App\Models\KategoriPertanyaan;
use App\Models\SesiJournal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ObrolanController extends Controller
{
    private $module, $module_name, $folder, $allow;

    function __construct()
    {
        $this->module = 'ruang_cerita.obrolan';
        $this->module_name = 'Obrolan';
        $this->folder = 'ruang_cerita.obrolan';

    }

    public function halaman_obrolan()
    {
        $user = AuthCommon::user() ?? null;
        if (!in_Array(@$user->role->role, ['Pengguna'])) abort('403');

        $allow = json_encode($this->allow);

        $group = "Master";
        $icon = "fas fa-comments";
        $module = $this->module;
        $module_name = $this->module_name;
        return view('pages.' . $this->folder . '.halaman_obrolan', compact('allow', 'group', 'user', 'icon', 'module', 'module_name'));
    }

    public function kirim_pesan(Request $request)
    {
        $rules = [
            'jawaban_user' => 'required',
            'sesi_jurnal_id' => 'required',
            'pertanyaan_label' => 'required',
        ];

        $message = [
            'jawaban_user.required' => 'Kolom Jawaban tidak boleh kosong',
            'sesi_jurnal_id.required' => 'Kolom Sesi Jurnal tidak boleh kosong',
            'pertanyaan_label.required' => 'Kolom Pertanyaan tidak boleh kosong',
        ];
        $request->validate($rules, $message);

        $formData = $request->only([
            'jawaban_user',
            'sesi_jurnal_id',
            'pertanyaan_label'
        ]);

        $formData['user_id'] = AuthCommon::user()->id;

        try {
            $jawaban_user = JawabanUser::create($formData);
            return response([
                'status' => true,
                'message' => ResponseConstant::RM_CREATE_SUCCESS,
                'data' => [
                    'sesi_jurnal_id' => $jawaban_user->sesi_jurnal_id,
                    'jawaban_user' => $jawaban_user->jawaban_user
                ]
            ]);
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => ResponseConstant::RM_UPDATE_FAILED,

            ], 400);
        }
    }

    public function mulai_sesi_journal(){
        $pertanyaan_harian = [];
        try {
            $theme = @AuthCommon::user()->theme ?? null;
            $user_id = @AuthCommon::user()->id ?? null;
            $pertanyaan_harian = GeminiUtility::get_pertanyaan_harian($theme);
            $sesi_jurnal = SesiJournal::where('user_id', $user_id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->create([
                'user_id' => $user_id,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'kumpulan_pertanyaan' => json_encode($pertanyaan_harian),
                'status' => 'BERJALAN'
            ]);

            return response([
                'status' => true,
                'message' => 'Berhasil memulai sesi journal',
                'id' => $sesi_jurnal->id
            ]);
        }catch(ModelNotFoundException $e){
            return response([
                'status' => false,
                'message' => ResponseConstant::RM_INTERNAL_ERROR,
                'error' => $e->getMessage()
            ],
            400);

        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => 'Gagal menghubungkan partner ai, silahkan coba lagi',
                'error' => $th->getMessage()
            ], 400);
        }
    }

    public function check_status_sesi_journal(){
        try {
            $result = SesiJournal::where('user_id', AuthCommon::user()->id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->first();

            $status_sesi_journal = 'BELUM_DIMULAI';
            if($result){
               $status_sesi_journal = $result->status;
            }

            return response([
                'status' => true,
                'data' => [
                    'status_sesi_journal' => $status_sesi_journal,
                    'id' => @$result->id
                ],
                'message' => 'Sukses'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'status' => false,
                'message' => ResponseConstant::RM_INTERNAL_ERROR
            ], 400);
        }
    }

    public function get_pertanyaan_jawaban($sesi_journal_id){
        try {
            $sesi_jurnal = SesiJournal::where('id', $sesi_journal_id)->first();
            if(!$sesi_jurnal){
                return response([
                    'status' => false,
                    'message' => 'Pertanyaan tidak ditemukan'
                ], 400);
            }

            $pertanyaan = json_decode($sesi_jurnal->kumpulan_pertanyaan);
            $jawaban = JawabanUser::where('user_id', AuthCommon::user()->id)->whereDate('created_at', Carbon::now())->limit(10)->get();
            return response([
                'status' => true,
                'data' => [
                    'pertanyaan' => $pertanyaan,
                    'jawaban' => $jawaban
                ]
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'status' => false,
                'message' => ResponseConstant::RM_INTERNAL_ERROR,
                'error' => $th->getMessage()
            ], 400);
        }
    }



    public function get_pertanyaan(){
        try {
            $theme = AuthCommon::user()->theme ?? null;
            $result = GeminiUtility::get_pertanyaan_harian($theme);
            return response([
                'status' => true,
                'data' => $result,
                'message' => 'Sukses'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'status' => false,
                'message' => ResponseConstant::RM_INTERNAL_ERROR
            ], 400);
        }
    }

    public function generate_kesimpulan($sesi_jurnal_id){
        $result = GeminiUtility::buatKesimpulanSesi($sesi_jurnal_id);
        try {
            SesiJournal::where('id', $sesi_jurnal_id)->update([
                'kesimpulan_ai' => $result,
                'status' => 'SELESAI'
            ]);
            return response([
                'status' => true,
                'data' => ['kesimpulan' => $result],
                'message' => 'Sukses'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'status' => false,
                'message' => ResponseConstant::RM_INTERNAL_ERROR,
                'error' => $th->getMessage()
            ], 400);
        }
    }

    public function get_kesimpulan($sesi_journal_id){
        try {
            $sesi_jurnal = SesiJournal::where('id', $sesi_journal_id)->whereNotNull('kesimpulan_ai')->first();
            if(!$sesi_jurnal){
                return response([
                    'status' => false,
                    'message' => 'Kesimpulan tidak ditemukan'
                ], 400);
            }

            return response([
                'status' => true,
                'data' => $sesi_jurnal->kesimpulan_ai,
                'message' => 'Sukses'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'status' => false,
                'message' => ResponseConstant::RM_INTERNAL_ERROR
            ], 400);
        }
    }
}

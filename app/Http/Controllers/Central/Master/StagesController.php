<?php

namespace App\Http\Controllers\Central\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Stage;

use App\Repositories\Stages\StagesRepository;

class StagesController extends Controller
{
    private $StagesRepository;

    public function __construct(
        StagesRepository $StagesRepository
    ){
        $this->StagesRepository = $StagesRepository;

    }

    public function index(Request $request){
        
        if (!$request->user()->can('manage-stage')) {
            return view('auth-404');
        }

        $data= [];
        $data['totalStages'] = $this->StagesRepository->countTotalStages();
        $data['totalActiveStages'] = $this->StagesRepository->countTotalStagesByStatus(1);
        $data['totalInactiveStages'] = $this->StagesRepository->countTotalStagesByStatus(0);
        
        return view('pages.master.stages.index')->with($data);
    }

    public function getAllStages(Request $request){
        try {
            $module= Stage::latest();
            return  Datatables::of($module)->filter(function($query) use($request) {
                if ($request->has('search.value') && strlen($request->input('search.value')) > 0) {
                    $query->where('stages.stages_name', 'LIKE', '%'.$request->input('search.value').'%');
                }
            })->addColumn('option', function($query) {
                return view('pages.master.stages._action-table', [
                    'id'=> Crypt::encryptString(($query->id)),
                    'name' => $query->stages_name ?? '',
                ]);
            })->make(true);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function addStages(Request $request){
        $validator = Validator::make($request->all(), [
            'stages_name' => 'required',
            'type_form' => 'required',
            'is_active' => 'required'
        ], [
            'stages_name.required' => "Nama Tahap harus diisi",
            'type_form.required' => "Tipe Formulir harus diisi",
            'is_active.required' => "Status Aktif harus ditentukan",

        ]);
    
        if ($validator->fails()) {
            $errs = [];
            $errors = $validator->errors();
            foreach ($errors->all() as $message) {
                $errs[] = $message;
            }
            return response()->json([
                "code" => 2000,
                "message" => implode("<br />", $errs)
            ], 400);
        }
    
        try {
            $data = $request->except("_token");
            $this->StagesRepository->createStages($data);
            return response()->json([
                "code" => 1000,
                "message" => "Tahapan baru berhasil dibuat.",
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
    
            return response()->json([
                "code" => 2000,
                "message" => "Mohon maaf, terjadi kesalahan saat menambahkan Tahapan."
            ], 400);
        }
    }

    public function onDetailStages(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $stages = $this->StagesRepository->getStagesById($id);
         
            if (!$stages) {
                return response()->json([
                    'code' => 2000,
                    'message' => "Sistem Tahapan tidak ditemukan"
                ]);
            }
            $data = [
                'stages' => $stages,
            ];

            return response()->json([
                'code' => 1000,
                'content' => view('pages.master.stages.edit', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in get stages : ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function updateStages(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'stages_name' => 'required',
            'type_form' => 'required',
            'is_active' => 'required'
        ], [
            'stages_name.required' => "Nama Tahap harus diisi",
            'type_form.required' => "Tipe Formulir harus diisi",
            'is_active.required' => "Status Aktif harus ditentukan",

        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 2000,
                'message' => implode("<br />", $validator->errors()->all())
            ], 400);
        }

        try {
            $stagesId = Crypt::decryptString($id);
            $data = $request->except('_token');
            $updatedStages = $this->StagesRepository->updateStages($data, $stagesId);
            return response()->json([
                'code' => 1000,
                'message' => 'Tahapan berhasil diubah.',
                'data' => $updatedStages
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'ID Tahapan tidak valid.'
            ], 400);
        } catch (\Exception $e) {
            Log::error('Update Permission Error: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
  
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function onDeleteStages(Request $request, $id) {
        try {
            $stages_id = Crypt::decryptString($id);
            $deleted = $this->StagesRepository->deleteStages($stages_id);
            if (!$deleted) {
                return response()->json([
                    'code' => 2000,
                    'message' => 'Mohon Maaf, Tahapan gagal dihapus'
                ]);
            }

            return response()->json([
                'code' => 1000,
                'message' => 'Tahapan telah dihapus.'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'Tahapan tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat menghapus Tahapan.'
            ], 400);
        }
    }



}

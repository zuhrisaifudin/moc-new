<?php

namespace App\Http\Controllers\Central\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Criteria\CriteriaRepository;
use App\Repositories\Stages\StagesRepository;

use App\Models\Criteria;

class CriteriaController extends Controller
{
    private $CriteriaRepository;
    private $StagesRepository;

    public function __construct(
        CriteriaRepository $CriteriaRepository,
        StagesRepository $StagesRepository,
    ){
        $this->CriteriaRepository = $CriteriaRepository;
        $this->StagesRepository = $StagesRepository;
    }

    public function index(Request $request){
        
        if (!$request->user()->can('manage-criteria')) {
            return view('auth-404');
        }

        $data= [];
        $data['totalCriteria'] = $this->CriteriaRepository->countTotalCriteria();
        $data['totalActiveCriteria'] = $this->CriteriaRepository->countTotalCriteriaByStatus(1);
        $data['totalInactiveCriteria'] = $this->CriteriaRepository->countTotalCriteriaByStatus(0);
        $data['stage'] = $this->StagesRepository->pluckNameWithId(); 
        
        return view('pages.master.criteria.index')->with($data);
    }

    public function getAllCriteria(Request $request){
        try {
            $model= Criteria::latest();
            return  Datatables::of($model)->filter(function($query) use($request) {
                if ($request->has('search.value') && strlen($request->input('search.value')) > 0) {
                    $query->where('criteria.criteria_name', 'LIKE', '%'.$request->input('search.value').'%');
                }
            })->addColumn('option', function($query) {
                return view('pages.master.criteria._action-table', [
                    'id'=> Crypt::encryptString(($query->id)),
                    'name' => $query->criteria_name ?? '',
                ]);
            })->addColumn('stage_name', function($query) {
                return $query->stage->type_form ?? '';
            })->make(true);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    public function addCriteria(Request $request){
        $validator = Validator::make($request->all(), [
            'criteria_name' => 'required',
            'is_active' => 'required'
        ], [
            'criteria_name.required' => "Nama Kriteria harus diisi",
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
            $this->CriteriaRepository->createCriteria($data);
            return response()->json([
                "code" => 1000,
                "message" => "Kriteria baru berhasil dibuat.",
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "code" => 2000,
                // "message" => $e->getMessage()
                "message" => "Mohon maaf, terjadi kesalahan saat menambahkan Kriteria."
            ], 400);
        }
    }

    public function onDetailCriteria(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $criteria = $this->CriteriaRepository->getCriteriaById($id);
         
            if (!$criteria) {
                return response()->json([
                    'code' => 2000,
                    'message' => "Sistem Kriteria tidak ditemukan"
                ]);
            }
            $data = [
                'criteria' => $criteria,
            ];

            return response()->json([
                'code' => 1000,
                'content' => view('pages.master.criteria.edit', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in get criteria : ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function updateCriteria(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'criteria_name' => 'required',
            'is_active' => 'required'
        ], [
            'criteria_name.required' => "Nama Kriteria harus diisi",
            'is_active.required' => "Status Aktif harus ditentukan",

        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 2000,
                'message' => implode("<br />", $validator->errors()->all())
            ], 400);
        }

        try {
            $criteriaId = Crypt::decryptString($id);
            $data = $request->except('_token');
            $updatedCriteria = $this->CriteriaRepository->updateCriteria($data, $criteriaId);
            return response()->json([
                'code' => 1000,
                'message' => 'Kriteria berhasil diubah.',
                'data' => $updatedCriteria
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'ID Kriteria tidak valid.'
            ], 400);
        } catch (\Exception $e) {
            Log::error('Update Kriteria Error: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
  
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function onDeleteCriteria(Request $request, $id) {
        try {
            $model_id = Crypt::decryptString($id);
            $deleted = $this->CriteriaRepository->deleteCriteria($model_id);
            if (!$deleted) {
                return response()->json([
                    'code' => 2000,
                    'message' => 'Mohon Maaf, Kriteria gagal dihapus'
                ]);
            }

            return response()->json([
                'code' => 1000,
                'message' => 'Kriteria telah dihapus.'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'Kriteria tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([ 
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat menghapus Kriteria.'
            ], 400);
        }
    }

}

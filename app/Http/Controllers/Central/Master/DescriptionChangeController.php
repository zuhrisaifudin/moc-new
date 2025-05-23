<?php

namespace App\Http\Controllers\Central\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Repositories\DescriptionChange\DescriptionChangeRepository;
use App\Repositories\Criteria\CriteriaRepository;
use App\Models\DescriptionChange;
class DescriptionChangeController extends Controller
{
    private $DescriptionChangeRepository;
    private $CriteriaRepository;

    public function __construct(
        DescriptionChangeRepository $DescriptionChangeRepository,
        CriteriaRepository $CriteriaRepository,
    ){
        $this->DescriptionChangeRepository = $DescriptionChangeRepository;
        $this->CriteriaRepository = $CriteriaRepository;
    }

    public function index(Request $request){
        
        if (!$request->user()->can('manage-description-change')) {
            return view('auth-404');
        }

        $data= [];
        
        $data['totalDescriptionChange'] = $this->DescriptionChangeRepository->countTotalDescriptionChange();
        $data['totalActiveDescriptionChange'] = $this->DescriptionChangeRepository->countTotalDescriptionChangeByStatus(1);
        $data['totalInactiveDescriptionChange'] = $this->DescriptionChangeRepository->countTotalDescriptionChangeByStatus(0);
        $data['criteria'] = $this->CriteriaRepository->pluckNameWithId();
        
        return view('pages.master.description-change.index')->with($data);
    }

    public function getAllDescriptionChange(Request $request){
        try {
            $model= DescriptionChange::latest();
            return  Datatables::of($model)->filter(function($query) use($request) {
                if ($request->has('search.value') && strlen($request->input('search.value')) > 0) {
                    $query->where('description_changes.description_change_name', 'LIKE', '%'.$request->input('search.value').'%');
                }
            })->addColumn('option', function($query) {
                return view('pages.master.description-change._action-table', [
                    'id'=> Crypt::encryptString(($query->id)),
                    'name' => $query->description_change_name ?? '',
                ]);
            })->addColumn('criteria', function($query) {
                return $query->criteria->criteria_name ?? '';
            })->make(true);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    public function addDescriptionChange(Request $request){
        $validator = Validator::make($request->all(), [
            'description_change_name' => 'required',
            'is_active' => 'required'
        ], [
            'description_change_name.required' => "Nama Deskripsi Perubahan harus diisi",
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
            $this->DescriptionChangeRepository->createDescriptionChange($data);
            return response()->json([
                "code" => 1000,
                "message" => "Deskripsi Perubahan baru berhasil dibuat.",
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "code" => 2000,
                // "message" => $e->getMessage()
                "message" => "Mohon maaf, terjadi kesalahan saat menambahkan Deskripsi Perubahan."
            ], 400);
        }
    }

    public function onDetailDescriptionChange(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $description = $this->DescriptionChangeRepository->getDescriptionChangeById($id);

            if (!$description) {
                return response()->json([
                    'code' => 2000,
                    'message' => "Sistem Deskripsi Perubahan tidak ditemukan"
                ]);
            }
            $data = [
                'description' => $description,
                'criteria' => $this->CriteriaRepository->pluckNameWithId(),
            ];

            return response()->json([
                'code' => 1000,
                'content' => view('pages.master.description-change.edit', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in get criteria : ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function updateDescriptionChange(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'description_change_name' => 'required',
            'is_active' => 'required'
        ], [
            'description_change_name.required' => "Nama Deskripsi Perubahan harus diisi",
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
            $updatedDescriptionChange = $this->DescriptionChangeRepository->updateDescriptionChange($data, $criteriaId);
            return response()->json([
                'code' => 1000,
                'message' => 'Deskripsi Perubahan berhasil diubah.',
                'data' => $updatedDescriptionChange
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'ID Deskripsi Perubahan tidak valid.'
            ], 400);
        } catch (\Exception $e) {
            Log::error('Update Deskripsi Perubahan Error: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function onDeleteDescriptionChange(Request $request, $id) {
        try {
            $model_id = Crypt::decryptString($id);
            $deleted = $this->DescriptionChangeRepository->deleteDescriptionChange($model_id);
            if (!$deleted) {
                return response()->json([
                    'code' => 2000,
                    'message' => 'Mohon Maaf, Deskripsi Perubahan gagal dihapus'
                ]);
            }

            return response()->json([
                'code' => 1000,
                'message' => 'Deskripsi Perubahan telah dihapus.'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'Deskripsi Perubahan tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([ 
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat menghapus Deskripsi Perubahan.'
            ], 400);
        }
    }

}


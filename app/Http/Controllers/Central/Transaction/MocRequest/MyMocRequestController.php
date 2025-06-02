<?php

namespace App\Http\Controllers\Central\Transaction\MocRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Region\RegionRepository;
use App\Repositories\MocRequest\MocRequestRepository;
use App\Repositories\User\UserRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Helpers\Common;
use Illuminate\Support\Facades\Auth;

class MyMocRequestController extends Controller
{
    private $MocRequestRepository;
    private $RegionRepository;
    private $UserRepository;

    public function __construct(
        MocRequestRepository $MocRequestRepository,
        RegionRepository $RegionRepository,
        UserRepository $UserRepository
    ){
        $this->MocRequestRepository = $MocRequestRepository;
        $this->RegionRepository = $RegionRepository;
        $this->UserRepository = $UserRepository;
    }

    public function index(Request $request)
    {

        if (!$request->user()->can('manage-moc')) {
            return view('auth-404');
        }

        $data = [];

        $myMocRequests = Common::getMocWorkflowUser();
        $data['myMocCount'] = $myMocRequests->where('status', 2)->count();
        $data['total_moc_requests'] = $this->MocRequestRepository->countTotalMocRequest();
     
        return view('pages.moc-request.mymoc.index')->with($data);
    }

    public function getAllMyMocRequest(Request $request)
    {
        try {
            $filters = [
                'search' => $request->input('search.value'),
                'is_temporary' => $request->get('is_temporary', 'all')
            ];

            $query = $this->MocRequestRepository->getAllMyMoc($filters);
            return DataTables::of($query)
                ->addColumn('option', function($mocRequest) {
                    return view('pages.moc-request._action-table', [
                        'id' => Crypt::encryptString($mocRequest->id),
                        'moc_title' => $mocRequest->moc_title ?? '',
                        'status' => $mocRequest->status ?? '',
                        'role' => Common::getRoleFungsiPengusul(),
                    ]);
                })
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error in getAllMocRequest: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Error retrieving MOC Request data',
            ], 400);
        }
    }
}

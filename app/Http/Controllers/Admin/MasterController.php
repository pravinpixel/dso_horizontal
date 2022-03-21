<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Masters\MasterCategories;
use App\Models\Masters\StatutoryBody;
use App\Models\Masters\PackingSizeData;

use Illuminate\Http\Response;
use App\Interfaces\MasterRepositoryInterface;
class MasterController extends Controller
{
    private MasterRepositoryInterface $MasterRepository;

    public function __construct(MasterRepositoryInterface $MasterRepository) 
    {
        $this->MasterRepository = $MasterRepository;
    }

    public function index()
    {        
        
        return view('masters.Item-description');
    }

    public function get_masters()    {
        $result['master_category']  = MasterCategories::latest()->get();
        $result['statutory']        = StatutoryBody::latest()->get();
        $result['pack_size']        = PackingSizeData::latest()->get();
        return  $result;
    }
    public function store_master(Request $request)
    {
        $store  =   $this->MasterRepository->storeMaster($request->name, $request->type);

        if($store) {
            return response(['status' => true,  'message' => trans('response.create')], Response::HTTP_CREATED);
        }
    }
    public function update_master(Request $request)
    {
        $update  =   $this->MasterRepository->updateMaster($request, $request->type);

        if($update) {
            return response(['status' => true,  'message' => trans('response.update')], Response::HTTP_OK);
        }
    }
    public function delete_master(Request $request, $id)
    {
        $delete  =   $this->MasterRepository->deleteMaster($request->id, $request->type);
        if($delete) {
            return response(['status' => true,  'message' => trans('response.delete')], Response::HTTP_OK);
        }
    }
    public function edit_master(Request $request, $id)    {
     
        $edit  =   $this->MasterRepository->editMaster($request->name, $request->type);

        if($edit) {
            return $edit;
        }
    }
} 
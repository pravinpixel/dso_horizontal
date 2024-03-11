<?php

namespace App\Http\Controllers;

use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use App\Repositories\MartialProductRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ExtendExpiryController extends Controller
{
    public function __construct(DsoRepositoryInterface $dsoRepositoryInterface,MartialProductRepository $MartialProductRepository){
        $this->dsoRepository    =   $dsoRepositoryInterface;
        $this->MartialProduct   =   $MartialProductRepository;
    }

    public function index(Request $request)
    {
        $page_name  = "EXTEND_EXPIRY";
        $view       = "crm.extend-expiry.index";
        return $this->dsoRepository->renderPage($page_name, $view);
    }
    public function show($id)
    {
        try {
            return Batches::findOrFail($id);
        } catch (\Throwable $th) {
            return 404;
        }
    }
    public function update(Request $request)
    {
        $batch = Batches::findOrFail(request()->route()->id == null ? $request->id : request()->route()->id);
        $this->MartialProduct->storeFiles($request, $batch);
        if(!empty($request->extended_expiry) && !is_null($request->extended_expiry)) {

            $batch->update([
                'date_of_expiry'     => $request->extended_expiry
            ]);
             if($request->extended_expiry  <=Carbon::now()){
                 $batch->update([
                 'notification_status'=>0
               ]);
             }
             
        }
        $batch->update([
            'remarks'            => $request->remarks,
            'extended_qc_status' => $request->extended_qc_status == 1 ? $request->extended_qc_status : 0
        ]);
        if($request->extended_qc_status == 1) {
            if(is_null($batch->no_of_extension)) {
                $batch->update(['no_of_extension' => 1 ]);
            } else {
                $batch->update(['no_of_extension' => $batch->no_of_extension + 1 ]);
            }
        }
        if($request->extended_qc_status == 0) {
            MaterialProductHistory($batch,'FAIL');
        } else {
            MaterialProductHistory($batch,'PASS');
        }
        if($request->extended_qc_status == 0) {
            return redirect()->route('disposal',['id' => request()->route()->id == null ? $request->id : request()->route()->id ])->with('info',"Extended QC Results Status Changed to FAIL !");
        }
        return redirect()->route('extend-expiry')->with('success',"Extension Success !");
    }
}

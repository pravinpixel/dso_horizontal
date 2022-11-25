<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use App\Repositories\MartialProductRepository;
use Illuminate\Http\Request;

class EarlyDisposalController extends Controller
{
    public function __construct(
        DsoRepositoryInterface $dsoRepositoryInterface,
        MartialProductRepository $MartialProductRepository
    ){
        $this->dsoRepository    =   $dsoRepositoryInterface;
        $this->MartialProduct   =   $MartialProductRepository;
    }
    public function index()
    {
        $page_name  = "EARLY_DISPOSAL";
        $view       = "crm.disposal.index";
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
    public function disposal_update(Request $request)
    {
        $batch = Batches::findOrFail(request()->route()->id == null ? $request->id : request()->route()->id);
        $this->MartialProduct->storeFiles($request, $batch);
        $old_value  =   clone $batch;
        $new_value  =   $batch;

        $batch->update([
            'used_for_td_expt_only' => $request->used_for_td_expt_only,
            'quantity'              => $request->quantity != null ? $batch->quantity - $request->quantity : $batch->quantity,
            'disposed_after'        => $request->disposed_after ?? null,
            'disposed_status'       => true
        ]);

        if($batch->quantity == 0) {
            TrackDisposedBatches($batch);
        }
 
        LogActivity::dataLog($old_value, $new_value,  $request->remarks ?? "");
        return redirect()->route('disposal')->with('success',"Disposal Success !");
    }
}
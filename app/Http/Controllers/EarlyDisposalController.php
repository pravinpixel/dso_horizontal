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
        // dd("update.disposal");
        $batch = Batches::findOrFail(request()->route()->id == null ? $request->id : request()->route()->id);
        $this->MartialProduct->storeFiles($request, $batch);
        $batch->update([
            'coc_coa_mill_cert_status' => $request->used_for_td_expt_only == 1 ? 'on' : 'off',
            'quantity'                 => $request->quantity != null ? $batch->quantity - $request->quantity : $batch->quantity,
            'disposed_after'           => $request->disposed_after ?? null,
            'disposed_status'          => true
        ]);
        TrackDisposedBatches($batch, $request->quantity);
        return redirect()->route('disposal')->with('success',"Disposal Success !");
    }
}

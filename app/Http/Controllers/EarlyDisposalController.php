<?php

namespace App\Http\Controllers;

use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use App\Repositories\MartialProductRepository;
use Illuminate\Http\Request;

class EarlyDisposalController extends Controller
{
    public $MartialProduct, $dsoRepository;
    public function __construct(
        DsoRepositoryInterface $dsoRepositoryInterface,
        MartialProductRepository $MartialProductRepository
    ) {
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
        $current_quantity = $request->quantity != null ? $batch->quantity - $request->quantity : $batch->quantity;
        $batch->update(['quantity' => $request->quantity]);
        if ($request->used_for_td_expt_only === "1") {
            MaterialProductHistory($batch, 'USED_FOR_TD_EXPT');
        } else {
            MaterialProductHistory($batch, 'TO_DISPOSE');
        }
        $batch->update([
            'quantity'        => $current_quantity,
            'total_quantity'  => $batch->unit_packing_value * $current_quantity,
            'disposed_after'  => $request->disposed_after ?? null,
            'disposed_status' => true
        ]);
        updateParentQuantity($batch->material_product_id);
        if ($request->used_for_td_expt_only === "1") {
            $batch->update(["coc_coa_mill_cert_status" => 'on']);
        } else {
            TrackDisposedBatches($batch, $request->quantity);
        }
        return redirect()->route('disposal')->with('success', "Disposal Success !");
    }
}

<?php

namespace App\Http\Controllers;

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
    public function update(Request $request, $id)
    {
        $batch = Batches::findOrFail($id);
        $this->MartialProduct->storeFiles($request, $batch);

        $batch->update([
            'used_for_td_expt_only' => $request->used_for_td_expt_only,
            'quantity'              => $request->quantity != null ? $batch->quantity - $request->quantity : $batch->quantity,
            'disposed_after'        => $request->disposed_after ?? null,
            'disposed_status'       => true
        ]);
        return redirect()->route('disposal')->with('success',"Disposal Success !");
    }
}
<?php

namespace App\Http\Controllers;

use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use App\Repositories\MartialProductRepository;
use Illuminate\Http\Request;

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
    public function update(Request $request, $id)
    {
        $batch = Batches::findOrFail($id);
        $this->MartialProduct->storeFiles($request, $batch);
        $batch->update([
            'extended_expiry' => $request->extended_expiry,
            'remarks'         => $request->remarks
        ]);
        return redirect()->route('extend-expiry')->with('success',"Extension Success !");
    }
}
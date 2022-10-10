<?php

namespace App\Http\Controllers;

use App\Exports\ReconciliationExport;
use App\Imports\ReconciliationImport;
use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use App\Models\Reconciliation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;

class ReconciliationController extends Controller
{
    public function __construct(DsoRepositoryInterface $dsoRepositoryInterface){
        $this->dsoRepository    =   $dsoRepositoryInterface;
    }
    public function index()
    {
        $Reconciliation =  Reconciliation::latest()->get();
        return view('crm.reconciliation.index', compact('Reconciliation'));
    }
    public function show()
    {
        $page_name  = "RECONCILIATION_LIST";
        $view       = "crm.reconciliation.view";
        return $this->dsoRepository->renderPage($page_name, $view); 
    }
    public function download()
    {
        return Excel::download(new ReconciliationExport, 'data.xlsx');
    }
    public function store(Request $request)
    { 
        $ReconciliationHistory              = new Reconciliation;
        $ReconciliationHistory->uploaded_at = auth_user()->alias_name;
        $ReconciliationHistory->created_at  = now();
        $ReconciliationHistory->file_name   = storeFiles('ReconciliationFile');

        try {
            $ReconciliationImportData = Excel::toArray(new ReconciliationImport, $request->file('ReconciliationFile'))[0];
            $tempCount = 0;
            foreach ($ReconciliationImportData as $key => $data) {
                $barcode_number =  $data[2];
                $physical_stock =  $data[6];
                if($key != 0 && $physical_stock != null) {
                    $tempCount ++;
                    $Batches = Batches::where('barcode_number',$barcode_number)->first();
                    $Batches->update([ 'quantity' => $physical_stock ]);
                }
            }
            if($tempCount == 0) {
                $ReconciliationHistory->status = false;
                Flash::error("Invalid Action !");
            } else {
                $ReconciliationHistory->status = true;
                Flash::success(__('global.imported'));
            }
        } catch (\Throwable $th) {
            $ReconciliationHistory->status = false;
            Flash::error("Invalid Action !");
        }
        $ReconciliationHistory->save();
        return back();
    }

    public function destroy($id)
    {
        $Reconciliation = Reconciliation::findOrFail($id);
        if(Storage::exists($Reconciliation->file_name)) {
            Storage::delete($Reconciliation->file_name);
        }
        $Reconciliation->delete();
        Flash::success(__('global.deleted'));
        return back();
    }
}
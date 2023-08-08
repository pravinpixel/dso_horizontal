<?php

namespace App\Http\Controllers;

use App\Exports\ReconciliationExport;
use App\Helpers\LogActivity;
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
    public  $dsoRepository;

    public function __construct(DsoRepositoryInterface $dsoRepositoryInterface)
    {
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
        return Excel::download(new ReconciliationExport, 'reconciliation-report.xlsx');
    }
    public function ReconciliationImportUpdate(Request $request)
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
                if ($key != 0 && $physical_stock != null) {
                    $tempCount++;
                    $Batches = Batches::where('barcode_number', $barcode_number)->first();
                    $Batches->update([
                        'quantity' => $physical_stock,
                        'total_quantity' => ($Batches->unit_packing_value * $physical_stock)
                    ]);
                    updateParentQuantity($Batches->material_product_id);
                    LogActivity::log($Batches->id);
                }
            }
            if ($tempCount == 0) {
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
    public function ReconciliationUpdate(Request $request, $id)
    {
        $batch = Batches::findOrFail($id);
        $batch->update([
            'quantity' => $request->PhysicalStock,
            'total_quantity' => ($batch->unit_packing_value * $request->PhysicalStock)
        ]);
        updateParentQuantity($batch->material_product_id);
        LogActivity::log($id);
        return response()->json([
            "message" => "Reconciliation Success !"
        ], 200);
    }
    public function destroy($id)
    {
        $Reconciliation = Reconciliation::findOrFail($id);
        if (Storage::exists($Reconciliation->file_name)) {
            Storage::delete($Reconciliation->file_name);
        }
        $Reconciliation->delete();
        Flash::success(__('global.deleted'));
        return back();
    }
}

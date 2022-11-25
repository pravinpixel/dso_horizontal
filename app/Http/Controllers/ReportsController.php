<?php

namespace App\Http\Controllers;

use App\Exports\DisposalExport;
use App\Exports\ExpiredMaterialExport;
use App\Exports\HistoryExport;
use App\Exports\SecurityReportExcel;
use App\Helpers\LogActivity;
use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use App\Models\LogSheet;
use App\Models\Masters\Departments;
use App\Models\MaterialProducts;
use App\Models\SecurityReport;
use App\Repositories\MartialProductRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Yajra\DataTables\Facades\DataTables;

class ReportsController extends Controller
{
    public function __construct(
        DsoRepositoryInterface $dsoRepositoryInterface,
        MartialProductRepository $MartialProductRepository
    ){
        $this->dsoRepository    =   $dsoRepositoryInterface;
        $this->MartialProduct   =   $MartialProductRepository;
    }
    public function deduct_track_outlife()
    {
        $page_name  = "DEDUCT_TRACK_OUTLIFE_REPORT";
        $view       = "crm.reports.deduct-track-outlife";
        return $this->dsoRepository->renderPage($page_name, $view); 
    }
    public function deduct_track_usage()
    { 
        $page_name  = "DEDUCT_TRACK_USAGE_REPORT";
        $view       = "crm.reports.deduct-track-usage";
        return $this->dsoRepository->renderPage($page_name, $view); 
    }
    public function material_in_house_pdt_history()
    {
        return view('crm.reports.material-in-house-pdt-history');
    }
    public function export_cart()
    {
        $page_name  = "REPORT_EXPORT_CART";
        $view       = "crm.reports.export-cart";
        return $this->dsoRepository->renderPage($page_name, $view); 
    }
    public function history(Request $request)
    {
        if ($request->ajax()) { 
            if (!empty($request->get('action_type'))) {
                $data = LogSheet::with('User')->where('action_type', $request->get('action_type'))->latest();
            } else {
                $data = LogSheet::with('User')->latest();
            }
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('TransactionDate', function($data){
                    return Carbon::parse($data->created_at)->toFormattedDateString();
                })
                ->addColumn('TransactionTime', function($data){
                    return Carbon::parse($data->created_at)->format('h:i:s A');
                })
                ->addColumn('TransactionBy', function($data){
                    return $data->User->alias_name ?? "SYSTEM BOT";
                }) 
                ->addColumn('Remarks', function($data){
                    return $data->remarks != '' ? $data->remarks : "-";
                }) 
                ->rawColumns(['TransactionBy',"Remarks","TransactionDate","TransactionTime"])
            ->make(true);
        }
        $actions = array_unique(LogSheet::pluck('action_type')->toArray());
        return view('crm.reports.history', compact('actions'));
    }
    public function export()
    {
        return Excel::download(new HistoryExport, 'history.xlsx');  
    }
    public function disposed_items(Request $request)
    {  
        $Batches =  Batches::where('quantity',0)->latest()->get();
 
        $disposed = [];
        foreach ($Batches as $key => $batch) {
 
            if($batch->quantity == 0) {
                $disposed[] = [
                    "transaction_date" => $batch->created_at->format('d-m-Y'),
                    "transaction_time" => $batch->created_at->format('h:m:s A'),
                    "transaction_by"   => $batch->user_name,
                    "item_description" => MaterialProducts::find($batch->material_product_id)->item_description,
                    "batch_serial"     => $batch->batch.' / '.$batch->serial,
                    "unit_pack_value"  => $batch->unit_packing_value,
                    "quantity"         => (string) $batch->quantity, 
                ];
            }
        }
        if ($request->ajax()) { 
            return DataTables::of($disposed)->addIndexColumn()->make(true);
        }
        return  view('crm.reports.disposed-items',compact('disposed')); 
    }
    public function expired_material(Request $request)
    {
        $batches = Batches::with(['BatchMaterialProduct','StorageArea','HousingType'])->where('is_draft',0)->latest()->get();;
        $expired = [];

        if ($request->ajax()) { 
            if (!empty($request->get('department')) || !empty($request->get('department'))) { 
                $batches = Batches::with(['BatchMaterialProduct','StorageArea','HousingType'])
                    ->where( 'is_draft' , 0)
                    ->where( 'department',$request->department)
                    // ->where( 'department',$request->department)
                    ->latest()->get();
            }  
            
            foreach ($batches as $key => $row) {
                $now            = Carbon::now();
                $date_of_expiry = Carbon::parse($row->date_of_expiry);
                if ($now >= $date_of_expiry) {
                    $expired[] = $row;
                }
            }

            return DataTables::of($expired)
                ->addColumn('category_selection',function ($data){
                    return MaterialProducts::find($data->material_product_id)->category_selection;
                })->addColumn('item_description',function ($data){
                    return MaterialProducts::find($data->material_product_id)->item_description;
                })->addColumn('batch_serial',function ($data){
                    return $data->batch." / ".$data->serial;
                })->addColumn('owners',function ($data){
                    return $data->owner_one." / ".$data->owner_two;
                })->addColumn('department',function ($data){
                    return $data->Department->name;
                })->addColumn('storage_area',function ($data){
                    return $data->StorageArea->name;
                })
                ->addIndexColumn()
            ->make(true);
        }
        foreach ($batches as $key => $row) {
            $now            = Carbon::now();
            $date_of_expiry = Carbon::parse($row->date_of_expiry);
            if ($now >= $date_of_expiry) {
                $expired[] = $row;
            }
        }

        $departments = Departments::get();
         
        return view('crm.reports.expired-material',compact('departments','expired'));
    }
    public function export_disposed_items(Request $request)
    { 
        return Excel::download(new DisposalExport($request->start_date,$request->end_date), 'disposal-items.xlsx');
    }
    public function export_expired_material(Request $request)
    {
        $batches = Batches::with(['BatchMaterialProduct','StorageArea','HousingType'])
                ->where( 'is_draft' , 0)
                ->where( 'department',$request->department)
                ->latest()->get();
        $data = [];
        foreach ($batches as $key => $row) {
            $data[] = [
                "category_selection"    => MaterialProducts::find($row->material_product_id)->category_selection,
                "item_description"      => MaterialProducts::find($row->material_product_id)->item_description,
                "batch_serial"          => $row->batch." / ".$row->serial,
                "unit_packing_value"    => $row->unit_packing_value,
                "quantity"              => $row->quantity,
                "storage_area"          => $row->StorageArea->name,
                "housing"               => $row->housing,
                "date_of_expiry"        => $row->date_of_expiry,
                "used_for_td_expt_only" => $row->used_for_td_expt_only,
                "department"            => $row->Department->name,
                "owners"                => $row->owner_one." / ".$row->owner_two,
            ];
        }
        return Excel::download(new ExpiredMaterialExport($data), 'expired-materials.xlsx');
    }
    public function security(Request $request)
    {
        $security = LogActivity::getSecurityReport();
        if ($request->ajax()) { 
            return DataTables::of($security)->addIndexColumn()->make(true);
        }
        return view('crm.reports.security',compact('security'));
    }
    public function security_export(Request $request)
    {
        return Excel::download(new SecurityReportExcel($request->start_date,$request->end_date), 'SecurityReport.xlsx');
    }
}
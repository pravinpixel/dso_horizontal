<?php

namespace App\Http\Controllers;

use App\Exports\DisposalExport;
use App\Exports\ExpiredMaterialExport;
use App\Exports\HistoryExport;
use App\Exports\MaterialProductHistoryExport;
use App\Exports\SecurityReportExcel;
use App\Exports\TrackOutlifeExport;
use App\Exports\TrackUsageExport;
use App\Helpers\LogActivity;
use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use App\Models\DeductTrackUsage;
use App\Models\DisposedItems;
use App\Models\LogSheet;
use App\Models\Masters\Departments;
use App\Models\materialProductHistory;
use App\Models\MaterialProducts;
use App\Models\UtilizationCart;
use App\Repositories\MartialProductRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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
    public function index()
    {
        return view('crm.reports.index-board');
    }
    public function deduct_track_outlife()
    {
        $page_name  = "DEDUCT_TRACK_OUTLIFE_REPORT";
        $view       = "crm.reports.deduct-track-outlife";
        return $this->dsoRepository->renderPage($page_name, $view);
    }
    public function deduct_track_outlife_download($id)
    {
        return Excel::download(new TrackOutlifeExport($id), 'history.xlsx');
    }
    public function deduct_track_usage(Request $request)
    {
        if(!empty($request->barcode)) {
            $data = DeductTrackUsage::where('barcode_number',$request->barcode)->get();
        } else {
            $data = DeductTrackUsage::all();
        }
        $DeductTrackUsage = [];
        foreach ($data as $key => $value) {
            $Batch = Batches::with('BatchOwners','StorageArea')->find($value->batch_id);
            if(!is_null($Batch)) {
                $owners = '';
                if($Batch->BatchOwners ?? false) {
                    foreach ($Batch->BatchOwners as $key => $owner){
                        if ($owner->alias_name ?? false) {
                            $owners .= $owner->alias_name.' ,';
                        }
                    }
                }
                $DeductTrackUsage[] = [
                    "ItemDescription"  => $value->item_description,
                    "Brand"            => $Batch->brand,
                    "Barcode"            => $Batch->barcode_number,
                    "BatchSerial"      => $value->batch_serial,
                    "UnitPackingValue" => $Batch->unit_packing_value,
                    "StorageArea"      => $Batch->StorageArea->name ?? "-",
                    "Housing"          => $Batch->housing,
                    "Owners"           => $owners,
                    "TransactionDate"  => Carbon::parse($value->created_at)->toFormattedDateString(),
                    "TransactionTime"  => Carbon::parse($value->created_at)->format('h:i:s A'),
                    "TransactionBy"    => $value->last_accessed,
                    "UsedAmount"       => $value->used_amount,
                    "RemainingAmount"  => $value->remain_amount,
                ];
            }
        }

        if ($request->ajax()) {
            return DataTables::of($DeductTrackUsage)->addIndexColumn()->make(true);
        }
        return view('crm.reports.deduct-track-usage',compact('DeductTrackUsage'));
    }
    public function deduct_track_usage_download(Request $request)
    {
        if(!empty($request->barcode)) {
            $data = DeductTrackUsage::where('barcode_number',$request->barcode)->get();
        } else {
            $data = DeductTrackUsage::all();
        }

        $DeductTrackUsage = [];

        foreach ($data as $key => $value) {
            $Batch = Batches::with('BatchOwners')->find($value->batch_id);
            $owners = '';
            if($Batch->BatchOwners ) {
                foreach ($Batch->BatchOwners as $key => $owner){
                    if ($owner->alias_name ?? false) {
                        $owners .= $owner->alias_name.' ,';
                    }
                }
            }

            $DeductTrackUsage[] = [
                "ItemDescription"  => $value->item_description,
                "Brand"            => $Batch->brand,
                "BatchSerial"      => $value->batch_serial,
                "UnitPackingValue" => $Batch->unit_packing_value,
                "StorageArea"      => $Batch->StorageArea->name,
                "Housing"          => $Batch->housing,
                "Owners"           => $owners,
                "TransactionDate"  => Carbon::parse($value->created_at)->toFormattedDateString(),
                "TransactionTime"  => Carbon::parse($value->created_at)->format('h:i:s A'),
                "TransactionBy"    => $value->last_accessed,
                "UsedAmount"       => $value->used_amount,
                "RemainingAmount"  => $value->remain_amount,
            ];
        }

        return Excel::download(new TrackUsageExport($DeductTrackUsage), generateFileName('DeductTrackUsage','xlsx'));
    }
    public function material_in_house_pdt_history()
    { 
        $filters = [
            "Transaction By"     => materialProductHistory::groupBy('TransactionBy')->pluck('TransactionBy'),
            "Storage Area"       => materialProductHistory::groupBy('StorageArea')->pluck('StorageArea'),
            "Brand"              => materialProductHistory::groupBy('Brand')->pluck('Brand'),
            "Housing"            => materialProductHistory::groupBy('Housing')->pluck('Housing'),
            "Module"             => materialProductHistory::groupBy('Module')->pluck('Module'),
            "Action Taken"       => materialProductHistory::groupBy('ActionTaken')->pluck('ActionTaken'),
            "Item Description"   => materialProductHistory::groupBy('ItemDescription')->pluck('ItemDescription'),
            "Category Selection" => materialProductHistory::groupBy('CategorySelection')->pluck('CategorySelection'),
            "Draw Status"        => materialProductHistory::groupBy('DrawStatus')->pluck('DrawStatus')
        ];
        return view('crm.reports.material-in-house-pdt-history',compact('filters'));
    }
    public function material_in_house_pdt_history_download(Request $request)
    {
        $material = $this->materialHistoryFilter($request);
        return Excel::download(new MaterialProductHistoryExport($material),generateFileName('Material inHouse pdt History','xlsx'));
    }
    public function utilization_cart(Request $request)
    {
        if($request->ajax()) {
            if($request->start_month) {
                $UtilizationCart = UtilizationCart::with('Batch')
                ->whereBetween('created_at', [Carbon::parse($request->start_month)->firstOfMonth(),Carbon::parse($request->end_month)->lastOfMonth()])
                ->get()->groupBy(function($data) {
                    return $data->batch_id;
                });
            } else {
                $UtilizationCart = UtilizationCart::with('Batch')->get()->groupBy(function($data) {
                    return $data->batch_id;
                });
            }
            if(!is_null($UtilizationCart)) {
                $UtilizationCartData = [];
                foreach ($UtilizationCart as $key => $batches) {
                    $total_quantity   = 0;
                    $array_quantity = [];
                    foreach ($batches as $key => $batch) {
                        $array_quantity[] = $batch->quantity;
                        $total_quantity += $batch->quantity;
                    }
                    if($batches[0]->Batch) {
                        $UtilizationCartData[] = [
                            "item_description"   => $batches[0]->Batch->BatchMaterialProduct->item_description ?? null,
                            "brand"              => $batches[0]->Batch->brand ?? null,
                            "batch_serial"       => $batches[0]->Batch->batch." / ".$batches[0]->Batch->serial ?? null,
                            "unit_packing_value" => $batches[0]->Batch->unit_packing_value ?? null,
                            "total_quantity"     => toFixed($total_quantity,3) ?? null,
                            "average_quantity"   => toFixed((array_sum($array_quantity) / count($array_quantity)),3) ?? null,
                            "maximum_quantity"   => toFixed(max($array_quantity),3) ?? null,
                        ];
                    }
                }
                return DataTables::of($UtilizationCartData)->addIndexColumn()->make(true);
            }
        }
        return view('crm.reports.utilization-cart');
    }
    public function utilization_chart(Request $request)
    {
        $UtilizationCart = UtilizationCart::with('Batch')->whereBetween('created_at', [Carbon::parse($request->start_month)->firstOfMonth(),Carbon::parse($request->end_month)->lastOfMonth()])->select("quantity","batch_id","created_at")->get()->groupBy('created_at');
        $data = [];
        $datasets = [];
        $chart_labels = [];
        
        foreach($UtilizationCart as $list) {
            $quantity = [];
            foreach ($list as $key => $batch) {
                $quantity[] = $batch->quantity;
            }
            $chart_labels[] = $list[0]->created_at;
            $datasets[] = [
                "label" => $list[0]->Batch->barcode_number,
                "data" =>  $quantity,
                // "backgroundColor"=> '#4088f9',
            ];
        }
        return response([
            "status" => true,
            "data"   => $data,
            "datasets"   => $datasets,
            "chart_labels"   => $chart_labels,
        ]);
    }
    public function materialHistoryFilter($request)
    {
        $material = materialProductHistory::select('*');
        $material->when(isset($request->ItemDescription), function($query) use ($request){
            $query->where("ItemDescription",$request->ItemDescription);
        });
        $material->when(isset($request->CategorySelection), function($query) use ($request){
            $query->where("CategorySelection",$request->CategorySelection);
        });
        $material->when(isset($request->Brand), function($query) use ($request){
            $query->where("Brand",$request->Brand);
        });
        $material->when(isset($request->Housing), function($query) use ($request){
            $query->where("Housing",$request->Housing);
        });
        $material->when(isset($request->StorageArea), function($query) use ($request){
            $query->where("StorageArea",$request->StorageArea);
        });
        $material->when(isset($request->Module), function($query) use ($request){
            $query->where("Module",$request->Module);
        });
        $material->when(isset($request->ActionTaken), function($query) use ($request){
            $query->where("ActionTaken",$request->ActionTaken);
        });
        $material->when(isset($request->TransactionBy), function($query) use ($request){
            $query->where("TransactionBy",$request->TransactionBy);
        });
        $material->when(isset($request->DrawStatus), function($query) use ($request){
            $query->where("DrawStatus",$request->DrawStatus);
        });
        $material->when(isset($request->StartDate), function($query) use ($request){
            $query->whereBetween('created_at', dateBetween($request));
        });
        $material->when(isset($request->EndDate), function($query) use ($request){
            $query->whereBetween('created_at', dateBetween($request));
        });
        return $material->get();
    }
    public function get_material_product_history(Request $request)
    { 
        $material = $this->materialHistoryFilter($request);
        return DataTables::of($material)->addIndexColumn()->addColumn('Module', function($data){
                return strtoupper(str_replace('_',' ',$data->Module));
            })->addColumn('ActionTaken', function($data){
                return strtoupper(str_replace('_',' ',$data->ActionTaken));
            })->addColumn('TransactionDate', function($data){
                return Carbon::parse($data->created_at)->toFormattedDateString();
            })->addColumn('TransactionTime', function($data){
                return Carbon::parse($data->created_at)->format('h:i:s A');
            })->addColumn('TransactionBy', function($data){
                return $data->TransactionBy ?? "SYSTEM BOT";
            })->rawColumns(["TransactionDate","TransactionTime","TransactionBy","Module","ActionTaken"])
        ->make(true);
    }
    public function disposed_items(Request $request)
    {
        if(!empty($request->start_date) && !empty($request->end_date)) {
            $disposed = DisposedItems::whereBetween('created_at', dateBetween($request))->get();
        } else {
            $disposed = DisposedItems::all();
        }
        if ($request->ajax()) {
            return DataTables::of($disposed)->addIndexColumn()->make(true);
        }
        return  view('crm.reports.disposed-items',compact('disposed'));
    }
    public function export_disposed_items(Request $request)
    {
        if(!empty($request->start_date) && !empty($request->end_date)) {
            $disposed = DisposedItems::whereBetween('created_at', dateBetween($request))->select(
                "TransactionDate",
                "TransactionTime",
                "TransactionBy",
                "ItemDescription",
                "BatchSerial",
                "UnitPackingValue",
                "BeforeQuantity",
                "DisposedQuantity",
                "AfterQuantity"
            )->get()->toArray();
        } else {
            $disposed = DisposedItems::select(
                "TransactionDate",
                "TransactionTime",
                "TransactionBy",
                "ItemDescription",
                "BatchSerial",
                "UnitPackingValue",
                "BeforeQuantity",
                "DisposedQuantity",
                "AfterQuantity"
            )->get()->toArray();
        }
        return Excel::download(new DisposalExport($disposed), generateFileName('disposal-items','xlsx'));
    }
    public function expired_material_data($request)
    {
        $batches = Batches::with(['BatchMaterialProduct','StorageArea','HousingType'])->where( 'is_draft' , 0)->latest()->get();
        if(!is_null($request->used_for_td_expt_only) && !is_null($request->department)) {
            $batches = Batches::with(['BatchMaterialProduct','StorageArea','HousingType'])
            ->where( 'is_draft' , 0)
            ->where('department',$request->department)
            ->where('used_for_td_expt_only',$request->used_for_td_expt_only)
            ->latest()->get();
        } elseif(!is_null($request->used_for_td_expt_only)) {
            $batches = Batches::with(['BatchMaterialProduct','StorageArea','HousingType'])
            ->where( 'is_draft' , 0)
            ->where('used_for_td_expt_only',$request->used_for_td_expt_only)
            ->latest()->get();
        } elseif(!is_null($request->department)) {
            $batches = Batches::with(['BatchMaterialProduct','StorageArea','HousingType'])
            ->where( 'is_draft' , 0)
            ->where('department',$request->department)
            ->latest()->get();
        } else {
            $batches = Batches::with(['BatchMaterialProduct','StorageArea','HousingType'])->where( 'is_draft' , 0)->latest()->get();
        }
        $expired = [];
        foreach ($batches as $key => $row) {
            $owners = '';
            $now            = Carbon::now();
            $date_of_expiry = Carbon::parse($row->date_of_expiry);
            if ($now >= $date_of_expiry) {
                if (count($row->BatchOwners ?? [])) {
                    foreach ($row->BatchOwners as $key => $owner){
                        if ($owner->alias_name ?? false) {
                            $space = $key != 0 ? ', ' : '';
                            $owners .= $space.$owner->alias_name;
                        }
                    }
                }
                $expired[] = [
                    "category_selection"    => MaterialProducts::find($row->material_product_id)->category_selection,
                    "item_description"      => MaterialProducts::find($row->material_product_id)->item_description,
                    "batch_serial"          => $row->batch." / ".$row->serial,
                    "unit_packing_value"    => $row->unit_packing_value,
                    "quantity"              => $row->quantity,
                    "storage_area"          => $row->StorageArea->name,
                    "housing"               => $row->housing,
                    "date_of_expiry"        => $row->date_of_expiry,
                    "used_for_td_expt_only" => $row->coc_coa_mill_cert_status == "on" ? "YES" : "NO",
                    "department"            => $row->Department->name,
                    "owners"                => $owners,
                ];
            }
        }  
        return $expired;
    }
    public function expired_material(Request $request)
    { 
        $expired = $this->expired_material_data($request);
        if ($request->ajax()) {
            return DataTables::of($expired)->rawColumns(['owners'])->addIndexColumn()->make(true);
        }
        $departments = Departments::get();
        return view('crm.reports.expired-material',compact('departments','expired'));
    }
    public function export_expired_material(Request $request)
    {
        $data = $this->expired_material_data($request); 
        return Excel::download(new ExpiredMaterialExport($data), generateFileName('expired-materials','xlsx'));
    }
    public function security(Request $request)
    {
        if(!empty($request->start_date) && !empty($request->end_date)) {
            $security = LogActivity::where()->dateBetween($request);
        } else {
            $security = LogActivity::getSecurityReport();
        }

        if ($request->ajax()) {
            return DataTables::of($security)->addIndexColumn()->make(true);
        }
        return view('crm.reports.security',compact('security'));
    }
    public function security_export(Request $request)
    {
        if(!empty($request->start_date) && !empty($request->end_date)) {
            $security = LogActivity::where()->dateBetween($request);
        } else {
            $security = LogActivity::getSecurityReport();
        }
        return Excel::download(new SecurityReportExcel($security), generateFileName('security-report','xlsx'));
    }
}

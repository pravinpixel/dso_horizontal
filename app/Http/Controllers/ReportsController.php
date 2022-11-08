<?php

namespace App\Http\Controllers;

use App\Exports\DisposalExport;
use App\Exports\HistoryExport;
use App\Helpers\LogActivity;
use App\Interfaces\DsoRepositoryInterface;
use App\Models\LogSheet;
use App\Repositories\MartialProductRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;
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
    public function utilisation_cart()
    {
        $page_name  = "REPORT_UTILISATION_CART";
        $view       = "crm.reports.utilisation-cart";
        return $this->dsoRepository->renderPage($page_name, $view); 
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
        $disposed = LogActivity::getDisposalItems(); 
        if ($request->ajax()) { 
            return DataTables::of($disposed)->addIndexColumn()->make(true);
        }
        return  view('crm.reports.disposed-items',compact('disposed')); 
    }
    public function export_disposed_items(Request $request)
    { 
        return Excel::download(new DisposalExport($request->start_date,$request->end_date), 'disposal-items.xlsx');
    }
}
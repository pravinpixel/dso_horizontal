<?php

namespace App\Exports;

 
use App\Models\materialProductHistory;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class MaterialProductHistoryExport implements FromView
{
    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
    }
    public function view(): View
    {
        if(is_null($this->start_date) || is_null($this->end_date)) {
            $materialProductHistory = materialProductHistory::all();
        } else {
            $start_date = Carbon::parse($this->start_date);
            $end_date   = Carbon::parse($this->end_date);
            $materialProductHistory = materialProductHistory::whereDate('created_at','<=',$end_date)->whereDate('created_at','>=',$start_date)->get();
        }
        securityLog('Material In-House Product History Export');
        return view('crm.reports.templates.material-in-house-pdt-history',compact('materialProductHistory'));
    }
}
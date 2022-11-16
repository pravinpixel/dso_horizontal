<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserBarcodeExport  implements FromView
{
    public function view(): View
    {
        $staffs =User::all();
        return view('crm.partials.user-barcode-table',compact('staffs'));
    }
}

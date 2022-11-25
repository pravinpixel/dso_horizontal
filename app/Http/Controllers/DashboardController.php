<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use App\Models\DisposedItems;
use App\Models\MaterialProducts;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('crm.dashboard.index');
    }
    public function getCounts()
    {

        $batches = Batches::where('is_draft',0)->latest()->get();
        $expired = []; 
        foreach ($batches as $key => $row) {
            $now            = Carbon::now();
            $date_of_expiry = Carbon::parse($row->date_of_expiry);
            if ($now >= $date_of_expiry) {
                $expired[] = $row;
            }
        }
        return response([
            "Materials" => MaterialProducts::where('category_selection','material')->count(),
            "InHouse"   => MaterialProducts::where('category_selection','in_house')->count(),
            "Disposals" => DisposedItems::count(),
            "Expired" => count($expired)
        ]);
    }
}

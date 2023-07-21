<?php

namespace App\Http\Controllers;

use App\Jobs\AutoDrawInJob;
use App\Models\Batches;
use App\Models\DisposedItems;
use App\Models\MaterialProducts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        dispatch(new AutoDrawInJob());
        return view('crm.dashboard.index');
    }


    public function getCountsByFilters(Request $request)
    {
        switch ($request->type) {
            case 'today':
                return $this->getCountsByToday();
                break;
            case 'week':
                return $this->getCountsByWeek();
                break;
            default:
                return $this->getCountsByToday();
                break;
        }

        // if($request->type == 'week') {
        //     $batches = Batches::where('is_draft',0)->latest()->get();
        //     $expired = [];
        //     foreach ($batches as $key => $row) {
        //         $now            = Carbon::now();
        //         $date_of_expiry = Carbon::parse($row->date_of_expiry);
        //         if ($now >= $date_of_expiry) {
        //             $expired[] = $row;
        //         }
        //     }
        //     return response([
        //         "Materials" => MaterialProducts::where('user_id',auth_user()->id)->where('category_selection','material')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
        //         "InHouse"   => MaterialProducts::where('user_id',auth_user()->id)->where('category_selection','in_house')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
        //         "Disposals" => DisposedItems::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
        //         "Expired" => count($expired)
        //     ]);
        // }
        // if($request->type == 'month') {
        //     $batches = Batches::where('is_draft',0)->latest()->get();
        //     $expired = [];
        //     foreach ($batches as $key => $row) {
        //         $now            = Carbon::now();
        //         $date_of_expiry = Carbon::parse($row->date_of_expiry);
        //         if ($now >= $date_of_expiry) {
        //             $expired[] = $row;
        //         }
        //     }
        //     return response([
        //         "Materials" => MaterialProducts::where('user_id',auth_user()->id)->where('category_selection','material')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count(),
        //         "InHouse"   => MaterialProducts::where('user_id',auth_user()->id)->where('category_selection','in_house')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count(),
        //         "Disposals" => DisposedItems::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count(),
        //         "Expired" => count($expired)
        //     ]);
        // }
        // if($request->type == 'year') {
        //     $batches = Batches::where('is_draft',0)->latest()->get();
        //     $expired = [];
        //     foreach ($batches as $key => $row) {
        //         $now            = Carbon::now();
        //         $date_of_expiry = Carbon::parse($row->date_of_expiry);
        //         if ($now >= $date_of_expiry) {
        //             $expired[] = $row;
        //         }
        //     }
        //     return response([
        //         "Materials" => MaterialProducts::where('user_id',auth_user()->id)->where('category_selection','material')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count(),
        //         "InHouse"   => MaterialProducts::where('user_id',auth_user()->id)->where('category_selection','in_house')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count(),
        //         "Disposals" => DisposedItems::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count(),
        //         "Expired" => count($expired)
        //     ]);
        // }
    }
    public function getCountsByToday()
    {

        function getMaterialsByCategory($type)  {
            $MaterialProducts = MaterialProducts::with('Batches')->where('category_selection',$type)->get();
            $batchesCount     = -1 ;
            foreach ($MaterialProducts as $Material) {
                $MaterialBatchesCount = $Material->Batches()
                ->when(auth_user_role()->slug == 'admin', function ($query) {
                    return $query->whereDate('created_at', Carbon::today())->get();
                }, function ($query) {
                    return $query->where('user_id', auth_user()->id)->whereDate('created_at', Carbon::today())->get();
                })
                ->count();
                $batchesCount += $MaterialBatchesCount;
            }
            return $batchesCount != -1 ?  $batchesCount : 0;
        }
        $DisposedItems = DisposedItems::when(auth_user_role()->slug == 'admin', function ($query) {
            return $query->whereDate('created_at', Carbon::today())->get();
        }, function ($query) {
            return $query->where('user_id', auth_user()->id)->whereDate('created_at', Carbon::today())->get();
        })
        ->count();


        $ExpiredBatches = Batches::when(auth_user_role()->slug == 'admin', function ($query) {
            return $query->where('is_draft',0)->whereDate('created_at', Carbon::today());
        }, function ($query) {
            return $query->where('is_draft',0)->where('user_id', auth_user()->id)->whereDate('created_at', Carbon::today());
        })
        ->get();

        $expired = [];
        foreach ($ExpiredBatches as $key => $row) {
            $now            = Carbon::now();
            $date_of_expiry = Carbon::parse($row->date_of_expiry);
            if ($now >= $date_of_expiry) {
                $expired[] = $row;
            }
        }


        return response([
            "Materials" => getMaterialsByCategory('material'),
            "InHouse"   => getMaterialsByCategory('in_house'),
            "Disposals" => $DisposedItems,
            "Expired"   => count($expired)
        ]);
    }
}

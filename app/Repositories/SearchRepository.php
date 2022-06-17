<?php

namespace App\Repositories;

use App\Interfaces\SearchRepositoryInterface;
use App\Models\MaterialProducts;
use App\Models\SaveMySearch;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Arr;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchRepository implements SearchRepositoryInterface {
    public function barCodeSearch($request)
    {
        return MaterialProducts::with("Batches","Batches.RepackOutlife")
                    ->WhereHas('Batches', function($q) use ($request){
                        $q->where('barcode_number', 'LIKE', "%{$request->filters}%");
                    })
                    ->paginate(5);
    }
    public function bulkSearch($row)
    {
        return MaterialProducts::with("Batches","Batches.RepackOutlife")->where('is_draft', 0)
        ->when($row->category_selection, function ($q) use ($row) {
            $q->where('category_selection' , $row->category_selection ?? null);
        })
        ->when($row->item_description, function ($q) use ($row)  {
            $q->where('item_description', 'LIKE', '%' .$row->item_description.'%');
        })
        ->WhereHas('Batches', function($q) use ($row){
            $q->where('dept', 'LIKE', '%' .$row->dept.'%');
        })
        ->WhereHas('Batches', function($q) use ($row){
            $q->where('owner_one', 'LIKE', '%' .$row->owner.'%');
        })
        ->WhereHas('Batches', function($q) use ($row){
            $q->where('brand', 'LIKE', '%' .$row->brand.'%');
        })
        ->WhereHas('Batches', function($q) use ($row){
            $q->where('storage_area', 'LIKE', '%' .$row->storage_area.'%');
        })
        ->WhereHas('Batches', function($q) use ($row){
            $q->where('date_in', 'LIKE', '%' .$row->date_in.'%');
        }) 
        ->WhereHas('Batches', function($q) use ($row){
            $q->where('date_of_expiry', 'LIKE', '%' .$row->date_of_expiry.'%');
        })
        ->paginate(5);
    }
    public function advanced_search($filter)
    {
        $material_table =  [
            'barcode_number',
            'category_selection',
            'item_description',
            'unit_of_measure',
            'unit_packing_value',
            'alert_threshold_qty_upper_limit',
            'alert_threshold_qty_lower_limit',
            'alert_before_expiry',
        ];
        
        foreach($filter as $column => $value) {
            $filter_result[]    =  MaterialProducts::with("Batches","Batches.RepackOutlife")->where('is_draft', 0)
                                    ->when(in_array($column, $material_table) == true, function ($q) use ($column, $value) { 
                                        $q->where($column , $value); 
                                    })
                                    ->WhereHas('Batches', function($q) use ($column, $value){
                                        $q->Where($column , 'LIKE', '%' .$value.'%');
                                    })
                                    ->get();
        }
        $collection         =   Arr::flatten($filter_result);
        $myCollectionObj    =   collect($collection);
        return $this->paginate($myCollectionObj);
    }
    public function StoreBulkSearch($row, $request)
    {
        return SaveMySearch::create([
            'user_id'             =>  Sentinel::getUser()->id,
            'search_title'        =>  $request->save_advanced_search['title'],
            'batch'               =>  $row->af_batch,
            'cas'                 =>  $row->af_cas,
            'date_of_expiry'      =>  $row->af_date_of_expiry,
            'date_of_manufacture' =>  $row->af_date_of_manufacture,
            'date_of_shipment'    =>  $row->af_date_of_shipment,
            'disposed'            =>  $row->af_disposed,
            'euc_material'        =>  $row->af_euc_material,
            'extended_expiry'     =>  $row->af_extended_expiry,
            'extended_qc_status'  =>  $row->af_extended_qc_status,
            'housing_number'      =>  $row->af_housing_number,
            'housing_type'        =>  $row->af_housing_type,
            'iqc_status'          =>  $row->af_iqc_status,
            'logsheet_id'         =>  $row->af_logsheet_id,
            'po_number'           =>  $row->af_po_number ,
            'product_type'        =>  $row->af_product_type,
            'project_name'        =>  $row->af_project_name,
            'serial'              =>  $row->af_serial,
            'statutory_board'     =>  $row->af_statutory_board,
            'supplier'            =>  $row->af_supplier,
            'unit_pkt_size'       =>  $row->af_unit_pkt_size ,
            'usage_tracking'      =>  $row->af_usage_tracking,
            'outlife_tracking'    =>  $row->af_outlife_tracking,
        ]);
    }

    public function sortingOrder($sort_by)
    { 
        $material_table =  [ 
            'category_selection',
            'item_description',
            'unit_of_measure',
            'unit_packing_value',
            'alert_threshold_qty_upper_limit',
            'alert_threshold_qty_lower_limit',
            'alert_before_expiry',
        ];
        
        return  MaterialProducts::with("Batches","Batches.RepackOutlife")->where('is_draft', 0)
                                    ->when(in_array($sort_by->col_name, $material_table) == true, function ($q) use ($sort_by) { 
                                        $q->orderBy($sort_by->col_name, $sort_by->order_type);
                                    })
                                    ->WhereHas('Batches', function($q) use ($sort_by){
                                        $q->orderBy($sort_by->col_name, $sort_by->order_type);
                                    })
                                    ->paginate(5);
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page   =   $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items  =   $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path'      =>  LengthAwarePaginator::resolveCurrentPath(),
            'pageName'  =>  "page",
        ]);
    }
}

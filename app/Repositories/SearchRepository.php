<?php

namespace App\Repositories;

use App\Interfaces\SearchRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
use App\Models\SaveMySearch;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Arr;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class SearchRepository implements SearchRepositoryInterface
{
    public function barCodeSearch($request)
    {
        Log::info(Batches::where('barcode_number', $request->filters)->first());
        try {
            
            $parent_id = Batches::where('barcode_number', $request->filters)->first()->material_product_id;
            return MaterialProducts::with([
                'Batches',
                'Batches.RepackOutlife',
                'Batches.HousingType',
                'Batches.Department',
                'UnitOfMeasure',
                'Batches.StorageArea'
            ])
            ->WhereHas('Batches', function ($q) use ($parent_id) {
                $q->where('material_product_id', $parent_id);
            })
            ->paginate(config('app.paginate'));
        } catch (\Throwable $th) {
            log::info($th->getMessage());
        }
    }

    public function advanced_search($filter)
    { 
        foreach ($filter as $column => $value) {
           
            if(checkIsMaterialColumn($column) == 1) {
                $filter_result[] =  MaterialProducts::with(['Batches','Batches.RepackOutlife','Batches.HousingType','Batches.Department','UnitOfMeasure','Batches.StorageArea'])
                                                    ->where($column,$value)->get();
            }
            if(checkIsBatchesColumn($column) == 1) {
                $filter_result[] = MaterialProducts::with([
                    'Batches',
                    'Batches.RepackOutlife',
                    'Batches.HousingType',
                    'Batches.Department',
                    'UnitOfMeasure',
                    'Batches.StorageArea'
                ])
                ->WhereHas('Batches', function ($q) use ($column, $value) {
                    $q->where($column,$value);
                })->get();
            }
            if(checkIsBatchDateColumn($column) == 1) {
                $filter_result[] =  MaterialProducts::with(['Batches','Batches.RepackOutlife','Batches.HousingType','Batches.Department','UnitOfMeasure','Batches.StorageArea'])
                            ->WhereHas('Batches', function ($q) use ($value) {
                                $q->whereDate('date_in', '>=', $value['startDate'])
                                    ->whereDate('date_in', '<=', $value['endDate']);
                            })
                            ->get();
            }
        }
        $collection         =   Arr::flatten($filter_result);
        $myCollectionObj    =   collect($collection);
        return $this->paginate($myCollectionObj);
    } 
    public function sortingOrder($sort_by)
    {
        if (checkIsMaterialColumn($sort_by->col_name) == 1) {
            return  MaterialProducts::with([
                'Batches',
                'Batches.RepackOutlife',
                'Batches.HousingType',
                'Batches.Department',
                'UnitOfMeasure',
                'Batches.StorageArea'
            ])
            ->orderBy($sort_by->col_name, $sort_by->order_type)
            ->paginate(config('app.paginate'));
        } else {
            return MaterialProducts::with([
                'Batches' => function ($q) use ($sort_by) {
                    $q->orderBy($sort_by->col_name, $sort_by->order_type);
                },
                'Batches.RepackOutlife',
                'Batches.HousingType',
                'Batches.Department',
                'UnitOfMeasure',
                'Batches.StorageArea'
            ])->paginate(config('app.paginate'));
        }
    }

    public function storeBulkSearch($row, $request)
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
            'po_number'           =>  $row->af_po_number,
            'product_type'        =>  $row->af_product_type,
            'project_name'        =>  $row->af_project_name,
            'serial'              =>  $row->af_serial,
            'statutory_board'     =>  $row->af_statutory_board,
            'supplier'            =>  $row->af_supplier,
            'unit_pkt_size'       =>  $row->af_unit_pkt_size,
            'usage_tracking'      =>  $row->af_usage_tracking,
            'outlife_tracking'    =>  $row->af_outlife_tracking,
        ]);
    }

    public function paginate($items, $page = null, $options = [])
    {
        $perPage    =   config('app.paginate');
        $page       =   $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items      =   $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path'      =>  LengthAwarePaginator::resolveCurrentPath(),
            'pageName'  =>  "page",
        ]);
    }
}
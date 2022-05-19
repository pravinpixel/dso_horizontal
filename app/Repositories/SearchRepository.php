<?php

namespace App\Repositories;

use App\Interfaces\SearchRepositoryInterface;
use App\Models\MaterialProducts;
use App\Models\SaveMySearch;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
  
class SearchRepository implements SearchRepositoryInterface {
    public function bulkSearch($row)
    {
        return MaterialProducts::with("Batches")->where('is_draft', 0)
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
    public function advanced_search($row)
    {
        return MaterialProducts::with("Batches")->where('is_draft', 0)
                                ->WhereHas('Batches', function($q) use ($row){
                                    $q->when(!is_null($row->af_euc_material) ?? !is_null($row->euc_material), function ($q) use ($row)  {
                                        $q->Where('euc_material' , $row->af_euc_material ?? $row->euc_material);
                                    }); 
                                    $q->when(!is_null($row->af_require_bulk_volume_tracking) ?? !is_null($row->require_bulk_volume_tracking), function ($q) use ($row)  {
                                        $q->Where('require_bulk_volume_tracking' , $row->af_require_bulk_volume_tracking ?? $row->require_bulk_volume_tracking);
                                    });
                                    $q->when(!is_null($row->af_require_outlife_tracking) ?? !is_null($row->require_outlife_tracking), function ($q) use ($row)  {
                                        $q->Where('require_outlife_tracking' , $row->af_require_outlife_tracking ?? $row->require_outlife_tracking);
                                    });
                                    $q->when(!is_null($row->af_cas) ?? !is_null($row->cas), function ($q) use ($row)  {
                                        $q->Where('cas' , $row->af_cas ?? $row->cas);
                                    });
                                    $q->when(!is_null($row->af_supplier) ?? !is_null($row->supplier), function ($q) use ($row)  {
                                        $q->where('supplier', 'LIKE', '%' .$row->supplier.'%');
                                    });
                                    $q->when(!is_null($row->af_batch) ?? !is_null($row->batch), function ($q) use ($row)  {
                                        $q->where('batch', 'LIKE', '%' .$row->batch.'%');
                                    });
                                }) 
                                ->paginate(5);
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
}
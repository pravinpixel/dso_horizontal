<?php

namespace App\Repositories;

use App\Interfaces\SearchRepositoryInterface;
use App\Models\MaterialProducts;
use App\Models\SaveMySearch;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
  
class SearchRepository implements SearchRepositoryInterface {
    public function bulkSearch($row)
    {
        return MaterialProducts::where('is_draft', 0)
                                ->when($row->category_selection, function ($q) use ($row) {
                                    $q->where('category_selection' , $row->category_selection ?? null);
                                })
                                ->when($row->item_description, function ($q) use ($row)  {
                                    $q->where('item_description', 'LIKE', '%' . $row->item_description ?? null .'%');
                                })
                                ->when($row->owner, function ($q) use ($row)  {
                                    $q->where('owner_one' , $row->owner  ?? null);
                                    // $q->where('owner_two' , $row->owner  ?? null);
                                })
                                ->when($row->brand, function ($q) use ($row)  {
                                    $q->where('brand' , $row->brand  ?? null);
                                })
                                ->when($row->dept, function ($q) use ($row)  {
                                    $q->where('department' , $row->dept  ?? null);
                                })
                                ->when($row->storage_area, function ($q) use ($row)  {
                                    $q->where('storage_room' , $row->storage_area  ?? null);
                                })
                                ->when($row->date_in, function ($q) use ($row)  {
                                    $q->where('created_at' , $row->date_in  ?? null);
                                })
                                ->paginate(5);
    }
    public function advanced_search($row)
    {
        return MaterialProducts::where('is_draft', 0)
                                ->when($row->af_logsheet_id ?? $row->logsheet_id, function ($q) use ($row)  {
                                    $q->where('in_house_product_logsheet_id', 'LIKE', '%' . $row->af_logsheet_id ?? $row->logsheet_id.'%');
                                })
                                ->when($row->af_supplier ?? $row->supplier, function ($q) use ($row)  {
                                    $q->Where('supplier' , $row->af_supplier ?? $row->supplier);
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
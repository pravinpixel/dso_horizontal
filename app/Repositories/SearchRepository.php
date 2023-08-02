<?php

namespace App\Repositories;

use App\Interfaces\DsoRepositoryInterface;
use App\Interfaces\SearchRepositoryInterface;
use App\Models\Batches;
use App\Models\MaterialProducts;
use App\Models\SaveMySearch;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class SearchRepository implements SearchRepositoryInterface
{
    public $dsoRepository;
    public function __construct(DsoRepositoryInterface $dsoRepositoryInterface)
    {
        $this->dsoRepository    = $dsoRepositoryInterface;
    }
    public function barCodeSearch($request)
    {
        try {
            $parent_id = Batches::where('is_draft', 0)
                ->where('end_of_batch', 0)
                ->where('barcode_number', (string) $request->filters)->first()->material_product_id;
            $material_product_data = MaterialProducts::with([
                'Batches',
                'Batches.RepackOutlife',
                'Batches.HousingType',
                'Batches.Department',
                'UnitOfMeasure',
                'Batches.StorageArea',
                'Batches.StatutoryBody',
                'Batches.DeductTrackUsage',
                'Batches.BatchMaterialProduct',
                'Batches.BatchOwners'
            ])
                ->WhereHas('Batches', function ($q) use ($parent_id) {
                    $q->where('material_product_id', $parent_id);
                })
                ->latest()
                ->get();
            return $this->dsoRepository->renderTableData($material_product_data, null);
        } catch (\Throwable $th) {
            log::info($th->getMessage());
        }
    }

    public function advanced_search($filter)
    {
        $material_table =  [
            'quantity',
            'category_selection',
            'item_description',
            'unit_of_measure',
            'unit_packing_value',
            'alert_threshold_qty_upper_limit',
            'alert_threshold_qty_lower_limit',
            'alert_before_expiry',
        ];
        $material_product_data =  MaterialProducts::with([
            'Batches' => function ($q) use ($filter, $material_table) {
                $this->searchFilter($q, $filter, $material_table);
            },
            'Batches.RepackOutlife', 'Batches.BatchOwners', 'Batches.HousingType', 'Batches.Department', 'UnitOfMeasure', 'Batches.StorageArea', 'Batches.StatutoryBody', 'Batches.BatchMaterialProduct'
        ])->when(true, function ($q) use ($filter, $material_table) {
            foreach ($filter as $column => $value) {
                if (in_array($column, $material_table)) {
                    if (!empty($value)) {
                        $q->where($column, $value);
                    }
                }
            }
        })->WhereHas('Batches', function ($q) use ($filter, $material_table) {
            $this->searchFilter($q, $filter, $material_table);
        })->latest()->get();
        return $this->dsoRepository->renderTableData($material_product_data, null);
    }
    public function sortingOrder($sort_by)
    {
        if (checkIsMaterialColumn($sort_by->col_name) == 1) {
            $material_product_data =  MaterialProducts::with([
                'Batches',
                'Batches.RepackOutlife',
                'Batches.HousingType',
                'Batches.Department',
                'UnitOfMeasure',
                'Batches.StorageArea',
                'Batches.StatutoryBody',
                'Batches.BatchMaterialProduct',
                'Batches.BatchOwners'
            ])
                ->orderBy($sort_by->col_name, $sort_by->order_type)
                ->latest()
                ->get();
            return $this->dsoRepository->renderTableData($material_product_data, null);
        } else {
            $material_product_data = MaterialProducts::with([
                'Batches' => function ($q) use ($sort_by) {
                    $q->orderBy($sort_by->col_name, $sort_by->order_type);
                },
                'Batches.RepackOutlife',
                'Batches.HousingType',
                'Batches.Department',
                'UnitOfMeasure',
                'Batches.StorageArea',
                'Batches.StatutoryBody',
                'Batches.BatchMaterialProduct',
                'Batches.BatchOwners'
            ])->latest()->get();
            return $this->dsoRepository->renderTableData($material_product_data, null);
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
            'outlife_tracking'    =>  $row->af_outlife_tracking
        ]);
    }

    public function searchFilter($q, $filter, $material_table)
    {
        foreach ($filter as $column => $value) {
            if (in_array($column, $material_table) != 1) {
                if (checkIsBatchDateColumn($column)) {
                    $q->whereDate($column, '>=', $value['startDate'])->whereDate($column, '<=', $value['endDate']);
                } elseif ($column == 'owners') {
                    $inputArray = Arr::pluck($filter->owners, 'id');
                    $request_ownners = implode(",", $inputArray);
                    if (!empty($request_ownners)) {
                        if (count($filter->owners) > 1) {
                            $q->whereIn('owners', array_permute($inputArray, false));
                        } else {
                            $q->whereRaw('FIND_IN_SET(' . $request_ownners . ', owners)');
                        }
                    }
                } else {
                    if (!empty($value) && !is_null($value)) {
                        $q->where($column, $value);
                    }
                }
            }
        }
        $q->where('is_draft', 0);
    }
}

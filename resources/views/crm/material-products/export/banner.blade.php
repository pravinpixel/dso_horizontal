<table border="1">
    <thead>
        <tr>
                              <th>
                                id
                            </th>
                            <th>
                                category_selection
                            </th>
                             <th>
                                item_description
                            </th>
                             <th>
                                 unit_of_measure
                            </th>
                             <th>
                                unit_packing_value
                            </th>
                             <th>
                                alert_threshold_qty_upper_limit
                            </th>
                            <th>
                         alert_threshold_qty_lower_limit
                            </th> 
                             <th>
                             alert_before_expiry
                            </th>
                             <th>
                             brand
                            </th>        
                             <th>
                             supplier
                            </th>   
                             <th>
                             quantity
                            </th>   
                             <th>
                             batch
                            </th>   
                             <th>
                             serial
                            </th>   
                             <th>
                             po_number
                            </th>   
                             <th>
                             statutory_body
                            </th>   
                             <th>
                             euc_material
                            </th>   
                             <th>
                             require_bulk_volume_tracking
                            </th>   
                             <th>
                             require_outlife_tracking
                            </th>   

                             <th>
                             outlife
                            </th>   
                             <th>
                             storage_area
                            </th>
                             <th>
                             housing_type
                            </th>   
                             <th>
                             housing
                            </th>
                             <th>
                             department
                            </th>
                             <th>
                             date_in
                            </th>
                             <th>
                             date_of_expiry
                            </th>
                             <th>
                             iqc_status
                            </th>
                             <th>
                             cas
                            </th>
                            <th>
                             access
                            </th>
                             <th>
                             fm_1202
                            </th>
                             <th>
                             project_name
                            </th>
                             <th>
                             material_product_type
                            </th>
                             <th>
                             date_of_manufacture
                            </th>
                             <th>
                             date_of_shipment
                            </th>
                             <th>
                             cost_per_unit
                            </th>
                             <th>
                             no_of_extension
                            </th> 
                            <th>
                             type
                            </th> 

        </tr>
    </thead>
    <tbody>
        @foreach($data as $parent)

        <tr>
            <td>{{$parent->id}}</td>
            <td>{{$parent->category_selection}}</td>
            <td>{{$parent->item_description}}</td>
            <td>{{$parent->unit_of_measure}}</td>
            <td>{{$parent->unit_packing_value}}</td>
            <td>{{$parent->alert_threshold_qty_upper_limit}}</td>
            <td>{{$parent->alert_threshold_qty_lower_limit}}</td>
            <td>{{$parent->alert_before_expiry}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
              <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>parent</td>

        </tr>
        @foreach($parent->Batches as $child)
         <tr>
            <td>{{$child->material_product_id }}</td>
            <td>{{$parent->category_selection}}</td>
            <td>{{$parent->item_description}}</td>
            <td>{{$parent->UnitOfMeasure->name}}</td>
            <td>{{$parent->unit_packing_value}}</td>
            <td>{{$parent->alert_threshold_qty_upper_limit}}</td>
            <td>{{$parent->alert_threshold_qty_lower_limit}}</td>
            <td>{{$parent->alert_before_expiry}}</td>
            <td>{{$child->brand}}</td>
            <td>{{$child->supplier}}</td>
            <td>{{$child->quantity}}</td>
            <td>{{$child->batch}}</td>
            <td>{{$child->serial}}</td>
            <td>{{$child->po_number}}</td>
            <td>{{$child->StatutoryBody->name}}</td>
            <td>{{$child->euc_material}}</td>
            <td>{{$child->require_bulk_volume_tracking}}</td>
            <td>{{$child->require_outlife_tracking}}</td>
            <td>{{$child->outlife}}</td>
            <td>{{$child->StorageArea->name}}</td>
            <td>{{$child->HousingType->name}}</td>
            <td>{{$child->housing}}</td>
            <td>{{$child->Department->name}}</td>
            <td>{{$child->date_in}}</td>
            <td>{{$child->date_of_expiry}}</td>
            <td>{{$child->iqc_status}}</td>
            <td>{{$child->cas}}</td>
            <td>{{$child->access}}</td>
            <td>{{$child->fm_1202}}</td>
            <td>{{$child->project_name}}</td>
            <td>{{$child->material_product_type}}</td>
            <td>{{$child->date_of_manufacture}}</td>
            <td>{{$child->date_of_shipment}}</td>
            <td>{{$child->cost_per_unit}}</td>
            <td>{{$child->no_of_extension}}</td>
            <td>child</td>
        </tr>
        @endforeach
        @endforeach
        
    </tbody>
</table>
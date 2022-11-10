<ol class="list-group list-group-numbered" style="overflow: hidden">
    @if ($batch->BatchMaterialProduct->category_selection)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Category selection</div>
            {{ ucfirst(str_replace('_','-',$batch->BatchMaterialProduct->category_selection)) }}
            </div>
        </li>
    @endif
    @if ($batch->BatchMaterialProduct->item_description)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Item Description</div>
            {{ $batch->BatchMaterialProduct->item_description }}
            </div>
        </li>
    @endif
    @if ($batch->brand )
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Brand</div>
                {{ $batch->brand }}
            </div>
        </li>
    @endif
    @if ($batch->supplier)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Supplier</div>
                {{ $batch->supplier }}
            </div>
        </li>
    @endif
    @if ($batch->unit_packing_value)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Packing size</div>
            {{ $batch->unit_packing_value }}
            </div>
        </li>
    @endif
    @if ($batch->quantity)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Quantity</div>
                {{ $batch->quantity }}
            </div>
        </li>
    @endif
    @if ($batch->batch)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Batch #</div>
                {{ $batch->batch }}
            </div>
        </li>
    @endif
    @if ($batch->serial)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Serial#</div>
            {{ $batch->serial }}
            </div>
        </li>
    @endif
    @if ($batch->po_number)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">PO #</div>
                {{ $batch->po_number }}
            </div>
        </li>
    @endif
    @if ($batch->StatutoryBody)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Statutory body</div>
                {{ $batch->StatutoryBody->name }}
            </div>
        </li>
    @endif
    @if (!is_null($batch->euc_material))
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">EUC material</div>
                @if ($batch->euc_material)
                        <span class="badge bg-success rounded-pill">YES</span>
                    @else
                    <span class="badge bg-danger rounded-pill">NO</span>
                @endif
            </div>
        </li>
    @endif
    @if (!is_null($batch->require_bulk_volume_tracking))
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Require bulk volume tracking</div>
                @if ($batch->require_bulk_volume_tracking)
                        <span class="badge bg-success rounded-pill">YES</span>
                    @else
                    <span class="badge bg-danger rounded-pill">NO</span>
                @endif
            </div> 
        </li>
    @endif
    @if (!is_null($batch->require_outlife_tracking))
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Require outlife tracking and outlife (days)</div> 
                @if ($batch->require_outlife_tracking)
                        <span class="badge bg-success rounded-pill">YES</span>
                    @else
                    <span class="badge bg-danger rounded-pill">NO</span>
                @endif
                @if ($batch->outlife)
                    <span class="badge bg-light text-dark border border-dark ms-1 rounded-pill">{{ $batch->outlife }} Days</span>
                @endif
            </div>
        </li>
    @endif
    @if ($batch->HousingType)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Housing type and #</div>
                {{ $batch->HousingType->name }} /  {{ $batch->housing }}
            </div>
        </li>
    @endif
    @if ($batch->owner_one || $batch->owner_two)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Owner 1/Owner 2 (SE/PL/FM)</div>
                {{ $batch->owner_one." / ".$batch->owner_two }}
            </div>
        </li>
    @endif
    @if ($batch->Department)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Department</div>
                {{ $batch->Department->name }}
            </div>
        </li>
    @endif
    @if(json_decode($batch->access))
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Access</div>
            @foreach (json_decode($batch->access) as $user_id)
                    <span class="badge badge-outline-primary rounded-pill">{{ getUserById($user_id)->alias_name }}</span> 
            @endforeach
            </div>
        </li>
    @endif
    @if ($batch->date_in)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Date in</div>
                {{ SetDateFormat($batch->date_in) }}
            </div>
        </li>
    @endif
    @if ($batch->date_of_expiry)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Date of expiry</div>
                {{ SetDateFormat($batch->date_of_expiry) }}
            </div>
        </li>
    @endif
    @if (!is_null($batch->sds))
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100 " class="w-100">
                <div class="fw-bold mb-1">SDS</div> 
                <div class="btn-group mt-1">
                    <a data-lightbox="roadtrip" class="badge badge-outline-info rounded-pill" href="{{ asset("storage/app/").'/'.$batch->sds }}" target="_blank"><i class="fa fa-eye me-1"></i>view</a>
                    <button onclick="download('{{ $batch->id }}','sds')" class="badge bg-warning rounded-pill text-dark ms-1 border-0"><i class="fa fa-download me-1"></i>Download</button>
                </div>
            </div>
        </li> 
    @endif
    @if (!is_null($batch->BatchFiles))
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100 " class="w-100">
                <div class="fw-bold mb-1">COC/COA/Mill Cert</div> 
                @foreach ($batch->BatchFiles as $coc)
                    <div class="btn-group mt-1">
                        <a data-lightbox="roadtrip" class="badge badge-outline-info rounded-pill" href="{{ asset("storage/app/").'/'.$batch->coc_coa_mill_cert }}" target="_blank"><i class="fa fa-eye me-1"></i>view</a>
                        <button onclick="download('{{ $coc->id }}','coc_coa_mill_cert')" class="badge bg-warning rounded-pill text-dark ms-1 border-0"><i class="fa fa-download me-1"></i>Download</button>
                    </div>
                @endforeach 
            </div>
        </li>
    @endif
    @if (!is_null($batch->iqc_status))
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">IQC status (P/F)</div>
                @if ($batch->iqc_status)
                        <span class="badge bg-success rounded-pill">YES</span>
                    @else
                    <span class="badge bg-danger rounded-pill">NO</span>
                @endif
            </div>
        </li>
    @endif
    @if (!is_null($batch->iqc_result))
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100 " class="w-100">
                <div class="fw-bold mb-1">IQC result</div>
                <div>
                    <a data-lightbox="roadtrip" class="badge badge-outline-info rounded-pill" href="{{ asset("storage/app/").'/'.$batch->iqc_result }}" target="_blank"><i class="fa fa-eye me-1"></i>view</a>
                    <button onclick="download('{{ $batch->id }}','iqc_result')" class="badge bg-warning rounded-pill text-dark ms-1 border-0"><i class="fa fa-download me-1"></i>Download</button>
                </div>
            </div>
        </li>
    @endif
    @if ($batch->cas)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">CAS #</div>
                {{ $batch->cas }}
            </div>
        </li>
    @endif
    @if ($batch->fm_1202)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">FM1202</div>
                {{ $batch->fm_1202 }}
            </div>
        </li>
    @endif
    @if ($batch->project_name)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Project name</div>
                {{ $batch->project_name }}
            </div>
        </li>
    @endif
    @if ($batch->material_product_type)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Material/Product type</div>
                {{ $batch->material_product_type }}
            </div>
        </li>
    @endif
    @if ($batch->date_of_manufacture)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Date of manufacture</div>
                {{ SetDateFormat($batch->date_of_manufacture) }}
            </div>
        </li>
    @endif
    @if ($batch->date_of_shipment)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Date of shipment</div>
                {{ SetDateFormat($batch->date_of_shipment) }}
            </div>
        </li>
    @endif
    @if ($batch->cost_per_unit)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1 d-flex">Cost per unit <small class="sgd"> S$ </small></div>
                {{ $batch->cost_per_unit }}
            </div>
        </li>
    @endif
    @if ($batch->remarks)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Remarks</div>
                {{ $batch->remarks }}
            </div>
        </li>
    @endif
    @if ($batch->extended_expiry)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Extended expiry</div>
                {{ $batch->extended_expiry }}
            </div>
        </li>
    @endif
    @if (!is_null($batch->extended_qc_status))
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Extended QC status (P/F)</div>
                @if ($batch->extended_qc_status)
                        <span class="badge bg-success rounded-pill">YES</span>
                    @else
                    <span class="badge bg-danger rounded-pill">NO</span>
                @endif
            </div>
        </li>
    @endif
    @if ($batch->extended_qc_result)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Extended QC result</div>
                {{ $batch->extended_qc_result }}
            </div>
        </li>
    @endif
    @if ($batch->disposal_certificate)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Disposed certificate</div>
                {{ $batch->disposal_certificate }}
            </div>
        </li>
    @endif
    @if ($batch->used_for_td_expt_only)
        <li class="list-group-item list-group-item-action d-flex align-self-start" >
            <div class="w-100">
                <div class="fw-bold mb-1">Used for TD/Expt only</div> 
                @if ($batch->used_for_td_expt_only)
                        <span class="badge bg-success rounded-pill">YES</span>
                    @else
                    <span class="badge bg-danger rounded-pill">NO</span>
                @endif
            </div>
        </li> 
    @endif
</ol> 
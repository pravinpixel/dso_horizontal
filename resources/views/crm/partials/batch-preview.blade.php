<ol class="list-group list-group-numbered" style="overflow: hidden">
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Category selection</div>
            {{ ucfirst(str_replace('_', '-', $batch->BatchMaterialProduct->category_selection ?? '')) }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Item description</div>
            {{ $batch->BatchMaterialProduct->item_description ?? '' }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Brand</div>
            {{ $batch->brand ?? '' }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Supplier</div>
            {{ $batch->supplier ?? '' }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Packing size</div>
            {{ $batch->unit_packing_value ?? '' }} {{ $batch->BatchMaterialProduct->UnitOfMeasure->name }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Quantity</div>
            {{ $batch->quantity ?? '' }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Batch #</div>
            {{ $batch->batch ?? '' }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Serial#</div>
            {{ $batch->serial ?? '' }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">PO #</div>
            {{ $batch->po_number ?? '' }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Statutory body</div>
            {{ $batch->StatutoryBody->name ?? '' }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">EUC material</div>
            @if ($batch->euc_material ?? false)
                <span class="badge bg-success rounded-pill">YES</span>
            @else
                <span class="badge bg-danger rounded-pill">NO</span>
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Require bulk volume tracking</div>
            @if ($batch->require_bulk_volume_tracking ?? false)
                <span class="badge bg-success rounded-pill">YES</span>
            @else
                <span class="badge bg-danger rounded-pill">NO</span>
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Require outlife tracking and outlife (days)</div>
            @if ($batch->require_outlife_tracking ?? false)
                <span class="badge bg-success rounded-pill">YES</span>
            @else
                <span class="badge bg-danger rounded-pill">NO</span>
            @endif
            @if ($batch->outlife)
                <span class="badge bg-light text-dark border border-dark ms-1 rounded-pill">{{ $batch->outlife }} </span>
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Housing type and #</div>
            @if ($batch->HousingType)
                {{ $batch->HousingType->name }} / {{ $batch->housing }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Owners (SE/PL/FM)</div>
            @if (count($batch->BatchOwners ?? []))
                @foreach ($batch->BatchOwners as $key => $owner)
                    @if ($owner->alias_name ?? false)
                        <small class="badge mb-1 me-1 badge-outline-dark shadow-sm bg-light rounded-pill">
                            {{ $owner->alias_name }}
                        </small>
                    @endif
                @endforeach
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Department</div>
            @if ($batch->Department)
                {{ $batch->Department->name }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Storage area</div>
            @if ($batch->StorageArea)
                {{ $batch->StorageArea->name }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Access</div>
            @if (json_decode($batch->access))
                @foreach (json_decode($batch->access) as $user_id)
                    <span
                        class="badge badge-outline-primary rounded-pill">{{ getUserById($user_id)->alias_name }}</span>
                @endforeach
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Date in</div>
            @if ($batch->date_in)
                {{ SetDateFormat($batch->date_in) }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Date of expiry</div>
            @if ($batch->date_of_expiry)
                {{ SetDateFormat($batch->date_of_expiry) }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100 " class="w-100">
            <div class="fw-bold mb-1">SDS</div>
            @if (!is_null($batch->sds))
                <div class="btn-group mt-1">
                    <a data-lightbox="roadtrip" class="badge badge-outline-info rounded-pill"
                        href="{{ asset('storage/app/') . '/' . $batch->sds }}" target="_blank"><i
                            class="fa fa-eye me-1"></i>view</a>
                    <button onclick="download('{{ $batch->id }}','sds')"
                        class="badge bg-warning rounded-pill text-dark ms-1 border-0"><i
                            class="fa fa-download me-1"></i>Download</button>
                </div>
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100 " class="w-100">
            <div class="fw-bold mb-1">COC/COA/Mill Cert</div>
            @if (!is_null($batch->BatchFiles))
                @foreach ($batch->BatchFiles as $coc)
                    <div class="btn-group mt-1">
                        <a class="badge badge-outline-info rounded-pill" href="{{ asset('storage/app/') . '/' . $coc->file_name }}" target="_blank"><i class="fa fa-eye me-1"></i>view</a>
                        <button onclick="download('{{ $coc->id }}','coc_coa_mill_cert')" class="badge bg-warning rounded-pill text-dark ms-1 border-0"><i class="fa fa-download me-1"></i>Download</button>
                    </div>
                @endforeach
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">IQC status (P/F)</div>
            @if (!is_null($batch->iqc_status))
                @if ($batch->iqc_status)
                    <span class="badge bg-success rounded-pill">PASS</span>
                @else
                    <span class="badge bg-danger rounded-pill">FAIL</span>
                @endif
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100 " class="w-100">
            <div class="fw-bold mb-1">IQC result</div>
            @if (!is_null($batch->iqc_result))
                <div>
                    <a data-lightbox="roadtrip" class="badge badge-outline-info rounded-pill"
                        href="{{ asset('storage/app/') . '/' . $batch->iqc_result }}" target="_blank"><i
                            class="fa fa-eye me-1"></i>view</a>
                    <button onclick="download('{{ $batch->id }}','iqc_result')"
                        class="badge bg-warning rounded-pill text-dark ms-1 border-0"><i
                            class="fa fa-download me-1"></i>Download</button>
                </div>
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">CAS #</div>
            @if ($batch->cas)
                {{ $batch->cas }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">FM1202</div>
            @if ($batch->fm_1202)
                @if ($batch->fm_1202 == 'on')
                    <span class="badge bg-success rounded-pill">Yes</span>
                @else
                    <span class="badge bg-danger rounded-pill">No</span>
                @endif
            @endif
        </div>
    </li>
    @if ($batch->project_name)
        <li class="list-group-item list-group-item-action d-flex align-self-start">
            <div class="w-100">
                <div class="fw-bold mb-1">Project name</div>
                {{ $batch->project_name }}
            </div>
        </li>
    @endif
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Material/Product type</div>
            @if ($batch->material_product_type)
                {{ $batch->material_product_type }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Date of manufacture</div>
            @if ($batch->date_of_manufacture)
                {{ SetDateFormat($batch->date_of_manufacture) }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Date of shipment</div>
            @if ($batch->date_of_shipment)
                {{ SetDateFormat($batch->date_of_shipment) }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1 d-flex">Cost per unit <small class="sgd"> S$ </small></div>
            @if ($batch->cost_per_unit)
                {{ $batch->cost_per_unit }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Remarks</div>
            @if ($batch->remarks)
                {{ $batch->remarks }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">No.of extension</div>
            @if ($batch->no_of_extension)
                {{ $batch->no_of_extension }}
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Extended QC status (P/F)</div>
            @if (!is_null($batch->extended_qc_status))
                @if ($batch->extended_qc_status)
                    <span class="badge bg-success rounded-pill">Pass</span>
                @else
                    <span class="badge bg-danger rounded-pill">Fail</span>
                @endif
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Extended QC result</div>
            @if (!is_null($batch->extended_qc_result))
                <div class="btn-group mt-1">
                    <a data-lightbox="roadtrip" class="badge badge-outline-info rounded-pill"
                        href="{{ asset('storage/app/') . '/' . $batch->extended_qc_result }}" target="_blank"><i
                            class="fa fa-eye me-1"></i>view</a>
                    <button onclick="download('{{ $batch->id }}','extended_qc_result')"
                        class="badge bg-warning rounded-pill text-dark ms-1 border-0"><i
                            class="fa fa-download me-1"></i>Download</button>
                </div>
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Disposed certificate</div>
            @if (!is_null($batch->disposal_certificate))
                <div class="btn-group mt-1">
                    <a data-lightbox="roadtrip" class="badge badge-outline-info rounded-pill"
                        href="{{ asset('storage/app/') . '/' . $batch->disposal_certificate }}" target="_blank"><i
                            class="fa fa-eye me-1"></i>view</a>
                    <button onclick="download('{{ $batch->id }}','disposal_certificate')"
                        class="badge bg-warning rounded-pill text-dark ms-1 border-0"><i
                            class="fa fa-download me-1"></i>Download</button>
                </div>
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Used for TD/Expt only</div>
            @if ($batch->coc_coa_mill_cert_status)
                @if ($batch->coc_coa_mill_cert_status == 'on')
                    <span class="badge bg-success rounded-pill">YES</span>
                @else
                    <span class="badge bg-danger rounded-pill">NO</span>
                @endif
            @endif
            @if (!is_null($batch->used_for_td_certificate))
            <br>
                <div class="btn-group mt-1">
                    <a data-lightbox="roadtrip" class="badge badge-outline-info rounded-pill"
                        href="{{ asset('storage/app/') . '/' . $batch->used_for_td_certificate }}" target="_blank"><i
                            class="fa fa-eye me-1"></i>view</a>
                    <button onclick="download('{{ $batch->id }}','used_for_td_certificate')"
                        class="badge bg-warning rounded-pill text-dark ms-1 border-0"><i
                            class="fa fa-download me-1"></i>Download</button>
                </div>
            @endif
        </div>
    </li>
</ol>

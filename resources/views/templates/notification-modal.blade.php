@if (count($material_products))
    @foreach ($material_products as $material)
        <li class="list-group-item list-group-item-action btn">
            <a href="{{ route('threshold-qty') }}" class="text-dark">
                <div>
                    <b class="text-primary">
                        <i class="bi bi-bell-fill {{ $material->material_quantity_color }}"></i>
                        {{ $material->item_description }}
                    </b>
                </div>
                <small>
                    <b class="text-dark">Unit packing value :</b>
                    {{ $material->unit_packing_value }} </small> <br>
                <small><b class="text-dark">Quantity :</b> {{ $material->material_quantity }} </small>
                <small class="float-end  {{ $material->material_quantity_color }}">
                    <i class="bi bi-calendar2-week"></i>
                    {{ $material->updated_at->format('d/m/Y h:i:s A') }}
                </small>
            </a>
        </li>
    @endforeach
@endif
@foreach ($notification_data as $type => $data)
    @if (count($data))
        <div class="card my-2 border">
            <div class="card-header bg-light fw-bold text-dark">
                @if ($type === 'NEAR_EXPIRY_TABLE')
                    NEAR EXPIRY PRODUCTS
                @elseif ($type === 'EXPIRY_TABLE')
                    EXPIRED PRODUCTS
                @else
                    FAILED IQC PRODUCTS
                @endif
            </div>
            @foreach ($data as $row)
                <li class="list-group-item list-group-item-action btn">
                    <div class="text-dark">
                        <a href="{{ route('near-expiry-expired') }}">
                            <b class="text-primary">
                                {{ $row->Batches->BatchMaterialProduct->item_description }}
                            </b>
                        </a>
                        <a href="{{ route('near-expiry-expired') }}">
                            <small>
                                <b class="text-dark">IQC Staus :</b>
                                @if ($row->Batches->iqc_status)
                                    <span class="badge bg-success rounded-pill">PASS</span>
                                @else
                                    <span class="badge bg-danger rounded-pill">FAIL</span>
                                @endif <br>
                                {{ $row->updated_at->format('d/m/Y h:i:s A') }}
                            </small>
                        </a>
                        <div class="float-end">
                            <button onclick="removeNotification({{ $row->id }}, this)"
                                class="btn-warning btn-sm btn rounded-pill small p-0 px-1 border border-dark shadow"><i
                                    class="me-1 bi bi-bookmark-check-fill"></i>Mark as read</button>
                        </div>
                    </div>
                </li>
            @endforeach
        </div>
    @endif
@endforeach

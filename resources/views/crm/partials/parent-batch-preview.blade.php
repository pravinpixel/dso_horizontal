<ol class="list-group list-group-numbered">

    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" ng-repeat="(index, row) in view_material_product_data">
        <div class="w-100">
            <div class="fw-bold">Category Selection</div>
            {{ $material->category_selection == 'in_house' ? 'In-house Product' : 'Material'  }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" ng-repeat="(index, row) in view_material_product_data">
        <div class="w-100">
            <div class="fw-bold">Item description</div>
            {{ $material->item_description }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" ng-repeat="(index, row) in view_material_product_data">
        <div class="w-100">
            <div class="fw-bold">Unit Packing size</div>
            {{ $material->unit_packing_value }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" ng-repeat="(index, row) in view_material_product_data">
        <div class="w-100">
            <div class="fw-bold">Statutory body</div>
            {{ $material->Batches[0]->statutory_body ?? '-' }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex align-self-start">
        <div class="w-100">
            <div class="fw-bold mb-1">Owners</div>
            @if (count($material->Batches[0]->BatchOwners ?? []))
                @foreach ($material->Batches[0]->BatchOwners as $key => $owner)
                    @if ($owner->alias_name ?? false)
                        <small class="badge mb-1 me-1 badge-outline-dark shadow-sm bg-light rounded-pill">
                            {{ $owner->alias_name }}
                        </small>
                    @endif
                @endforeach
            @endif
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" ng-repeat="(index, row) in view_material_product_data">
        <div class="w-100">
            <div class="fw-bold">Alert threshold Qty (upper limit)</div>
            {{ $material->alert_threshold_qty_upper_limit }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" ng-repeat="(index, row) in view_material_product_data">
        <div class="w-100">
            <div class="fw-bold">Alert threshold Qty (lower limit) </div>
            {{ $material->alert_threshold_qty_lower_limit }}
        </div>
    </li>
    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" ng-repeat="(index, row) in view_material_product_data">
        <div class="w-100">
            <div class="fw-bold">Alert before expiry (in weeks)</div>
            {{ $material->alert_before_expiry }}
        </div>
    </li>
</ol>
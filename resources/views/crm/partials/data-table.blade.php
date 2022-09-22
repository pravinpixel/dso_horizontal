<div class="table-responsive shadow-lg bg-white position-relative">
    <div class="loader"></div> 
    <div class="custom-table" style=" min-height: {{ $page_name != 'MATERIAL_WITHDRAWAL' ? '460px' : 'auto'}} !important;" >
        <div class="custom-table-head">
            {{-- ======= Table Header  ====== --}}
                {!! $table_th_columns !!}
            {{-- ======= Table Header  ====== --}}
        </div>
        <div class="custom-table-body">
           <b class="jhfs"> @{{ row.hideParentRow }}</b>
            {{-- ng-if="row.hideParentRow == 0" --}}
            @switch($page_name)
                @case('THRESHOLD_QTY')
                    <div class="custom-table-row" ng-repeat="(index,row) in material_products.data">
                @break  
                @default
                <div class="custom-table-row" ng-repeat="(index,row) in material_products.data">
            @endswitch
            
                {{--  ng-if="row.access.includes(auth_id) || auth_role == 'admin'"  > --}}
                <div class="custom-table">
                    <div class="custom-table-head parent-row"> 
                        {{-- ======= Matrial Product Data  ====== --}}
                            {!! $table_td_columns !!} 
                        {{-- ======= Matrial Product Data  ====== --}}
                    </div>
                    <div class="custom-table collapse show batch-table" id="row_@{{ index+1 }}">
                        {{-- ======= Matrial Product Batches Data  ====== --}} 
                            @switch($page_name)
                                @case('MATERIAL_SEARCH_OR_ADD')
                                    <div class="custom-table-row " ng-repeat="batch in row.batches" ng-class="batch.is_draft == 1 ? 'drafted' : 'non-drafted'">
                                        {!! $batch_table_td_columns !!} 
                                    </div>
                                @break
                                @case('PRINT_BARCODE_LABEL')
                                    <div class="custom-table-row" ng-repeat="batch in row.batches" ng-if="batch.is_draft != 1">
                                        {!! $batch_table_td_columns !!} 
                                    </div>
                                @break
                                @case('THRESHOLD_QTY')
                                    <div class="custom-table-row" ng-repeat="batch in row.batches" ng-class="batch.is_draft == 1 ? 'drafted' : 'non-drafted'">
                                        {!! $batch_table_td_columns !!}
                                    </div>
                                @break  
                                @default
                                {{-- ng-class="batch.is_draft == 1 ? 'drafted' : 'non-drafted'" --}}
                                <div class="custom-table-row " ng-repeat="batch in row.batches" ng-class="barcode_number == batch.barcode_number ? 'selected-batch' : ''" >
                                    {!! $batch_table_td_columns !!} 
                                </div>
                            @endswitch
                        {{-- ======= Matrial Product Batches Data  ====== --}}
                    </div>
                </div>
            </div> 
            <div ng-show="material_products.data.length == 0">
                {!! no_data_found() !!}
            </div>
        </div>
    </div>
</div>
@if ($page_name !== 'MATERIAL_WITHDRAWAL')
    <div class="py-3">
        <page-pagination>
        </page-pagination>
    </div>
@endif

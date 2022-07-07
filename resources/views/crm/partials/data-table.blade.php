<div class="table-responsive shadow-lg bg-white">
    <div class="custom-table d-none" style=" min-height: 460px !important;">
        <div class="custom-table-head">
            {{-- ======= Table Header  ====== --}}
                {!! $table_th_columns !!}
            {{-- ======= Table Header  ====== --}}
        </div>
        <div class="custom-table-body">
            <div class="custom-table-row"  ng-repeat="(index,row) in material_products.data">
                {{--  ng-if="row.access.includes(auth_id) || auth_role == 'admin'"  > --}}
                <div class="custom-table">
                    <div class="custom-table-head parent-row">
                        {{-- ======= Matrial Product Data  ====== --}}
                            {!! $table_td_columns !!} 
                        {{-- ======= Matrial Product Data  ====== --}}
                    </div>
                    <div class="custom-table collapse show batch-table" id="row_@{{ index+1 }}">
                        <div class="custom-table-row " ng-repeat="batch in row.batches" ng-class="batch.is_draft == 1 ? 'drafted' : 'non-drafted'">
                            {{-- ======= Matrial Product Batches Data  ====== --}}
                                {!! $batch_table_td_columns !!} 
                            {{-- ======= Matrial Product Batches Data  ====== --}}
                        </div>
                    </div>
                </div>
            </div> 
            <div ng-show="material_products.data.length == 0">
                <div colspan="12" class="text-center" >
                    No data found
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-3">
    <page-pagination>
    </page-pagination>
</div>
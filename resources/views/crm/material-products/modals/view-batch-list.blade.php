<div id="View_Batch_Details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog w-100 modal-right h-100">
        <div class="modal-content h-100 rounded-0">
            <div class="modal-header bg-primary text-white border-0 rounded-0">
                <h4>View Batch Details</h4>
                <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
            </div>
            <div class="modal-body modal-scroll-2 p-0"> 
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start" ng-repeat="(index, row) in view_batch_details_data">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">@{{ row.name }}</div>
                            @{{ row.item }}
                        </div>
                    </li>
                </ol> 
            </div> 
        </div> 
    </div>
</div>
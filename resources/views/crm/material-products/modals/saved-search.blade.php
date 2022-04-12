<div id="saved-search-ng-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog w-100 modal-right h-100">
        <div class="modal-content h-100 rounded-0">
            <div class="modal-header bg-primary text-white border-0 rounded-0">
                <h4>My Saved Searches</h4>
                <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
            </div>
            <div class="modal-body modal-scroll">
                <div class="text-s">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action btn" ng-click="search_advanced_mode(row)" ng-repeat="row in view_my_saved_search_list"> @{{ row.search_title }} - <small class="float-end text-secondary">@{{ row.created_at }}</small></li> 
                    </ul>
                </div>
            </div> 
        </div> 
    </div>
</div>
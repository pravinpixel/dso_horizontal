app.directive('pagePagination', function(){
    return{
        restrict: 'E',
        template: `
            <ul class="pagination btn-group pagination-rounded  justify-content-center" ng-show="material_products.data != ''"> 
                <li class="page-item" ng-show="material_products.prev_page_url != null">
                    <a class="page-link shadow-sm"  href="javascript: void(0);" ng-click="next_Prev_page(material_products.prev_page_url)" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item" ng-class="{active : link.active == true}" ng-repeat="(index, link) in material_products.links">
                    <a class="page-link shadow-sm" href="javascript: void(0);" ng-click="next_Prev_page(link.url)" > {{ link.label}}  </a>
                </li>  
                <li class="page-item" ng-show="material_products.next_page_url != null">
                    <a class="page-link shadow-sm" href="javascript: void(0);" ng-click="next_Prev_page(material_products.next_page_url)"  aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        `
    };
});
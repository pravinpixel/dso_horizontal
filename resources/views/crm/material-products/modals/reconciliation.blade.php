 <!-- reconciliation modal -->
 <div id="reconciliation-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reconciliation-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header m-0 border-0 justify-content-end">
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button></div>
            <div class="modal-body">
                <form ng-submit="ReconciliateSave()">
                    <table class="table">
                        <tr>
                            <th>Item description</th>
                            <td>:</td>
                            <td ng-bind="item_description"></td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <td>:</td>
                            <td ng-bind="brand"></td>
                        </tr>
                        <tr>
                            <th>Batch#/Serial#	</th>
                            <td>:</td>
                            <td ng-bind="batch_serial"></td>
                        </tr>
                        <tr>
                            <th>System quantity</th>
                            <td>:</td>
                            <td ng-bind="ReconciliateSystemStock"></td>
                        </tr>
                        <tr>
                            <th>Physical quantity</th>
                            <td>:</td>
                            <td><input type="number" min="1" ng-model="Reconciliate.PhysicalStock" required class="bg-none form-control"></td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td>:</td>
                            <td><textarea type="text" ng-model="Reconciliate.Remarks" class="bg-none form-control" rows="5"></textarea></td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary rounded-pill px-3" value="Submit">
                    </div>
                </form>
            </div> 
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
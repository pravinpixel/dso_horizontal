<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Role Name</label>
    <div class="col-10">
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
</div>
 
<table class="table table-bordered table-centered  tr-sm table-hover">
    <thead class="bg-primary-2 text-white">
        <tr>
            <th rowspan="2" width="200px">Menus</th>
            <th colspan="4"><input onclick="toggle(this);" type="checkbox" class="form-check-input me-2"> Permissions</th>
        </tr>
        <tr>
            <th><input type="checkbox" onclick="view_alls(this);" id="view_all" class="form-check-input me-2"> View</th>
            <th><input type="checkbox" onclick="add_alls(this);" id="add_all"class="form-check-input me-2"> Add</th>
            <th><input type="checkbox" onclick="edit_alls(this);" id="edit_all"class="form-check-input me-2"> Edit</th>
            <th><input type="checkbox" onclick="delete_alls(this);" id="delete_all"class="form-check-input me-2"> Delete</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Withdrawal</th>
            <td><input type="checkbox" {{ $permissions['user.view.withdrawal'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.withdrawal"></td>
            <td><input type="checkbox" {{ $permissions['user.add.withdrawal'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.withdrawal"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.withdrawal'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.withdrawal"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.withdrawal'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.withdrawal"></td>
        </tr>
        <tr>
            <th>Search or Add </th>
            <td><input type="checkbox" {{ $permissions['user.view.search_or_add'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.search_or_add"></td>
            <td><input type="checkbox" {{ $permissions['user.add.search_or_add'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.search_or_add"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.search_or_add'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.search_or_add"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.search_or_add'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.search_or_add"></td>
        </tr>
        <tr>
            <th>Threshold Qty </th>
            <td><input type="checkbox" {{ $permissions['user.view.threshold_qty'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.threshold_qty"></td>
            <td><input type="checkbox" {{ $permissions['user.add.threshold_qty'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.threshold_qty"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.threshold_qty'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.threshold_qty"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.threshold_qty'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.threshold_qty"></td>
        </tr>
        <tr>
            <th>Near Expiry/Expired </th>
            <td><input type="checkbox" {{ $permissions['user.view.near_expiry_and_expired'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.near_expiry_and_expired"></td>
            <td><input type="checkbox" {{ $permissions['user.add.near_expiry_and_expired'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.near_expiry_and_expired"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.near_expiry_and_expired'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.near_expiry_and_expired"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.near_expiry_and_expired'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.near_expiry_and_expired"></td>
        </tr>
        <tr>
            <th>Early Disposal </th>
            <td><input type="checkbox" {{ $permissions['user.view.early_disposal'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.early_disposal"></td>
            <td><input type="checkbox" {{ $permissions['user.add.early_disposal'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.early_disposal"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.early_disposal'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.early_disposal"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.early_disposal'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.early_disposal"></td>
        </tr>
        <tr>
            <th>Extend Expiry </th>
            <td><input type="checkbox" {{ $permissions['user.view.extend_expiry'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.extend_expiry"></td>
            <td><input type="checkbox" {{ $permissions['user.add.extend_expiry'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.extend_expiry"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.extend_expiry'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.extend_expiry"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.extend_expiry'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.extend_expiry"></td>
        </tr>
        <tr>
            <th>Report </th>
            <td><input type="checkbox" {{ $permissions['user.view.report'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.report"></td>
            <td><input type="checkbox" {{ $permissions['user.add.report'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.report"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.report'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.report"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.report'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.report"></td>
        </tr>
        <tr>
            <th>Print Barcode </th>
            <td><input type="checkbox" {{ $permissions['user.view.print_barcode'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.print_barcode"></td>
            <td><input type="checkbox" {{ $permissions['user.add.print_barcode'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.print_barcode"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.print_barcode'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.print_barcode"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.print_barcode'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.print_barcode"></td>
        </tr>
        <tr>
            <th>Reconciliation </th>
            <td><input type="checkbox" {{ $permissions['user.view.reconciliation'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.reconciliation"></td>
            <td><input type="checkbox" {{ $permissions['user.add.reconciliation'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.reconciliation"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.reconciliation'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.reconciliation"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.reconciliation'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.reconciliation"></td>
        </tr>
    </tbody>
</table> 
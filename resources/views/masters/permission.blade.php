@extends('masters.index')

@section('masters')
    <form action="{{ route('store.permission') }}" method="post" class="card">
        @csrf
        
        <table class="table table-bordered table-centered text-center m-0 tr-sm table-hover">
            <thead class="bg-primary-2 text-white">
                <tr>
                    <th colspan="5">
                        <div class="m-0 row col-6 mx-auto">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Choose User :</label>
                            <div class="col-sm-8 p-0">
                                <select name="user_id" class="form-select form-select-sm text-white" style="background: none">
                                    <option value="">-- Select User  --</option>
                                    @foreach ($user as $row)
                                        <option class="text-dark" value="{{ $row->id }}">{{ $row->first_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </th>
                </tr>
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
                    <td><input type="checkbox" value="true" class="view form-check-input" name="user.view.withdrawal"></td>
                    <td><input type="checkbox" value="true" class="add form-check-input" name="user.add.withdrawal"></td>
                    <td><input type="checkbox" value="true" class="edit form-check-input" name="user.edit.withdrawal"></td>
                    <td><input type="checkbox" value="true" class="delete form-check-input" name="user.delete.withdrawal"></td>
                </tr>
                <tr>
                    <th>Search or Add <input value="search_Add" type="hidden" name="menu[]"></th>
                    <td><input type="checkbox" value="true" class="view form-check-input" name="view[]"></td>
                    <td><input type="checkbox" value="true" class="add form-check-input" name="add[]"></td>
                    <td><input type="checkbox" value="true" class="edit form-check-input" name="edit[]"></td>
                    <td><input type="checkbox" value="true" class="delete form-check-input" name="delete[]"></td>
                </tr>
                <tr>
                    <th>Threshold Qty <input value="threshold_qty" type="hidden" name="menu[]"></th>
                    <td><input type="checkbox" value="true" class="view form-check-input" name="view[]"></td>
                    <td><input type="checkbox" value="true" class="add form-check-input" name="add[]"></td>
                    <td><input type="checkbox" value="true" class="edit form-check-input" name="edit[]"></td>
                    <td><input type="checkbox" value="true" class="delete form-check-input" name="delete[]"></td>
                </tr>
                <tr>
                    <th>Near Expiry/Expired <input value="near_expiry_expired" type="hidden" name="menu[]"></th>
                    <td><input type="checkbox" value="true" class="view form-check-input" name="view[]"></td>
                    <td><input type="checkbox" value="true" class="add form-check-input" name="add[]"></td>
                    <td><input type="checkbox" value="true" class="edit form-check-input" name="edit[]"></td>
                    <td><input type="checkbox" value="true" class="delete form-check-input" name="delete[]"></td>
                </tr>
                <tr>
                    <th>Early Disposal <input value="early_disposal" type="hidden" name="menu[]"></th>
                    <td><input type="checkbox" value="true" class="view form-check-input" name="view[]"></td>
                    <td><input type="checkbox" value="true" class="add form-check-input" name="add[]"></td>
                    <td><input type="checkbox" value="true" class="edit form-check-input" name="edit[]"></td>
                    <td><input type="checkbox" value="true" class="delete form-check-input" name="delete[]"></td>
                </tr>
                <tr>
                    <th>Extend Expiry<input value="extend_ expiry" type="hidden" name="menu[]"></th>
                    <td><input type="checkbox" value="true" class="view form-check-input" name="view[]"></td>
                    <td><input type="checkbox" value="true" class="add form-check-input" name="add[]"></td>
                    <td><input type="checkbox" value="true" class="edit form-check-input" name="edit[]"></td>
                    <td><input type="checkbox" value="true" class="delete form-check-input" name="delete[]"></td>
                </tr>
                <tr>
                    <th>Report<input value="report" type="hidden" name="menu[]"></th>
                    <td><input type="checkbox" value="true" class="view form-check-input" name="view[]"></td>
                    <td><input type="checkbox" value="true" class="add form-check-input" name="add[]"></td>
                    <td><input type="checkbox" value="true" class="edit form-check-input" name="edit[]"></td>
                    <td><input type="checkbox" value="true" class="delete form-check-input" name="delete[]"></td>
                </tr>
                <tr>
                    <th>Print Barcode<input value="print_barcode" type="hidden" name="menu[]"></th>
                    <td><input type="checkbox" value="true" class="view form-check-input" name="view[]"></td>
                    <td><input type="checkbox" value="true" class="add form-check-input" name="add[]"></td>
                    <td><input type="checkbox" value="true" class="edit form-check-input" name="edit[]"></td>
                    <td><input type="checkbox" value="true" class="delete form-check-input" name="delete[]"></td>
                </tr>
                <tr>
                    <th>Reconciliation<input value="reconciliation" type="hidden" name="menu[]"></th>
                    <td><input type="checkbox" value="true" class="view form-check-input" name="view[]"></td>
                    <td><input type="checkbox" value="true" class="add form-check-input" name="add[]"></td>
                    <td><input type="checkbox" value="true" class="edit form-check-input" name="edit[]"></td>
                    <td><input type="checkbox" value="true" class="delete form-check-input" name="delete[]"></td>
                </tr>
            </tbody>
            <tfoot class="bg-primary-2 text-white">
                <tr>
                    <th colspan="5">
                        <button type="submit" class="btn btn-sm btn-primary rounded-pill"><i class="fa fa-save me-true"></i>Save & Submit</button>
                    </th>
                </tr>
            </tfoot>
        </table>
    </form> 
@endsection 

@section('scripts')
    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
        function view_alls(source) {
            var checkboxes = document.getElementsByClassName('view');

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
        function add_alls(source) {
            var checkboxes = document.getElementsByClassName('add');

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
        function edit_alls(source) {
            var checkboxes = document.getElementsByClassName('edit');

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
        function delete_alls(source) {
            var checkboxes = document.getElementsByClassName('delete');

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
@endsection 
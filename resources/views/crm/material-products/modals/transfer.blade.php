<div id="Transfers" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog custom-modal-dialog modal-top">
        <div class="modal-content rounded-0 border-bottom shadow">
            <div class="modal-header rounded-0 bg-primary text-white  ">
                <h4 class="modal-title" id="topModalLabel">Transfer batch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body  ">
                <table class="table table-centered bg-white table-bordered table-hover custom-center m-0">
                    <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                        <tr>
                            <th width="200px">Transfer Qty</th>
                            {{-- <th>storage area (able to add in new rooms in the future)</th>
                            <th>Housing type (able to add in new housing type in the future)</th> --}}
                            <th>storage area </th>
                            <th>Housing type </th>
                            <th>Housing No.</th>
                            <th>Owner 1</th>
                            <th>Owner 2</th>
                            <th> <i class="text-danger bi bi-trash3-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="200px" class="text-center"><input type="number" name="" id="" value="5" class="text-center form-control form-control-sm"></td>
                            <td>
                                <select name="" id="" class="form-select form-select-sm">
                                    <option value="">AR</option> 
                                    <option value="">CW</option> 
                                    <option value="">MA</option> 
                                    <option value="">SP</option> 
                                    <option value="">MR</option> 
                                    <option value="">Polymer</option> 
                                    <option value="">ChemShed1</option> 
                                    <option value="">ChemShed2</option> 
                                </select>
                            </td>
                            <td>
                                <select name="" id="" class="form-select form-select-sm">
                                    <option value=""> Flammable Cabinet</option>
                                    <option value=""> Acid Cabinet</option>
                                    <option value=""> Base Cabinet</option>
                                    <option value=""> Metal Cabinet</option>
                                    <option value=""> Racks</option>
                                    <option value=""> Dry Cabinet</option>
                                    <option value=""> Pallet </option>
                                    <option value=""> Freezer</option>
                                </select>
                            </td>
                            <td>
                                <select name="" id="" class="form-select form-select-sm">
                                    <option value=""> -</option>
                                    @for ($key=0;$key<20;$key++)
                                        <option value="">@{{ index+1 }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select name="" id="" class="form-select form-select-sm">
                                    <option value="">Beng HJibn</option>
                                </select>
                            </td>
                            <td>
                                <select name="" id="" class="form-select form-select-sm">
                                    <option value="">HuiBeng</option>
                                </select>
                            </td>
                            <td>
                                <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div> 
            <div class="modal-footer text-end  border-top">
                <button class="btn btn-primary rounded-pill">Click to confirm transfer</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> 
<div id="RepackOutlife" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog custom-modal-dialog modal-top">
        <div class="modal-content rounded-0 border-bottom shadow">
            <div class="modal-header rounded-0 bg-primary text-white  ">
                <h4 class="modal-title" id="topModalLabel">Repack/Outlife Material/Product batch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>				  
            <div class="modal-body  ">
             <h5 class="h5 text-primary text-center">Mat/Pdt outlife logsheet</h5>
                <table class="table table-centered  bg-white table-bordered   custom-center m-0">
                    <thead class="bg-light text-primary-2 table-bordered"> 
                        <tr>
                            <th width="200px">(Mother)Material/Product Draw status</th>
                            <th>Date & time stamp</th>
                            <th>Last accessed</th>
                            <th>Input repack amt (lnyards)</th>
                            <th>Remain amt (lnyards)</th>
                            <th>Auto-generate unique barcode label</th>
                            <th>Repack size (lnyards)</th>
                            <th>Qty cut</th>
                            <th>
                                Remaining outlife (prepreg roll)
                                Intital count: 
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <input type="number" name="" id="" style="width: 45px" value="30" class="me-1 p-0 text-center form-control form-control-sm"> days
                                </div>
                            </th>
                            <th> <i class="text-danger bi bi-trash3-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="300px" colspan="3">
                                <div class="row mb-2">
                                    <div class="col p-0">
                                        <button class="btn btn-success w-100">Draw Out</button>
                                    </div>
                                    <div class="col p-0">11/09/2021 08:00</div>
                                    <div class="col p-0">HuiBeng</div>
                                </div>
                                <div class="row ">
                                    <div class="col p-0">
                                        <button class="btn btn-secondary w-100">Draw in</button>
                                    </div>
                                    <div class="col p-0">11/09/2021 08:00</div>
                                    <div class="col p-0">HuiBeng</div>
                                </div>
                            </td>
                            <td class="text-center"><input type="number" name="" id="" value="10" class="text-center form-control form-control-sm"></td>
                            <td class="text-center"><input type="number" name="" id="" value="80" class="text-center form-control form-control-sm"></td>
                            <td>
                                Roll2/1 
                            </td>
                            <td class="text-center"><input type="number" name="" id="" value="80" class="text-center form-control form-control-sm"></td>
                            <td class="text-center"><input type="number" name="" id="" value="10" class="text-center form-control form-control-sm"></td>
                            <td>29 days 17hrs</td>
                            <td>
                                <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i><br><br>
                                <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                            </td>
                             
                        </tr>
                    </tbody>
                </table>
            </div> 
            <div class="card-footer ">
                <div class="row align-items-center">
                    <div class="shadow-sm border col-4">
                        <label for="end_of_material_products" class="p-2"><input type="checkbox" class="form-check-input me-2" name="" id="end_of_material_products"> End of batch</label>
                    </div>
                    <div class="col-6 ms-auto text-end">
                        <button class="btn btn-info rounded-pill h-100">Export logsheet</button>
                        <button class="btn btn-primary rounded-pill h-100">Save and Submit</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div id="RepackTransfers" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog custom-modal-dialog modal-top">
        <div class="modal-content rounded-0 border-bottom shadow">
            <div class="modal-header rounded-0 bg-primary text-white  ">
                <h4 class="modal-title" id="topModalLabel">Repack/Transfer Material/Product batch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row m-0">
                    <div class="col-lg-12">
                        <h5 class="h5 text-primary text-center"> Bulk vol tracking logsheet (Drum)</h5>
                        <table class="table table-centered bg-white table-bordered table-hover custom-center mb-3">
                            <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                                <tr>
                           
                                    <th>Date&time stamp</th>
                                    <th>Current accessed</th>
                                    <th>Input Used amt (L)</th>
                                    <th>Remain Amt (L)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding: 0">10/09/2021 at 08:00</td>
                                    <td style="padding: 0">Ziv</td>
                                    <td style="padding: 0"><input type="number" name="" id="" value="10" class="text-center form-control form-control-sm"></td>
                                    <td style="padding: 0">15</td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <h5 class="h5 text-primary text-center">Repacked mat/product tracking logsheet (Repack)</h5>
                        <table class="table table-centered bg-white table-bordered table-hover custom-center m-0">
                            <thead class="bg-light text-primary-2 table-bordered table-hover"> 
                                <tr>
                                    <th width="200px">Repack Size(L)</th>
                                     <th>Qty</th>
                                    <th>storage area</th>
                                    <th>Housing type</th>
                                     <th>Housing No</th>
                                    <th>Owner 1</th>
                                    <th>Owner 2</th>
                                    <th>Generate Unique Barcode</th>
                                    <th> <i class="text-danger bi bi-trash3-fill"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding: 0" width="200px" class="text-center"><input type="number" name="" id="" value="5" class="text-center form-control form-control-sm"></td>
                                    <td style="padding: 0">
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value="">CW</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0">
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value="">CW </option>
                                            <option value="">MA </option>
                                            <option value="">SP </option>
                                            <option value="">MR </option>
                                            <option value="">Polymer </option>
                                            <option value="">ChemShed1 </option>
                                            <option value="">ChemShed2</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0">
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value="">FC1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value=""> -</option>
                                            @for ($key=0;$key<20;$key++)
                                                <option value="">@{{ $key+1 }}</option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td style="padding: 0">
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value="">Keith</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0">
                                        <select name="" id="" class="form-select form-select-sm">
                                            <option value="">HuiBeng</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0">Batch2/1</td>
                                    <td style="padding: 0">
                                        <i class="btn btn-sm border shadow btn-light rounded-pill bi bi-x"></i>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
            <div class="modal-footer text-end  border-top">
                <button class="btn btn-primary rounded-pill">Click to confirm and proceed to print label page</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> 
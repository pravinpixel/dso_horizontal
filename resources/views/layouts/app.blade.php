<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://www.dso.org.sg/media/default/theme/favicon.png" rel="shortcut icon" type="image/png" />
    <title>DSO</title>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    {{--  ===== STYLES ======= --}}
        @include('includes.styles')
    {{--  ===== STYLES ======= --}}
  
</head>
<body>
    @include('flash::message')

    <div class="sticky-top">
        @include('includes.sections.nav-bar')
        @include('includes.sections.top-nav-bar')
    </div> 

    @include('includes.sections.breadcrumb')

    <main class="container-fluid" style="min-height: 80vh">
        @yield('content')
    </main>
    
    <div id="advance-search-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>Advanced Search Filter</h4>  
                    <div class="ms-auto">
                        <a data-bs-toggle="modal" data-bs-target="#saved-search-modal"  class="btn btn-outline-light me-2 rounded-pill">My saved searches</a>
                        <button class="rounded-pill btn btn-light btn-sm shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                    </div>
                </div>
                <div class="modal-body modal-scroll">
                    <div class="text-center">
                        <div class="row m-0">
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">In-house Product Logsheet ID#</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                           
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">EUC Material</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">Yes</option>
                                    <option value="4">No</option>
                                </select>
                            </div> 
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">CAS#</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Supplier</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Batch#</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Serial#</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">Statutory board</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">SCDF</option>
                                    <option value="2">NEA</option>
                                    <option value="3">HSA</option>
                                    <option value="4">NA(CWC)</option>
                                    <option value="4">SPF</option>
                                    <option value="4">Not Applicable</option>
                                </select>
                            </div> 
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">Housing type</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">Flammable Cabinet</option>
                                    <option value="2">Acid Cabinet</option>
                                    <option value="3">Base Cabinet</option>
                                    <option value="4">Metal Cabinet</option>
                                    <option value="4">Racks</option>
                                    <option value="4">Dry Cabinet</option>
                                    <option value="4">Freezer</option>
                                </select>
                            </div> 
							 <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">Housing No</label>
                                <select name="" id="" class="form-select form-select-sm">
                                        <option value=""> -</option>
                                        @for ($key=0;$key<20;$key++)
                                            <option value="">{{ $key+1 }}</option>
                                        @endfor
                                    </select>
                            </div> 
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">Unit Packing size</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">kg</option>
                                    <option value="2">L</option>
                                    <option value="3">m</option>									
                                    <option value="4">m&#xB2;</option>
                                    <option value="4">piece</option>
                                    <option value="4">roll</option>
                                    <option value="4">drum</option>
                                    <option value="4">lnyard</option>
                                </select>
                            </div> 
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Date of expiry</small>
                                <input type="date" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">IQC status </label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">Pass</option>
                                    <option value="2">Fail</option> 
                                </select>
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">PO Number</small>
                                <input type="number" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Extended expiry</small>
                                <input type="date" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">Extended QC status</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">Pass</option>
                                    <option value="2">Fail</option> 
                                </select>
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <label for="" class="form-label">Disposed</label>
                                <select name="" id="" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No but use for TD & EXPT</option> 
                                </select>
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Project name </small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Material/In-house Product type</small>
                                <input type="text" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Date of shipment</small>
                                <input type="date" class="form-control" placeholder="Type here">
                            </div>
                            <div class="col-6 text-start mb-2 px-1">
                                <small class="mb-1">Date of manufacture</small>
                                <input type="date" class="form-control" placeholder="Type here">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top text-center">
                    <label for="xxxx" data-bs-toggle="modal" data-bs-target="#save-search-name"><input type="checkbox" name="" class="form-check-input" id="xxxx"> Save search</label>
                    <button class="btn btn-primary mx-auto col-3 rounded-pill"><i class="bi bi-search me-1"></i> Search</button>
                </div>
            </div> 
        </div>
    </div>
    <div id="saved-search-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>My Saved Searches</h4>
                    <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body modal-scroll">
                    <div class="text-s">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action btn">Item Description Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Batch/Serial Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Storage Room	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">QC Status	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Item description Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Used For TD/Expt Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Keith/HuiBeng	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Item Description Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Batch/Serial Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Storage Room	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">QC Status	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Item description Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Used For TD/Expt Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Keith/HuiBeng	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                        </ul>
                    </div>
                </div> 
            </div> 
        </div>
    </div>
    <div id="notification-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>Notifications</h4>
                    <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body modal-scroll">
                    <div class="text-s">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action btn">Item Description Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Batch/Serial Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Storage Room	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">QC Status	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Used For TD/Expt Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li>  
                        </ul>
                    </div>
                </div> 
            </div> 
        </div>
    </div> 
    <div class="modal fade" id="save-search-name" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Save Search Name</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control mb-3" placeholder="Type here..">
                    <input type="submit" class="form-control btn-primary btn" value="Save">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div id="View_Batch_Material_Product_details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0 ">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>View details</h4>
                    <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body modal-scroll-2 p-0">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Material description </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">In-house Product description</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">In-house Product Logsheet ID# (hyperlink to logsheet)* - for product only ; phase 2</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">EUC material* (checked if EUC material)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">CAS#</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">FM1202 (checked if FM1202 is available)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Upload SDS/Mill Cert Document*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Brand* </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Supplier* (for products, can input names instead) </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Unit Packing size (select units) * </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Quantity * </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Batch # * (key in NIL if not applicable)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Lot# *  (key in NIL if not applicable)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Serial# *  (key in NIL if not applicable)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">COC/COA/Mill Cert (attach COC/COA/Mill Cert document)* - up to 3 only.</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Statutory body (able to add in new bodies in the future)* for material not product</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Storage room (able to add in new rooms in the future)*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Housing type (able to add in new housing type in the future)*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Owner 1 * </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Owner 2 (SE/PL/FM)*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Date in *</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Date of expiry (Date)* </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">IQC status (P/F)* </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">"IQC result (Visual check for non-IQC items. Attach QC document for IQC items)* </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">For product only, can attach COC/COA under IQC."</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">PO Number*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Extended expiry</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Extended QC status (P/F)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Extended QC result (Visual check if no QC conducted/Attach QC document if QC conducted)</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Disposed (Y/N but used for TD&EXPT project) </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Upload disposal certificate</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Project name </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Remarks </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">"Alert Threshold Qty for new material/product description (red amber green indicator to reflect quantity health status)  (All owner 1/2 to receive notification) "</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">"Alert before expiry (in terms of weeks) for new material/product description (red amber green indicator to warn owners on near expiry items) (All owner 1/2 to receive notification) "</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Dept*</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Material/Product type </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Cost per unit</li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-start align-items-start">Access (default everyone can see, indicate who only can see) drop down list with lab groups then further breakdown into names*</li>
                    </ol> 
                </div> 
            </div> 
        </div>
    </div> 
    <div id="View_Material_Product_details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog w-100 modal-right h-100">
            <div class="modal-content h-100 rounded-0">
                <div class="modal-header bg-primary text-white border-0 rounded-0">
                    <h4>View batch details</h4>
                    <button class="rounded-pill btn btn-light btn-sm ms-auto shadow-sm border" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body modal-scroll-2">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item list-group-item-action">Category Selection</li>
                        <li class="list-group-item list-group-item-action">Item description</li>
                        <li class="list-group-item list-group-item-action">In-house Product Logsheet ID#</li>
                        <li class="list-group-item list-group-item-action">EUC material</li>
                        <li class="list-group-item list-group-item-action">Brand</li>
                        <li class="list-group-item list-group-item-action">Supplier</li>
                        <li class="list-group-item list-group-item-action">Unit Packing size</li>
                        <li class="list-group-item list-group-item-action">Statutory body</li>
                        <li class="list-group-item list-group-item-action">Owner 1</li>
                        <li class="list-group-item list-group-item-action">Owner 2 (SE/PL/FM)</li>
                        <li class="list-group-item list-group-item-action">Remarks </li>
                        <li class="list-group-item list-group-item-action">Alert Threshold Qty for new material/product description</li>
                        <li class="list-group-item list-group-item-action">Alert before expiry (in terms of weeks) for new material/product description</li>
                        <li class="list-group-item list-group-item-action">Access</li>
                         
                    </ol> 
                </div> 
            </div> 
        </div>
    </div>
    {{-- ========= SCRIPTS  ==========--}}
        @include('includes.scripts')
    {{-- ========= SCRIPTS  ==========--}} 
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://www.dso.org.sg/media/default/theme/favicon.png" rel="shortcut icon" type="image/png" />
    <title>DSO</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    {{--  ===== STYLES ======= --}}
        @include('includes.styles')
    {{--  ===== STYLES ======= --}}
    <input type="hidden" id="app_URL" value="{{ url('') }}">
</head>
<body>
    @include('flash::message')

    <div class="sticky-top" id="navigation_menu">
        @include('includes.sections.nav-bar')
        @include('includes.sections.top-nav-bar')
    </div> 

    @include('includes.sections.breadcrumb')

    {{-- @if (\Sentinel::hasAnyAccess(['user.view.withdrawal', 'user.add.withdrawal']))
        True
        @else
        False
    @endif --}}

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
                                <input type="number" min="1"  class="form-control" placeholder="Type here">
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
                                    <option value="2">No but used for TD/Expt</option> 
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
                            <li class="list-group-item list-group-item-action btn">storage area	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">QC Status	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Item description Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Used For TD/Expt Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Keith/HuiBeng	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Item Description Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Batch/Serial Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">storage area	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
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
                            <li class="list-group-item list-group-item-action btn">storage area	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">QC Status	 Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li> 
                            <li class="list-group-item list-group-item-action btn">Used For TD/Expt Search - <small class="float-end text-secondary">02/12/2022 at 2.35 pm</small></li>  
                        </ul>
                    </div>
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
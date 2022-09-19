app.controller('RootController', function ($scope, $http) {

    $scope.withdrawalStatus           = false
    $scope.filter_status              = false
    $scope.advance_search_status      = false
    $scope.advance_search_pre_saved   = true
    $scope.view_my_saved_search_model = false
    $scope.sort_by_payload            = false

    // === Route Lists ===
    var material_products_url              = $('#get-material-products').val();
    var change_batch_read_status           = $('#change_batch_read_status').val(); 
    var get_batch_material_products        = $('#get-batch-material-products').val();
    var get_batch                          = $('#get-batch').val();
    var get_masters                        = $('#get_masters').val();
    var pageName                           = $('#page-name').val();
    var duplicate_material_products_url    = $('#duplicate-material-products').val();
    var delete_material_products_url       = $('#delete-material-products').val();
    var delete_material_products_batch_url = $('#delete-material-products-batch').val();
    var get_save_search_url                = $('#get-save-search').val();
    var transfer_batch                     = $('#transfer_batch').val();
    var repack_batch                       = $('#repack_batch').val();
    var app_URL                            = $('#app_URL').val();
        $scope.auth_id                     = $('#auth-id').val();
        $scope.auth_role                   = $('#auth-role').val();
        $scope.current_date                = moment(new Date()).format('YYYY-MM-DD')
        $scope.on_all_check_box            = false

    $scope.getDateOfExpiryColor = (current_date, date_of_expiry) => {
        var given = moment(date_of_expiry, "YYYY-MM-DD");
        var day = moment.duration(given.diff(current_date)).asDays();
        if (current_date >= date_of_expiry) {
            return 'text-danger'
        } else {
            if (day < 21) { // 21 ---> 3 weeks
                return 'text-warning'
            }
            if (day > 21) { // 21 ---> 3 weeks
                return 'text-success'
            }
        }
    }

    $scope.on_barcode_number = false
    $scope.select_all_check_box = () => {
        if ($scope.on_all_check_box === true) {
            $scope.on_access = true
            $scope.on_alert_before_expiry = true
            $scope.on_alert_threshold_qty_lower_limit = true
            $scope.on_alert_threshold_qty_upper_limit = true
            $scope.on_barcode_number = true
            $scope.on_batch = true
            $scope.on_brand = true
            $scope.on_cas = true
            $scope.on_category_selection = true
            $scope.on_coc_coa_mill_cert = true
            $scope.on_cost_per_unit = true
            $scope.on_date_in = true
            $scope.on_date_of_expiry = true
            $scope.on_date_of_manufacture = true
            $scope.on_date_of_shipment = true
            $scope.on_department = true
            $scope.on_disposal_certificate = true
            $scope.on_euc_material = true
            $scope.on_extended_expiry = true
            $scope.on_extended_qc_result = true
            $scope.on_extended_qc_status = true
            $scope.on_fm_1202 = true
            // $scope.on_housing = true
            $scope.on_housing_type = true
            $scope.on_iqc_result = true
            $scope.on_iqc_status = true
            $scope.on_material_product_id = true
            $scope.on_material_product_type = true
            $scope.on_outlife = true
            // $scope.on_owner_one = true
            $scope.on_owner_two = true
            // $scope.on_packing_size = true
            $scope.on_po_number = true
            $scope.on_project_name = true
            $scope.on_quantity = true
            $scope.on_remarks = true
            $scope.on_repack_size = true
            $scope.on_require_bulk_volume_tracking = true
            $scope.on_require_outlife_tracking = true
            $scope.on_sds = true
            $scope.on_serial = true
            $scope.on_statutory_body = true
            $scope.on_storage_area = true
            $scope.on_supplier = true
            // $scope.on_unit_of_measure = true
            $scope.on_unit_packing_value = true
            $scope.on_used_for_td_expt_only = true
        } else {
            $scope.on_access = false
            $scope.on_alert_before_expiry = false
            $scope.on_alert_threshold_qty_lower_limit = false
            $scope.on_alert_threshold_qty_upper_limit = false
            $scope.on_barcode_number = false
            $scope.on_batch = false
            $scope.on_brand = true
            $scope.on_cas = false
            $scope.on_category_selection = false
            $scope.on_coc_coa_mill_cert = false
            $scope.on_cost_per_unit = false
            $scope.on_date_in = false
            $scope.on_date_of_expiry = true
            $scope.on_date_of_manufacture = false
            $scope.on_date_of_shipment = false
            $scope.on_department = true
            $scope.on_disposal_certificate = false
            $scope.on_euc_material = false
            $scope.on_extended_expiry = false
            $scope.on_extended_qc_result = false
            $scope.on_extended_qc_status = false
            $scope.on_fm_1202 = false
            $scope.on_housing = false
            $scope.on_housing_type = true
            $scope.on_iqc_result = false
            $scope.on_iqc_status = false
            $scope.on_material_product_id = false
            $scope.on_material_product_type = false
            $scope.on_outlife = false
            $scope.on_owner_one = false
            $scope.on_owner_two = true
            $scope.on_packing_size = false
            $scope.on_po_number = false
            $scope.on_project_name = false
            $scope.on_quantity = true
            $scope.on_remarks = false
            $scope.on_repack_size = false
            $scope.on_require_bulk_volume_tracking = false
            $scope.on_require_outlife_tracking = false
            $scope.on_sds = false
            $scope.on_serial = false
            $scope.on_statutory_body = false
            $scope.on_storage_area = true
            $scope.on_supplier = false
            $scope.on_unit_of_measure = false
            $scope.on_unit_packing_value = true
            $scope.on_used_for_td_expt_only = true
        }
    }

    // ==== Get Data form DB ====
    $scope.get_material_products = function () {
        $http({
            method: 'get',
            url: material_products_url,
        }).then(function (response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
            $scope.material_products_data = $scope.material_products.data;
            setTimeout(() => {
                $(".loader").hide()
            }, 100);
        }, function (response) {
            Message('danger', response.data.message);
        });

    }
    $scope.get_material_products();

    // ====== Edit & Duplicate Data DB ====

    $scope.editOrDuplicate = function (wizard_mode, id, batch_id, is_parent) {
        window.location.replace(`${app_URL}/material-product/form-one/${wizard_mode}/${id}/batch/${batch_id}/${is_parent != undefined ? is_parent : ''}`);
    }

    // ====== Delete Data DB ====
    $scope.delete_material_product = function (id) {
        swal({
            text: "Are you sure want to Delete?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn-light rounded-pill btn",
                    closeModal: true,
                },
                confirm: {
                    text: "Yes, Delete",
                    value: true,
                    visible: true,
                    className: "btn btn-danger rounded-pill",
                    closeModal: true
                }
            },
        }).then((isConfirm) => {
            if (isConfirm) {
                $http({
                    method: 'POST',
                    url: delete_material_products_url + "/" + id,
                }).then(function (response) {
                    $scope.data = response.data;
                    $scope.get_material_products();
                    Message('success', response.data.message);
                }, function (response) {
                    $scope.data = response.data || 'Request failed';
                });
            }
        });
    }

    $scope.delete_batch_material_product = function (id) {
        swal({
            text: "Are you sure want to Delete?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn-light rounded-pill btn",
                    closeModal: true,
                },
                confirm: {
                    text: "Yes, Delete",
                    value: true,
                    visible: true,
                    className: "btn btn-danger rounded-pill",
                    closeModal: true
                }
            },
        }).then((isConfirm) => {
            if (isConfirm) {
                $http({
                    method: 'POST',
                    url: delete_material_products_batch_url + "/" + id,
                }).then(function (response) {
                    $scope.data = response.data;
                    $scope.get_material_products();
                    Message('success', response.data.message);
                }, function (response) {
                    $scope.data = response.data || 'Request failed';
                });
            }
        });
    }

    $scope.view_material_product = function (row) {
        $('#View_Material_Product_Details').modal('show');
        $scope.view_material_product_data = [
            { name: "Category Selection", item: row.category_selection == 'in_house' ? 'In-house Product' : 'Material' },
            { name: 'Item description', item: row.item_description },
            { name: 'Unit Packing size', item: row.unit_packing_value },
            { name: 'Owner 1 /2', item: `${row.batches[0].owner_one} / ${row.batches[0].owner_two}` },
            { name: 'Statutory body', item: row.batches[0].statutory_body !== null ? row.batches[0].statutory_body.name : '' },
            { name: 'Alert threshold Qty (upper limit) ', item: row.alert_threshold_qty_lower_limit },
            { name: 'Alert threshold Qty (lower limit) ', item: row.alert_threshold_qty_upper_limit },
            { name: 'Alert before expiry (in weeks)', item: row.alert_before_expiry },
        ]
    }

    $scope.view_batch_details = function (row, batch) {
        $http.get(`${get_batch_material_products}/${batch.id}`).then((res) => {
            $('#View_Batch_Details').modal('show');
            if (batch.coc_coa_mill_cert != null) {
                var coc_files = []
                JSON.parse(batch.coc_coa_mill_cert).map((file) => {
                    coc_files.push(file.replace('public/files/', 'public/storage/files/'))
                })
            }
            $scope.batchOverview = {
                category_selection: row.category_selection == 'in_house' ? 'In-house Product' : 'Material',
                item_description: row.item_description,
                brand: batch.brand,
                supplier: batch.supplier,
                unit_packing_value: row.unit_packing_value,
                quantity: batch.quantity,
                batch: batch.batch,
                serial: batch.serial,
                po_number: batch.po_number,
                statutory_body: batch.statutory_body !== null ? batch.statutory_body.name : '-',
                euc_material: batch.euc_material == 1 ? "Yes" : batch.euc_material == 0 ? "No" : "-",
                require_bulk_volume_tracking: batch.require_bulk_volume_tracking == 1 ? "Yes" : batch.require_bulk_volume_tracking == 0 ? "No" : "-",
                require_outlife_tracking: `${batch.require_outlife_tracking == 1 ? "Yes" : batch.require_outlife_tracking == 0 ? "No" : "-"}  ( ${batch.outlife ?? "0"})`,
                storage_area: batch.storage_area !== null ? batch.storage_area.name : '-',
                housing: `${batch.housing_type !== null ? batch.housing_type.name : '-'} / ${batch.housing}`,
                owners: `${batch.owner_one} / ${batch.owner_two}`,
                department: res.data.department,
                access: res.data.access.join(","),
                date_in: batch.date_in,
                date_of_expiry: batch.date_of_expiry,
                sds: batch.sds != null ? batch.sds.replace('public/files/', 'public/storage/files/') : null,
                date_of_expiry: batch.date_of_expiry,
                coc_coa_mill_cert: coc_files ?? null,
                iqc_status: batch.iqc_status == 0 ? "Fail" : "Pass",
                iqc_result: batch.iqc_result != null ? batch.iqc_result.replace('public/files/', 'public/storage/files/') : null,
                cas: batch.cas,
                fm_1202: batch.fm_1202 == 'on' ? "Yes" : "No",
                project_name: batch.project_name,
                material_product_type: batch.material_product_type,
                date_of_manufacture: batch.date_of_manufacture,
                date_of_shipment: batch.date_of_shipment,
                cost_per_unit: batch.cost_per_unit,
                remarks: batch.remarks,
                extended_expiry: batch.extended_expiry ?? ' - ',
                extended_qc_status: batch.extended_qc_status ?? ' - ',
                extended_qc_status: batch.extended_qc_status ?? ' - ',
                extended_qc_result: batch.extended_qc_result ?? ' - ',
                disposal_certificate: batch.disposal_certificate ?? ' - ',
                used_for_td_expt_only: batch.used_for_td_expt_only == 1 ? 'Yes' : batch.used_for_td_expt_only == 0 ? "No" : "-",
            }
        });
    }

    //  ===== Pagination & Filters ====
    $scope.next_Prev_page = function (params) {
        if ($scope.advance_search_status == true) {
            var payload_data = $scope.filter_data;
        } else {
            if ($scope.advance_search_pre_saved == true) {
                var payload_data = { advanced_search: $scope.advance_search_pre_saved_data }
            }
            if ($scope.sort_by_payload == true) {
                var payload_data = $scope.sort_by_payload_data
            } else {
                var payload_data = { Empty: "0000" }
            }
        }

        $http({
            method: 'post',
            url: params,
            data: payload_data
        }).then(function (response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();
        }, function (response) {
            Message('danger', response.data.message);
        });
    }

    $scope.sort_by = function (name, type) {
        $scope.sort_by_payload = true;
        $scope.sort_by_payload_data = {
            sort_by: {
                col_name: name,
                order_type: type,
            }
        }

        $http({
            method: 'post',
            url: material_products_url,
            data: $scope.sort_by_payload_data
        }).then(function (response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();

        }, function (response) {
            Message('danger', response.data.message);
        });
    }

    $scope.search_barcode_number = function () {
        if ($scope.barcode_number === undefined) {
            return false
        }
        if ($scope.barcode_number === null) {
            return false
        }
        $http({
            method: 'post',
            url: material_products_url,
            data: {
                filters: $scope.barcode_number
            }
        }).then(function (response) { 
    
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();

            setTimeout(() => {
                $(".loader").hide()
            }, 100); 
            // switch (pageName) {
            //     case 'MATERIAL_WITHDRAWAL':
            //         $scope.withdrawalStatus = true

            //         if (response.data.data === null) {
            //             $scope.withdrawalStatus = false
            //         } 

            //         if ($scope.directDeduct === undefined) {
            //             $scope.directDeduct = []
            //         }
            //         if ($scope.deductTrackUsage === undefined) {
            //             $scope.deductTrackUsage = []
            //         }
            //         if ($scope.deductTrackOutlife === undefined) {
            //             $scope.deductTrackOutlife = []
            //         }
                    
            //         $scope.material_products.data.map((material) => {
            //             material.batches.map((batch) => {
            //                 if (batch.barcode_number == $scope.barcode_number) {
            //                     $scope.withdrawalType = batch.withdrawal_type
            //                     switch (batch.withdrawal_type) {
            //                         case 'DIRECT_DEDUCT':
            //                             var pushStatus               = true 
            //                             batch.direct_detect_quantity = 1
            //                             $scope.directDeduct.length !== 0 && $scope.directDeduct.map((batch) => {
            //                                 if(batch.barcode_number == $scope.barcode_number ) { 
            //                                     batch.direct_detect_quantity += 1  
            //                                     pushStatus = false
            //                                 }
            //                             });
            //                             if(pushStatus === true) {
            //                                 $scope.directDeduct.push({ ...batch, item_description: material.item_description, unit_packing_value: material.unit_packing_value, unit_of_measure:material.unit_of_measure.name, category_selection: material.category_selection })
            //                             }
                                       
            //                             $scope.resetBarCode()
            //                             console.log(batch)
            //                             console.log(material)
            //                             break;
            //                         case 'DEDUCT_TRACK_USAGE':
            //                             $scope.deductTrackUsage = [];
            //                             $scope.deductTrackUsage.push({ ...batch, material: material, })
            //                             break;
            //                         case 'DEDUCT_TRACK_OUTLIFE':
            //                             $scope.deductTrackOutlife = [];
            //                             $scope.deductTrackOutlife.push({ ...batch, item_description: material.item_description, unit_packing_value: material.unit_packing_value, unit_of_measure:material.unit_of_measure.name,category_selection: material.category_selection })
                                    
            //                                 $scope.deductTrackOutlife[0].repack_outlife.map((row) => {
            //                                     row.current_date_time =   moment(row.current_date_time).format('YYYY-MM-DD h:m:s')
                                           
            //                                 })
            //                             break;
            //                         default:
            //                             break;
            //                     }
            //                 }
            //             })
            //         });
            //         break;
            //     default:
            //         $scope.withdrawalStatus = false
            //         break;
            // }

        }, function (response) {
            Message('danger', response.data.message);
        });

    }

    $scope.removeDirectDetectRow = (index) => {
        $scope.directDeduct.splice(index, 1)
    }
    $scope.removeDeductTrackUsageRow = (index) => {
        $scope.deductTrackUsage.splice(index, 1)
    }


    $scope.clear_advanced_filter = () => {
        $scope.advanced_filter = {}
    }

    // Advanced Search Fitters
    $scope.search_advanced_mode = (advanced_search, type) => {

        $scope.filter_status = true
        $scope.sort_by_payload = false;
        if (advanced_search === undefined) {
            $scope.filler_function();
            var payload_data = $scope.filter_data
            $scope.advance_search_status = true
        } else {
            $scope.advance_search_pre_saved = true
            $scope.advance_search_pre_saved_data = advanced_search
            var payload_data = $scope.advanced_filter
        }
        if (type == 'saved_search') {
            var payload_data = {
                advanced_search: advanced_search
            }
        }

        Object.keys(payload_data.advanced_search).map((item) => {
            if (
                item == "date_in" || item == "date_of_expiry" || item == "date_of_manufacture" || item == "date_of_shipment"
            ) {
                payload_data.advanced_search[item].startDate = moment(payload_data.advanced_search[item].startDate).format('YYYY-MM-DD')
                payload_data.advanced_search[item].endDate = moment(payload_data.advanced_search[item].endDate).format('YYYY-MM-DD')
            }
        })

        $http({
            method: 'post',
            url: material_products_url,
            data: payload_data
        }).then(function (response) {
            $scope.material_products = response.data.data;
            $scope.material_products.links.shift();
            $scope.material_products.links.pop();

            $('#advance-search-ng-modal').modal('hide');
            if ($scope.view_my_saved_search_model == true) {
                $('#saved-search-ng-modal').modal('hide');
            }
        }, function (response) {
            Message('danger', response.data.message);
        });
    }
    $scope.resetBarCode = () => {
        $scope.barcode_number = ''
    }
    $scope.reset_bulk_search = function () {
        $scope.get_material_products();
        $scope.filter_status = false;
        $scope.advance_search_status = false;
        $scope.sort_by_payload = false;

        $scope.barcode_number = ''

        // ====Bulk Search Rest====
        $scope.filter = ""
        // ====Bulk Search Rest===
        delete $scope.filter_data
        $scope.clear_advanced_filter()
    }

    $scope.filler_function = () => {
        if ($scope.filter_status == true) {
            $scope.filter_data = {
                advanced_search: $scope.advanced_filter
            }
        } else {
            $scope.filter_data = {}
        }
    }
    $scope.filler_function();

    $scope.save_search_title = () => {
        if ($scope.search_title === undefined) {
            Message('danger', "Search Title is Required !");
            return false
        }

        $http({
            method: 'post',
            url: get_save_search_url,
            data: { data: $scope.advanced_filter, search_title: $scope.search_title }
        }).then(function (response) {
            $scope.material_products = response.data.data;
            Message('success', response.data.message);
            $scope.search_title = ''
            $('#save-search-name').modal('hide');
            $('#saveThisSearch').prop('checked', false);
        }, function (response) {
            Message('danger', response.data.errors.search_title[0]);
        });
    }

    $scope.view_my_saved_search = () => {
        $scope.view_my_saved_search_model = true
        $("#saved-search-ng-modal").modal('show')
        $http({
            method: 'get',
            url: get_save_search_url,
        }).then(function (response) {
            $scope.view_my_saved_search_list = response.data.data;
        });
    }
    $scope.removeSearchRecord = (id) => {
        swal({
            text: "Are you sure want to Delete?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn-light rounded-pill btn",
                    closeModal: true,
                },
                confirm: {
                    text: "Yes, Delete",
                    value: true,
                    visible: true,
                    className: "btn btn-danger rounded-pill",
                    closeModal: true
                }
            },
        }).then((isConfirm) => {
            if (isConfirm) {
                $http({
                    method: 'DELETE',
                    url: get_save_search_url + "/" + id
                }).then(function (response) {
                    $http({
                        method: 'get',
                        url: get_save_search_url,
                    }).then(function (response) {
                        $scope.view_my_saved_search_list = response.data.data;
                    });
                    Message('success', response.data.message);
                });
            }
        });
    }

    $http.get(get_masters).then((res) => {
        $scope.MasterData = res.data
    });

    $scope.Transfers = (id, quantity) => {
        $scope.TransfersBatch = null
        $http.get(`${get_batch}/${id}`).then((response) => {
            $scope.TransfersBatch = response.data
            $scope.TransfersBatchMaxQuantity = response.data.quantity
            $('#Transfers').modal('show');
        });
    }
    $scope.transferBatch = () => {
        if ($scope.TransfersBatch.quantity == '' || $scope.TransfersBatch.storage_area == '' || $scope.TransfersBatch.housing_type == '' || $scope.TransfersBatch.housing == '' || $scope.TransfersBatch.owner_one == '' || $scope.TransfersBatch.owner_two == '') {
            Message('danger', "All fields is Required !");
            return false
        }
        if ($scope.TransfersBatch.quantity == null || $scope.TransfersBatch.storage_area == null || $scope.TransfersBatch.housing_type == null || $scope.TransfersBatch.housing == null || $scope.TransfersBatch.owner_one == null || $scope.TransfersBatch.owner_two == null) {
            Message('danger', "All fields is Required !");
            return false
        }
        $http.post(transfer_batch, $scope.TransfersBatch).then((response) => {
            $scope.get_material_products();
            Message('success', response.data.message);
            $('#Transfers').modal('hide');
        });
    }
    $scope.clearTransferBatch = () => {
        swal({
            text: "Do you want to clear fields ?",
            icon: "info",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn-light rounded-pill btn",
                    closeModal: true,
                },
                confirm: {
                    text: "Yes, Delete",
                    value: true,
                    visible: true,
                    className: "btn btn-danger rounded-pill",
                    closeModal: true
                }
            },
        }).then((isConfirm) => {
            if (isConfirm) {
                $scope.TransfersBatch.quantity = ''
                $scope.TransfersBatch.storage_area = ''
                $scope.TransfersBatch.housing_type = ''
                $scope.TransfersBatch.housing = ''
                $scope.TransfersBatch.owner_one = ''
                $scope.TransfersBatch.owner_two = ''
                $scope.$apply()
            }
        });
    }

    // Repack And Transfer 
    $scope.CurrentDate = new Date();

    $scope.RepackTransfers = (type, batch, row) => {
        switch (type) {
            case "view":
                $("#RepackTransfers").modal("show");
                $scope.RepackTransfer = batch;
                $scope.RepackTransferPackSize = row.unit_packing_value
                $scope.RepackTransferQty = batch.quantity
                $scope.RepackTransferMeasure = row.unit_of_measure.name
                const CurrentAccessed = JSON.parse($scope.RepackTransfer.access);
                $scope.CurrentAccessed = CurrentAccessed.join()
                break;
            case "store":
                if ($scope.RepackTransfer.RepackQuantity === null || $scope.RepackTransfer.RepackQuantity === undefined) {
                    Message('danger', "Input Used amt (L) is Required !");
                    return false;
                }
                if ($scope.RepackTransfer.new_unit_packing_value == '' || $scope.RepackTransfer.quantity == '' || $scope.RepackTransfer.storage_area == '' || $scope.RepackTransfer.housing_type == '' || $scope.RepackTransfer.housing == '' || $scope.RepackTransfer.owner_one == '' || $scope.RepackTransfer.owner_two == '') {
                    Message('danger', "All fields is Required !");
                    return false
                }
                if ($scope.RepackTransfer.new_unit_packing_value == null || $scope.RepackTransfer.quantity == null || $scope.RepackTransfer.storage_area == null || $scope.RepackTransfer.housing_type == null || $scope.RepackTransfer.housing == null || $scope.RepackTransfer.owner_one == null || $scope.RepackTransfer.owner_two == null) {
                    Message('danger', "All fields is Required !");
                    return false
                }
                $http.post(repack_batch, $scope.RepackTransfer).then((response) => {
                    $scope.get_material_products();
                    Message(response.data.status == true ? 'success' : 'danger', response.data.message);
                    $('#RepackTransfers').modal('hide');
                });
                break;
            case "clear":
                swal({
                    text: "Do you want to clear fields ?",
                    icon: "info",
                    buttons: {
                        cancel: {
                            text: "Cancel",
                            value: null,
                            visible: true,
                            className: "btn-light rounded-pill btn",
                            closeModal: true,
                        },
                        confirm: {
                            text: "Yes, Delete",
                            value: true,
                            visible: true,
                            className: "btn btn-danger rounded-pill",
                            closeModal: true
                        }
                    },
                }).then((isConfirm) => {
                    if (isConfirm) {
                        $scope.RepackTransfer.quantity = ''
                        $scope.RepackTransfer.storage_area = ''
                        $scope.RepackTransfer.housing_type = ''
                        $scope.RepackTransfer.housing = ''
                        $scope.RepackTransfer.owner_one = ''
                        $scope.RepackTransfer.owner_two = ''
                        $scope.$apply()
                    }
                });
                break;
            default: break;
        }
    }

    // Print Barcode
    $scope.view_print_barcode = (id) => {
        window.location.href = `print-label/${id}`
    }
    $scope.printBatchLabel = (id) => {
        swal({
            text: "Do you want to print?",
            icon: "info",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn-light rounded-pill btn",
                    closeModal: true,
                },
                confirm: {
                    text: "Proceed to print",
                    value: true,
                    visible: true,
                    className: "btn-primary rounded-pill btn",
                    closeModal: true
                }
            },
        }).then((isConfirm) => {
            if (isConfirm) {
                window.location.href = `print-label/${id}`
            }
        });
    }
    // New Repack Outlife eFlow 
    $scope.repack_outlife_table = [];
    $scope.disable_repack_outlife = false

    $scope.RepackOutlife = (batch, unit_of_measure) => {
        $scope.repack_outlife_unit_of_measure = unit_of_measure.name
        $scope.repack_outlife_days            = batch.outlife
        $scope.currentBatchId                 = batch.id
        $scope.currentBatch                   = batch
        $http.get(`repack-batch/${batch.id}`).then((response) => {
            $scope.repack_outlife_table.length = 0;
            const RepackData = response.data
            if (RepackData.repack_outlife.length !== 0) {
                RepackData.repack_outlife.forEach(element => {
                    $scope.repack_outlife_table.push(
                        {
                            id     : element.id,
                            quantity : RepackData.quantity,
                            draw_in: {
                                status    : element.draw_in,
                                time_stamp: element.draw_in_time_stamp
                            },
                            draw_out: {
                                status    : element.draw_out,
                                time_stamp: element.draw_out_time_stamp
                            },
                            last_access           : JSON.parse(RepackData.access),
                            initial_amount        : element.input_repack_amount,
                            initial_count         : RepackData.outlife,
                            repack_amount         : element.input_repack_amount,
                            balance_amount        : element.remain_amount,
                            repack_size           : element.repack_size,
                            qty_cut               : element.qty_cut,
                            remaining_days        : element.remain_days,
                            remaining_days_seconds: element.remaining_days_seconds,
                            barcode_number        : RepackData.barcode_number,
                            total_quantity        : Number(RepackData.total_quantity),
                        }
                    );
                }) 
            }  
            $('#RepackOutlife').modal('show');
        })
    }

    $scope.next_draw = false
    $scope.saveRepackOutlife = () => {
        $http.post(`store-repack-batch/${$scope.currentBatchId}`, { repack_id : localStorage.getItem('repack_outlife_id') , data : $scope.repack_outlife_table})
            .then((response) => {
                $scope.next_draw = response.data.new_draw_in
                $http.get(`repack-batch/${$scope.currentBatchId}`).then((response) => {
                    const RepackData = response.data
                    $scope.repack_outlife_table.length = 0;
                    if (RepackData.repack_outlife.length !== 0) {
                        RepackData.repack_outlife.forEach(element => {
                            $scope.repack_outlife_table.push(
                                {
                                    id     : element.id,
                                    draw_in: {
                                        status    : element.draw_in,
                                        time_stamp: element.draw_in_time_stamp
                                    },
                                    draw_out: {
                                        status    : element.draw_out,
                                        time_stamp: element.draw_out_time_stamp
                                    },
                                    last_access           : JSON.parse(RepackData.access),
                                    initial_amount        : RepackData.unit_packing_value,
                                    initial_count         : RepackData.outlife,
                                    repack_amount         : element.input_repack_amount,
                                    balance_amount        : element.remain_amount,
                                    repack_size           : element.repack_size,
                                    qty_cut               : element.qty_cut,
                                    remaining_days        : element.remain_days,
                                    remaining_days_seconds: element.remaining_days_seconds,
                                    barcode_number        : RepackData.barcode_number,
                                    total_quantity        : Number(RepackData.total_quantity),
                                }
                            );
                        }) 
                    }  
                    Message('success', "Repack Outlife Saved !")
                })
                if ($('#exportLogCheckBox').is(':checked')) {
                    location.replace(`export-repack-batch/${$scope.currentBatchId}`);
                    $('#exportLogCheckBox').prop('checked', false)
                }
                $scope.get_material_products();
                $('#RepackOutlife').modal('hide');
            })
    }
    $scope.duplicateThisBatch = (id) => {
        $http.get('duplicate-batch/' + id).then((res) => {
            window.location.replace(`material-product/form-one/${res.data.wizard_mode}/${res.data.material_product_id}/batch/${res.data.batch_id}`);
        })
    }
    $scope.changeReadStatus = (id) => {
        $http.post(change_batch_read_status + "/" + id).then((res) => {
            $scope.get_material_products()
            getNotificationCount()
        })
    }  


    $scope.extension = (batch) => {
        $scope.batch = batch
        $('#Extensionmodal').modal('show');
    }

    setTimeout(() => {
        if ($scope.extend_status_batch_id !== 'null') {
            $http.get(APP_URL + '/get-extend-expiry' + "/" + $scope.extend_status_batch_id).then((res) => {
                if(res.data != 404) {
                    $scope.batch = res.data
                    $('#Extensionmodal').modal('show');
                }
            })
        }
    }, 500);

    $scope.dispose = (batch) => {
        $scope.batch = batch
        $('#disposalModal').modal('show');
    }
    setTimeout(() => {
        if ($scope.disposal_status_batch_id !== 'null') {
            $http.get(APP_URL + '/get-disposal-expiry' + "/" + $scope.disposal_status_batch_id).then((res) => {
                if(res.data != 404) {
                    $scope.batch = res.data
                    $('#disposalModal').modal('show');
                }
            })
        }
    }, 500);

    $scope.directDeduct       = []
    $scope.deductTrackUsage   = []
    $scope.deductTrackOutlife = []

    
});
var app = angular.module('NotificationAPP',[]);
app.controller('NotificationController', function ($scope, $http) {
    var get_batch_material_products        = $('#get-batch-material-products').val();
     
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
});
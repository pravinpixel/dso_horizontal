app.controller('MasterController', function($scope, $http) {

    //===== Route List ====
    var get_masters_db          =   $('#get_masters').val();
    var store_master_category   =   $('#store_master_category').val();
    var edit_master_category    =   $('#edit_master_category').val();
    var update_master_category  =   $('#update_master_category').val();
    var delete_master_category  =   $('#delete_master_category').val();

    $scope.updateMasterName ;

    $scope.GetMaster = () => {
        $http.get(get_masters_db).then(function(response) {
            $scope.masterData        =   response.data.master_category; 
            $scope.statutoryData     =   response.data.statutory;
            $scope.pack_sizeData     =   response.data.pack_size;
            $scope.storageRoomData   =   response.data.storage_room;
            $scope.DepartmentsData   =   response.data.departments;
            $scope.houseTypesData    =   response.data.house_types;
        });
    }
    $scope.GetMaster();

    $scope.StoreMasterData = function (input_name, modal_type) {
        if(input_name == '' || input_name == null ) {
            Message('danger', 'Field is required'); 
            return false;
        }
        $http({
            method: 'POST', 
            url: store_master_category, 
            data: {
                name: input_name, 
                type: modal_type
            }
        }).then(function(response) {
            $scope.data = response.data;
            $scope.GetMaster();
            $scope.name = ''
        }, function(response) {
            $scope.data = response.data || 'Request failed';
        });
    } 
    $scope.StoreStatutoryData = function (input_name, modal_type) {
        if(input_name == '' || input_name == null ) {
            Message('danger', 'Field is required'); 
            return false;
        }
        $http({
            method: 'POST', 
            url: store_master_category, 
            data: {
                name: input_name, 
                type: modal_type
            }
        }).then(function(response) {
            $scope.data = response.data;
            $scope.GetMaster();
            $scope.statutory = ''
        }, function(response) {
            $scope.data = response.data || 'Request failed';
        });
    }
    $scope.StorePackingSizeData = function (input_name, modal_type) {
        if(input_name == '' || input_name == null ) {
            Message('danger', 'Field is required'); 
            return false;
        }
        $http({
            method: 'POST', 
            url: store_master_category, 
            data: {
                name: input_name, 
                type: modal_type
            }
        }).then(function(response) {
            $scope.data = response.data;
            $scope.GetMaster();
            $scope.pake_name = ''
        }, function(response) {
            $scope.data = response.data || 'Request failed';
        });
    }
    $scope.StoreStorageRoomData = function (input_name, modal_type) {
        if(input_name == '' || input_name == null ) {
            Message('danger', 'Field is required'); 
            return false;
        }
        $http({
            method: 'POST', 
            url: store_master_category, 
            data: {
                name: input_name, 
                type: modal_type
            }
        }).then(function(response) {
            $scope.data = response.data;
            $scope.GetMaster();
            $scope.storeage_room = ''
        }, function(response) {
            $scope.data = response.data || 'Request failed';
        });
    }
    $scope.StoreDepartmentsData = function (input_name, modal_type) {
        if(input_name == '' || input_name == null ) {
            Message('danger', 'Field is required'); 
            return false;
        }
        $http({
            method: 'POST', 
            url: store_master_category, 
            data: {
                name: input_name, 
                type: modal_type
            }
        }).then(function(response) {
            $scope.data = response.data;
            $scope.GetMaster();
            $scope.department = ''
        }, function(response) {
            $scope.data = response.data || 'Request failed';
        });
    }
    $scope.StoreHouseTypeData = function (input_name, modal_type) {
        if(input_name == '' || input_name == null ) {
            Message('danger', 'Field is required'); 
            return false;
        }
        $http({
            method: 'POST', 
            url: store_master_category, 
            data: {
                name: input_name, 
                type: modal_type
            }
        }).then(function(response) {
            $scope.data = response.data;
            $scope.GetMaster();
            $scope.house_type = ''
        }, function(response) {
            $scope.data = response.data || 'Request failed';
        });
    }
    $scope.EditMasterData = function (id, modal_type) {
        $scope.update_id = id 
        $http({
            method: 'POST', 
            url:  edit_master_category+"/"+id, 
            data: {
                name: id, 
                type: modal_type
            }
        }).then(function(response) {
            $scope.editNameValue = response.data.name;
            $scope.modal_type    =  modal_type;
            $("#edit_modal").modal("show");

        }, function(response) {
            $scope.data = response.data || 'Request failed';
        });
    }
    $scope.UpdateMasterData = function () {
    
    if($scope.editNameValue == '' || $scope.editNameValue == null ) {
            Message('danger', 'Field is required'); 
            return false;
        }
        $http({
            method: 'POST', 
            url:  update_master_category, 
            data: {
                name: $scope.editNameValue, 
                type: $scope.modal_type,
                id:$scope.update_id
            }
        }).then(function(response) {
            if(response.data.status) {
                $scope.data = response.data;
                $scope.GetMaster();
                $scope.statutory = '';
                $("#edit_modal").modal("hide");
            } else {
                Message('danger','Permission Denied ! Contact your admin')
            }
        }, function(response) {
            $scope.data = response.data || 'Request failed';
        });

    }
    $scope.DeleteMasterData = function (id, modal_type) { 
        
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
            if(isConfirm) {
                $http({
                    method: 'POST', 
                    url:  delete_master_category+'/'+id,
                    data: {
                        id: id, 
                        type: modal_type
                    }
                }).then(function(response) {
                    $scope.data = response.data;
                    $scope.GetMaster();
                    Message('success', response.data.message); 
                }, function(response) {
                    $scope.data = response.data || 'Request failed';
                });
            }
        });
    }
});

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
'use strict';
app.controller('empDeviceController', ['$scope', '$state', '$stateParams', 'Data', 'toaster', '$parse', function($scope, $state, $stateParams, Data, toaster, $parse) {
    $scope.itemsPerPage = 30;
    $scope.noOfRows = 1;
    $scope.adnBtn = "Add Device";

    //viveknk for itemperpage model dropdown
    $scope.itemsPerPageModel = [30, 100, 200, 300, 400, 500, 600, 700, 800, 900, 999];

    $scope.pageChangeHandler = function(num) {
        $scope.noOfRows = num;
        $scope.currentPage = num * $scope.itemsPerPage;
    };

    $scope.searchDetails = {};
    $scope.searchData = {};

    $scope.filterDetails = function(search) {
        //            $scope.searchDetails = {};
        $scope.searchData = search;
        $('#showFilterModal').modal('hide');
    }
    $scope.removeFilterData = function(keyvalue) {
        delete $scope.searchData[keyvalue];
        $scope.filterDetails($scope.searchData);
    }
    $scope.closeModal = function() {
        $scope.searchData = {};
    }

    $scope.initialModal = function(id, email, password, deptName, projectId, status, index, index1, del) {
        console.log('id=' + id + 'email=' + email + 'password=' + password + 'deptName=' + deptName + 'projectId=' + projectId + 'status=' + status + 'index=' + index + 'index1=' + index1 + 'del=' + del);
        $scope.sbtBtn = false;
        $scope.Add = false;
        $scope.Edit = false;
        $scope.delete = false;
        $scope.id = '';

        // $scope.clntrlBtn = true;        

        if (id == 0) {
            $scope.heading = 'Add Device';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.Add = true;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Device';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
            $scope.delete = true;
        } else {
            $scope.heading = 'Edit Device';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.Edit = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;

        $scope.index = index * ($scope.noOfRows - 1) + (index1);
        $scope.index1 = parseInt(index1);


    }


    $scope.manageDevice = function(id, action) {
            Data.post('employee-device/manageDevice', {
                id: id,
            }).then(function(response) {
                if (id === 'index') {
                    $scope.listDevices = response.records;
                }
                if (id > 0) {
                    $scope.btnLable = 'Save'
                    $scope.heading = 'Update Device Information'
                    $scope.deviceData = angular.copy(response.records[0]);
                }
                if (id === 0) {
                    $scope.heading = 'Add Device Information'
                    $scope.btnLable = 'Create';
                }
            })
        }
        //        $scope.checkemployee = function () {
        //            if ($scope.deviceData.employee_id.length === 0) {
        //                $scope.emptyEmpId = true;
        //                $scope.applyClassEmp = 'ng-active';
        //            } else {
        //                $scope.emptyEmpId = false;
        //                $scope.applyClassEmp = 'ng-inactive';
        //            }
        //        };

    $scope.saveDeviceConfig = function(id, data) {
            if (id === 0) {
                Data.post('employee-device/', {
                    id: id,
                    data: data,
                }).then(function(response) {
                    if (!response.success) {
                        var obj = response.message;
                        var selector = [];
                        for (var key in obj) {
                            var model = $parse(key); // Get the model
                            model.assign($scope, obj[key][0]); // Assigns a value to it
                            selector.push(key);

                        }
                    } else {
                        toaster.pop('success', 'Employee Device', 'Device Added successfully.');
                        $state.go('employeeDeviceIndex');
                    }
                })
            } else {
                Data.put('employee-device/' + id, {
                    id: id,
                    data: data,
                }).then(function(response) {
                    if (!response.success) {
                        toaster.pop('error', 'Employee Device', 'Something went wrong.');
                    } else {
                        toaster.pop('success', 'Employee Device', 'Device updated successfully.');
                        $state.go('employeeDeviceIndex');

                    }
                })
            }
        }
        //viveknk call to dashboard
    $scope.goDashboard = function() {
        $state.go('dashboard');
    };
}]);

app.controller('getAllEmployeesCtrl', function($scope, Data) {
    $scope.employeeList = [];
    Data.get('employee-device/getAllEmployeesList').then(function(response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.employeeList = response.records;
        }
    });
});
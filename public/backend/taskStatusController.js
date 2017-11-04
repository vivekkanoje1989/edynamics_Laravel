'use strict';
app.controller('taskStatusCtrl', ['$scope', '$state', '$stateParams', 'Data', '$rootScope', '$timeout', 'toaster', function($scope, $state, $stateParams, Data, $rootScope, $timeout, toaster) {
    //for OrderFunction
    $scope.OrderRec = 'status_name';

    $scope.itemsPerPage = 30;
    $scope.pageNumber = 1;
    $scope.noOfRows = 1;

    //viveknk for itemperpage model dropdown
    $scope.itemsPerPageModel = [1, 30, 100, 200, 300, 400, 500, 600, 700, 800, 900, 999];

    $scope.pageChanged = function(pageNo, functionName, id) {
        $scope.itemsPerPage = parseInt($scope.itemsPerPage);
        pageNo = parseInt(pageNo);
        $scope[functionName](id, pageNo, $scope.itemsPerPage);
        $scope.pageNumber = pageNo;
    };

    $scope.getStatus = function(empId, pageNumber, itemPerPage) {
        // $scope.showloader();
        Data.post('ManageTaskStatus/getStatus').then(function(response) {
            $scope.statusRow = response.records;
            $scope.statusLength = response.totalCount;
            // $scope.hideloader();
        });
    };


    $scope.getProcName = $scope.type = '';
    $scope.procName = function(procedureName, isTeam) {
        $scope.getProcName = angular.copy(procedureName);
        $scope.type = angular.copy(isTeam);
    }

    $scope.searchDetails = {};
    $scope.searchData = {};

    $scope.filterDetails = function(search) {
        //$scope.searchDetails = {};
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

    $scope.initStatus = function(id, name, index, index1, del) {
        console.log('id=' + id + 'name=' + name + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.id = id;
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add Status';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Status';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
            $scope.status_name = name;
        } else {
            $scope.heading = 'Edit Status';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
            $scope.status_name = name;
        }

        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    }

    //dynamic orderby function
    $scope.OrderFunction = function() {
        if ($scope.OrderRec == 'status_name') {
            $scope.OrderRec = '-status_name';
        } else if ($scope.OrderRec == '-status_name') {
            $scope.OrderRec = 'status_name';
        }
    }

    $scope.doStatusAction = function() {
        $scope.errorMsg = '';
        if ($scope.id === 0) //for create
        {
            if ($scope.domethod == 'post') {
                Data.post('ManageTaskStatus/', {
                    status_name: $scope.status_name
                }).then(function(response) {
                    // response = json_decode(response);
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        $scope.statusRow = response.records;
                        $scope.statusLength = response.totalCount;

                        // $scope.bloodGrpRow.push({ 'blood_group': $scope.blood_group, 'id': response.lastinsertid });
                        $('#statusModal').modal('toggle');
                        toaster.pop('success', 'Manage Task Status', 'Record Created Successfully');
                        //$scope.success("Blood group details created successfully");
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update
            if ($scope.domethod == 'put') {
                // alert('blood_group:' + $scope.blood_group + 'id:' + $scope.blood_group_id);
                Data.put('ManageTaskStatus/' + $scope.id, { status_name: $scope.status_name, id: $scope.id }).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        $scope.statusRow = response.records;
                        $scope.statusLength = response.totalCount;

                        // $scope.bloodGrpRow.splice($scope.index, 1);
                        // $scope.bloodGrpRow.splice($scope.index, 0, {
                        //     blood_group: $scope.blood_group,
                        //     id: $scope.id
                        // });
                        $('#statusModal').modal('toggle');
                        toaster.pop('success', 'Manage Task Status', 'Record Updated Successfully');
                        // $scope.success("Blood group details updated successfully");
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('ManageTaskStatus/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                        toaster.pop('error', 'Manage Task Status', $scope.errorMsg);
                    } else {
                        $scope.statusRow = response.records;
                        $scope.statusLength = response.totalCount;

                        $('#statusModal').modal('toggle');
                        toaster.pop('success', 'Manage Task Status', 'Record Deleted Successfully');
                    }
                });
            }
        }
    }

    //vivek  ---delete model close
    $scope.Cancel = function() {
        $('#statusModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        $scope.getexcel = window.location = "/ManageTaskStatus/exportToxls";
        if ($scope.getexcel) {
            toaster.pop('info', '', 'Exporting....');
        } else {
            toaster.pop('error', '', 'Exporting fails....');
        }
    };

    $scope.pageChangeHandler = function(num) {
        $scope.itemsPerPage = parseInt($scope.itemsPerPage);
        $scope.noOfRows = parseInt(num);
        $scope.currentPage = num * $scope.itemsPerPage;
    };

    //viveknk call to dashboard
    $scope.goDashboard = function() {
        $state.go('dashboard');
    };

}]);
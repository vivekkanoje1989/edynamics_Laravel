'use strict';
app.controller('bloodsGroupCtrl', ['$scope', '$state', '$stateParams', 'Data', '$rootScope', '$timeout', 'toaster', function($scope, $state, $stateParams, Data, $rootScope, $timeout, toaster) {
    //for OrderFunction
    $scope.OrderRec = 'blood_group';

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

    $scope.manageBloodGroup = function(empId, pageNumber, itemPerPage) {
        $scope.showloader();
        Data.post('blood-groups/manageBloodGroup').then(function(response) {
            $scope.bloodGrpRow = response.records;
            $scope.bloodGrpLength = response.totalCount;
            $scope.hideloader();
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

    $scope.initialModal = function(id, name, index, index1, del) {
        console.log('id=' + id + 'name=' + name + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add Blood Group';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Blood Group';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Blood Group';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.blood_group_id = id;
        $scope.blood_group = name;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    }

    //dynamic orderby function
    $scope.OrderFunction = function() {
        if ($scope.OrderRec == 'blood_group') {
            $scope.OrderRec = '-blood_group';
        } else if ($scope.OrderRec == '-blood_group') {
            $scope.OrderRec = 'blood_group';
        }
    }

    $scope.doBloodGroupAction = function() {
        $scope.errorMsg = '';
        if ($scope.blood_group_id === 0) //for create
        {
            if ($scope.domethod == 'post') {
                Data.post('blood-groups/', {
                    blood_group: $scope.blood_group
                }).then(function(response) {
                    // response = json_decode(response);
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        $scope.bloodGrpRow = response.records;
                        $scope.bloodGrpLength = response.totalCount;

                        // $scope.bloodGrpRow.push({ 'blood_group': $scope.blood_group, 'id': response.lastinsertid });
                        $('#bloodGroupModal').modal('toggle');
                        toaster.pop('success', 'Manage Blood Group', 'Record Created Successfully');
                        //$scope.success("Blood group details created successfully");
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update
            if ($scope.domethod == 'put') {
                // alert('blood_group:' + $scope.blood_group + 'id:' + $scope.blood_group_id);
                Data.put('blood-groups/' + $scope.blood_group_id, { blood_group: $scope.blood_group, id: $scope.blood_group_id }).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        $scope.bloodGrpRow = response.records;
                        $scope.bloodGrpLength = response.totalCount;

                        // $scope.bloodGrpRow.splice($scope.index, 1);
                        // $scope.bloodGrpRow.splice($scope.index, 0, {
                        //     blood_group: $scope.blood_group,
                        //     id: $scope.id
                        // });
                        $('#bloodGroupModal').modal('toggle');
                        toaster.pop('success', 'Manage Blood Group', 'Record Updated Successfully');
                        // $scope.success("Blood group details updated successfully");
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('blood-groups/' + $scope.blood_group_id).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                        toaster.pop('error', 'Manage Blood Group', $scope.errorMsg);
                    } else {
                        $scope.bloodGrpRow = response.records;
                        $scope.bloodGrpLength = response.totalCount;

                        $('#bloodGroupModal').modal('toggle');
                        toaster.pop('success', 'Manage Blood Group', 'Record Deleted Successfully');
                    }
                });
            }
        }
    }

    //vivek  ---delete model close
    $scope.Cancel = function() {
        $('#bloodGroupModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        $scope.getexcel = window.location = "/blood-groups/exportToxls";
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

    //viveknk call to Manage blood group
    $scope.goManageBloodgrp = function() {
        $state.go('bloodGroupsIndex');
    };


}]);
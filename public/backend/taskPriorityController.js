'use strict';
app.controller('taskPriorityCtrl', ['$scope', '$state', '$stateParams', 'Data', '$rootScope', '$timeout', '$http', 'toaster', function($scope, $state, $stateParams, Data, $rootScope, $timeout, $http, toaster) {
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

    $scope.getPriority = function() {
        Data.post('ManageTaskPriority/getPriority').then(function(response) {
            console.log('response=' + $scope.response);
            $scope.tskpriorityRow = response.records;
            $scope.tskPriorityLength = response.totalCount;
            console.log('tskpriorityRow=' + $scope.tskPriorityLength);
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

    $scope.initTskPriority = function(id, priority, index, index1, del) {
        console.log('id=' + id + 'priority=' + priority + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        $scope.id = id;
        if (id == 0) {
            $scope.heading = 'Add Priority';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Priority';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';

            $scope.id = id;
            $scope.priority_name = priority;
        } else {
            $scope.heading = 'Edit Priority';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';


            $scope.priority_name = priority;
        }

        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    }

    //dynamic orderby function
    $scope.OrderFunction = function() {
        if ($scope.OrderRec == 'priority_name') {
            $scope.OrderRec = '-priority_name';
        } else if ($scope.OrderRec == '-priority_name') {
            $scope.OrderRec = 'priority_name';
        }
    }

    $scope.doPriorityAction = function() {

        $scope.errorMsg = '';
        if ($scope.id === 0) //for create
        {
            if ($scope.domethod == 'post') {

                Data.post('ManageTaskPriority', {
                    priority_name: $scope.priority_name
                }).then(function(response) {
                    // response = json_decode(response);
                    if (!response.success) {
                        toaster.pop('error', 'Manage Task Priority', response.errormsg);
                    } else {

                        $scope.tskpriorityRow = response.records;
                        $scope.tskPriorityLength = response.totalCount;
                        console.log('tskpriorityRow+=' + $scope.tskPriorityLength);
                        // $scope.bloodGrpRow.push({ 'blood_group': $scope.blood_group, 'id': response.lastinsertid });
                        $('#taskPriorityModal').modal('toggle');
                        toaster.pop('success', 'Manage Task Priority', 'Record Created Successfully');
                        //$scope.success("Blood group details created successfully");
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update
            if ($scope.domethod == 'put') {
                // alert('blood_group:' + $scope.blood_group + 'id:' + $scope.blood_group_id);
                Data.put('ManageTaskPriority/' + $scope.id, { priority_name: $scope.priority_name, id: $scope.id }).then(function(response) {

                    if (!response.success) {
                        toaster.pop('error', 'Manage Task Priority', response.errormsg);
                    } else {
                        $scope.tskpriorityRow = response.records;
                        $scope.tskPriorityLength = response.totalCount;
                        $('#taskPriorityModal').modal('toggle');
                        toaster.pop('success', 'Manage Task Priority', 'Record Updated Successfully');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('ManageTaskPriority/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        toaster.pop('error', 'Manage Task Priority', response.errormsg);
                    } else {
                        $scope.tskpriorityRow = response.records;
                        $scope.tskPriorityLength = response.totalCount;

                        $('#taskPriorityModal').modal('toggle');
                        toaster.pop('success', 'Manage Task Priority', 'Record Deleted Successfully');
                    }
                });
            }
        }
    }

    //vivek  ---delete model close
    $scope.Cancel = function() {
        $('#taskPriorityModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        $scope.getexcel = window.location = "/ManageTaskPriority/exportToxls";
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
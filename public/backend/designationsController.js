app.controller('designationsCtrl', ['$scope', 'Data', 'toaster', '$rootScope', '$timeout', '$location', function($scope, Data, toaster, $rootScope, $timeout, $location) {
    //for OrderFunction
    $scope.OrderRec = 'designation';

    $scope.adnBtn = "Add New Designation";
    $scope.itemsPerPage = 30;
    $scope.desig_btn = false;
    $scope.noOfRows = 1;

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


    $scope.manageDesignations = function() {
        Data.post('manage-designations/manageDesignations').then(function(response) {
            $scope.designationsRow = response.records;
            $scope.designationRowLength = response.totalcount;
        });
    };

    $scope.initialModal = function(id, designation, status, index, index1, del) {
        console.log('id=' + id + 'name=' + name + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add Designation';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Designation';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Designation';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.designation = designation;
        $scope.status = status;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    };

    //dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'Designations') {
            if ($scope.OrderRec == 'designation') {
                $scope.OrderRec = '-designation';
            } else if ($scope.OrderRec == '-designation') {
                $scope.OrderRec = 'designation';
            } else if ($scope.OrderRec == '-status') {
                $scope.OrderRec = 'designation';
            } else if ($scope.OrderRec == 'status') {
                $scope.OrderRec = 'designation';
            }
        } else if (sort == 'Status') {
            if ($scope.OrderRec == 'status') {
                $scope.OrderRec = '-status';
            } else if ($scope.OrderRec == '-status') {
                $scope.OrderRec = 'status';
            } else if ($scope.OrderRec == 'designation') {
                $scope.OrderRec = 'status';
            } else if ($scope.OrderRec == '-designation') {
                $scope.OrderRec = 'status';
            }
        }
    }

    $scope.dodesignationsAction = function() {
        $scope.errorMsg = '';
        $scope.desig_btn = true;
        if ($scope.id === 0) //for create
        {
            $scope.desig_btn = false;
            if ($scope.domethod == 'post') {
                Data.post('manage-designations/', {
                    designation: $scope.designation,
                    status: $scope.status
                }).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.designationsRow.push({ 'designation': $scope.designation, 'id': response.lastinsertid, 'status': $scope.status });
                        $('#designations').modal('toggle');
                        toaster.pop('success', 'Manage designations', 'Record successfully created');
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update
            $scope.desig_btn = false;
            if ($scope.domethod == 'put') {
                Data.put('manage-designations/' + $scope.id, {
                    designation: $scope.designation,
                    'status': $scope.status
                }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        // if ($scope.index != 0) {
                        //     $scope.designationsRow.splice($scope.index, 1);
                        //     $scope.designationsRow.splice($scope.index, 0, {designation: $scope.designation, 'status': $scope.status, id: $scope.id});
                        // } else {
                        $scope.manageDesignations();
                        // }
                        $('#designations').modal('toggle');
                        toaster.pop('success', 'Manage designations', 'Record successfully updated');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('manage-designations/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.manageDesignations();
                        $('#designations').modal('toggle');
                        toaster.pop('success', 'Manage designations', 'Record Deleted successfully');
                    }
                });
            }
        }
    };

    //vivek delete
    $scope.Cancel = function() {
        $('#designations').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        ///$scope.getexcel = window.location = "/manage-designations/exportToxls";
        if (window.location = "/manage-designations/exportToxls") {
            toaster.pop('info', '', 'Exporting....');
        } else {
            toaster.pop('error', '', 'Exporting fails....');
        }
    };

    $scope.pageChangeHandler = function(num) {
        $scope.noOfRows = num;
        $scope.currentPage = num * $scope.itemsPerPage;
    };

}]);
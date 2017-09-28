app.controller('verticalCtrl', ['$scope', 'Data', 'toaster', '$rootScope', '$timeout', '$location', function($scope, Data, toaster, $rootScope, $timeout, $location) {
    //for OrderFunction
    $scope.OrderRec = 'name';
    $scope.adnBtn = "Add New Vertical";

    $scope.itemsPerPage = 30;
    $scope.pageNumber = 1;
    $scope.noOfRows = 1;
    // $scope.flagForChange = 0;
    // $scope.vertBtn = false;

    $scope.pageChanged = function(pageNo, functionName, id) {
        $scope[functionName](id, pageNo, $scope.itemsPerPage);
        $scope.pageNumber = pageNo;
    };

    $scope.manageVerticals = function(empId, pageNumber, itemPerPage) {
        $scope.showloader();
        Data.get('/manageVerticals/manageVerticals').then(function(response) {
            $scope.hideloader();
            $scope.verticalRow = response.records;
            $scope.verticalRowLength = response.totalCount;
            //$scope.flagForChange = 0;
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
            $scope.heading = 'Add Vertical';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Vertical';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Vertical';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.vertical = name;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    }

    //dynamic orderby function
    $scope.OrderFunction = function() {
        if ($scope.OrderRec == 'name') {
            $scope.OrderRec = '-name';
        } else if ($scope.OrderRec == '-name') {
            $scope.OrderRec = 'name';
        }
    }

    $scope.doVerticalAction = function() {
        $scope.errorMsg = '';
        if ($scope.id == 0) //for store
        {
            if ($scope.domethod == 'post') {
                Data.post('/manageVerticals', { name: $scope.vertical }).then(function(response) {
                    // console.log("response"+ response);
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.verticalRow = response.records;
                        $scope.verticalRowLength = response.totalCount;
                        // $scope.flagForChange = 0;
                        $('#verticalModal').modal('toggle');
                        toaster.pop('success', 'Manage Verticals ', 'Record successfully Added');
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update

            if ($scope.domethod == 'put') {
                Data.put('/manageVerticals/' + $scope.id, { name: $scope.vertical, id: $scope.id }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.verticalRow = response.records;
                        $scope.verticalRowLength = response.totalCount;
                        // $scope.flagForChange = 0;
                        $('#verticalModal').modal('toggle');
                        toaster.pop('success', 'Manage Verticals ', 'Record successfully updated');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete

                Data.delete('/manageVerticals/' + $scope.id).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.verticalRow = response.records;
                        $scope.verticalRowLength = response.totalCount;
                        // $scope.flagForChange = 0;
                        $('#verticalModal').modal('toggle');
                        toaster.pop('success', 'Manage Verticals ', 'Record Deleted successfully');
                    }
                });
            }
        }
    }

    //vivek Delete
    $scope.Cancel = function() {
        $('#verticalModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        $scope.getexcel = window.location = "/manageVerticals/exportToxls";
        if ($scope.getexcel) {
            toaster.pop('info', '', 'Exporting....');
        } else {
            toaster.pop('error', '', 'Exporting fails....');
        }
    };

    //paginator
    $scope.pageChangeHandler = function(num) {
        $scope.noOfRows = parseInt(num);
        $scope.itemsPerPage = parseInt($scope.itemsPerPage);
        $scope.currentPage = num * $scope.itemsPerPage;
    };
}]);
app.controller('titleController', ['$scope', '$state', '$stateParams', 'Data', 'toaster', '$rootScope', '$timeout', '$location', function($scope, $state, $stateParams, Data, toaster, $rootScope, $timeout, $location) {
    //for OrderFunction
    $scope.OrderRec = 'title';
    $scope.adnBtn = "Add New Title";

    $scope.itemsPerPage = 30;
    $scope.pageNumber = 1;
    $scope.noOfRows = 1;
    $scope.errorMsg = '';

    $scope.pageChanged = function(pageNo, functionName, id) {
        $scope[functionName](id, pageNo, $scope.itemsPerPage);
        $scope.pageNumber = pageNo;
    };

    $scope.manageTitle = function(empId, pageNumber, itemPerPage) {
        $scope.showloader();
        Data.get('/manageTitle/getTitle').then(function(response) {
            $scope.hideloader();
            $scope.titleRow = response.records;
            $scope.titleRowLength = response.totalCount;
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

    $scope.initialModal = function(id, title, status, index, index1, del) {
        console.log('id=' + id + 'title=' + title + 'status=' + status + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add Title';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Title';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Title';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.title = title;
        $scope.status = status;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
        $scope.index1 = index1;
    }

    //dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'Title') {
            if ($scope.OrderRec == 'title') {
                $scope.OrderRec = '-title';
            } else if ($scope.OrderRec == '-title') {
                $scope.OrderRec = 'title';
            } else if ($scope.OrderRec == 'status') {
                $scope.OrderRec = 'title';
            } else if ($scope.OrderRec == '-status') {
                $scope.OrderRec = 'title';
            }
        } else if (sort == 'Status') {
            if ($scope.OrderRec == 'status') {
                $scope.OrderRec = '-status';
            } else if ($scope.OrderRec == '-status') {
                $scope.OrderRec = 'status';
            } else if ($scope.OrderRec == 'title') {
                $scope.OrderRec = 'status';
            } else if ($scope.OrderRec == '-title') {
                $scope.OrderRec = 'status';
            }
        }
    }

    $scope.doTitleAction = function() {
        $scope.errorMsg = '';
        if ($scope.id == 0) //for store
        {
            //$scope.sbtBtn = false;
            if ($scope.domethod == 'post') {
                Data.post('/manageTitle', { title: $scope.title, status: $scope.status }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        // $scope.clientRoleRow = response.records;
                        $scope.titleRowLength = response.totalCount;
                        $scope.last_insertedId = response.last_insertedId
                            // $scope.flagForChange = 0;
                        $scope.titleRow.push({ 'id': $scope.last_insertedId, 'title': $scope.title, 'status': $scope.status });

                        $('#titleModal').modal('toggle');
                        toaster.pop('success', 'Manage Titles ', 'Record Added successfully');
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update

            if ($scope.domethod == 'put') {
                Data.put('/manageTitle/' + $scope.id, { title: $scope.title, status: $scope.status, id: $scope.id }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.titleRow = response.records;
                        $scope.titleRowLength = response.totalCount;
                        // $scope.flagForChange = 0;
                        // console.log("clientRoleRow bfr" + JSON.stringify($scope.clientRoleRow));
                        // $scope.clientRoleRow.splice($scope.index1 - 1, 1);
                        // $scope.clientRoleRow.splice($scope.index1, 1, { id: $scope.id, role_name: $scope.role_name, status: $scope.status });
                        // console.log("clientRoleRow aftr" + JSON.stringify($scope.clientRoleRow));

                        // $scope.clientRoleRow.push({ id: $scope.id, role_name: $scope.role_name, status: $scope.status });
                        $('#titleModal').modal('toggle');
                        toaster.pop('success', 'Manage Titles ', 'Record successfully updated');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete

                Data.delete('/manageTitle/' + $scope.id).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.titleRow = response.records;
                        $scope.titleRowLength = response.totalCount;
                        // $scope.clientRoleRow.splice($scope.index1 - 1, 1);
                        // $scope.flagForChange = 0;
                        $('#titleModal').modal('toggle');
                        toaster.pop('success', 'Manage Titles ', 'Record Deleted successfully');
                    }
                });
            }
        }
    }

    //vivek Delete
    $scope.Cancel = function() {
        $('#titleModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {
        if (window.location = "/manageTitle/exportToxls") {
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

    //viveknk call to dashboard
    $scope.goDashboard = function() {
        $state.go('dashboard');
    };
}]);
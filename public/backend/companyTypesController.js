app.controller('companyTypesController', ['$scope', 'Data', 'toaster', '$rootScope', '$timeout', '$location', function($scope, Data, toaster, $rootScope, $timeout, $location) {
    //for OrderFunction
    $scope.OrderRec = 'type_of_company';
    $scope.adnBtn = "Add New Company Type";

    $scope.itemsPerPage = 30;
    $scope.pageNumber = 1;
    $scope.noOfRows = 1;
    $scope.errorMsg = '';

    $scope.pageChanged = function(pageNo, functionName, id) {
        $scope[functionName](id, pageNo, $scope.itemsPerPage);
        $scope.pageNumber = pageNo;
    };

    $scope.manageCompanyType = function(empId, pageNumber, itemPerPage) {
        $scope.showloader();
        Data.get('/manageCompanyTypes/getCompanyTypes').then(function(response) {
            $scope.hideloader();
            $scope.companyTypesRow = response.records;
            $scope.companyTypesRowLength = response.totalCount;
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

    $scope.initialModal = function(id, type_of_company, status, index, index1, del) {
        console.log('id=' + id + 'type_of_company=' + type_of_company + 'status=' + status + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add Company Type';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Company Type';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Company Type';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.type_of_company = type_of_company;
        $scope.status = status;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
        $scope.index1 = index1;
    }

    //dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'CType') {
            if ($scope.OrderRec == 'type_of_company') {
                $scope.OrderRec = '-type_of_company';
            } else if ($scope.OrderRec == '-type_of_company') {
                $scope.OrderRec = 'type_of_company';
            } else if ($scope.OrderRec == 'status') {
                $scope.OrderRec = 'type_of_company';
            } else if ($scope.OrderRec == '-status') {
                $scope.OrderRec = 'type_of_company';
            }
        } else if (sort == 'Status') {
            if ($scope.OrderRec == 'status') {
                $scope.OrderRec = '-status';
            } else if ($scope.OrderRec == '-status') {
                $scope.OrderRec = 'status';
            } else if ($scope.OrderRec == 'type_of_company') {
                $scope.OrderRec = 'status';
            } else if ($scope.OrderRec == '-type_of_company') {
                $scope.OrderRec = 'status';
            }
        }
    }

    $scope.doTypeOfCompanyAction = function() {
        $scope.errorMsg = '';
        if ($scope.id == 0) //for store
        {
            //$scope.sbtBtn = false;
            if ($scope.domethod == 'post') {
                Data.post('/manageCompanyTypes', { type_of_company: $scope.type_of_company, status: $scope.status }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        // $scope.clientRoleRow = response.records;
                        $scope.companyTypesRowLength = response.totalCount;
                        $scope.last_insertedId = response.last_insertedId
                            // $scope.flagForChange = 0;
                        $scope.companyTypesRow.push({ 'id': $scope.last_insertedId, 'type_of_company': $scope.type_of_company, 'status': $scope.status });

                        $('#typeOfCompanyModal').modal('toggle');
                        toaster.pop('success', 'Manage Company Type', 'Record Added successfully');
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update

            if ($scope.domethod == 'put') {
                Data.put('/manageCompanyTypes/' + $scope.id, { type_of_company: $scope.type_of_company, status: $scope.status, id: $scope.id }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.companyTypesRow = response.records;
                        $scope.companyTypesRowLength = response.totalCount;
                        // $scope.flagForChange = 0;
                        // console.log("clientRoleRow bfr" + JSON.stringify($scope.clientRoleRow));
                        // $scope.clientRoleRow.splice($scope.index1 - 1, 1);
                        // $scope.clientRoleRow.splice($scope.index1, 1, { id: $scope.id, role_name: $scope.role_name, status: $scope.status });
                        // console.log("clientRoleRow aftr" + JSON.stringify($scope.clientRoleRow));

                        // $scope.clientRoleRow.push({ id: $scope.id, role_name: $scope.role_name, status: $scope.status });
                        $('#typeOfCompanyModal').modal('toggle');
                        toaster.pop('success', 'Manage Company Type', 'Record successfully updated');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete

                Data.delete('/manageCompanyTypes/' + $scope.id).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.companyTypesRow = response.records;
                        $scope.companyTypesRowLength = response.totalCount;
                        // $scope.clientRoleRow.splice($scope.index1 - 1, 1);
                        // $scope.flagForChange = 0;
                        $('#typeOfCompanyModal').modal('toggle');
                        toaster.pop('success', 'Manage Company Type', 'Record Deleted successfully');
                    }
                });
            }
        }
    }

    //vivek Delete
    $scope.Cancel = function() {
        $('#typeOfCompanyModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {
        if (window.location = "/manageCompanyTypes/exportToxls") {
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
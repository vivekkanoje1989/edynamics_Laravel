app.controller('statesCtrl', ['$scope', 'Data', 'toaster', '$rootScope', '$timeout', '$location', function($scope, Data, toaster, $rootScope, $timeout, $location) {
    //for OrderFunction
    $scope.OrderRec = 'name';

    $scope.itemsPerPage = 30;
    $scope.pageNumber = 1;
    $scope.noOfRows = 1;
    $scope.flagForChange = 0;
    //        $scope.pageChanged = function (pageNo, functionName, id) {
    //            $scope[functionName](id, pageNo, $scope.itemsPerPage);
    //            $scope.pageNumber = pageNo;
    //        };


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

    //        $scope.pageChanged = function (pageNo, functionName, id, newpage) {
    //            $scope.flagForChange++;
    //            if ($scope.flagForChange == 1)
    //            {
    //                if (($scope.filterData && Object.keys($scope.filterData).length > 0)) {
    //                    $scope.filteredData($scope.filterData, pageNo, $scope.itemsPerPage);
    //                } else {
    //                    $scope[functionName](id, pageNo, $scope.itemsPerPage);
    //                }
    //            }
    //            $scope.pageNumber = pageNo;
    //        }

    $scope.manageStates = function(empId, pageNumber, itemPerPage) {
        Data.post('manage-states/manageStates').then(function(response) {
            $scope.statesRow = response.records;
            $scope.statesRowLength = response.totalCount;
            $scope.flagForChange = 0;
        });
    };

    //        $scope.getProcName = $scope.type = '';
    //        $scope.procName = function (procedureName, isTeam) {
    //            $scope.getProcName = angular.copy(procedureName);
    //            $scope.type = angular.copy(isTeam);
    //        }
    //
    //
    //        $scope.filterData = {};
    //        $scope.data = {};
    //
    //        $scope.filteredData = function (data, page, noOfRecords) {
    //            $scope.showloader();
    //            Data.post('manage-states/filteredData', {filterData: data, getProcName: $scope.getProcName, pageNumber: page, itemPerPage: noOfRecords}).then(function (response) {
    //                if (response.success)
    //                {
    //                    $scope.statesRow = response.records;
    //                    $scope.statesRowLength = response.totalCount;
    //                } else
    //                {
    //                    $scope.statesRow = response.records;
    //                    $scope.statesRowLength = 0;
    //                }
    //                $('#showFilterModal').modal('hide');
    //                $scope.showFilterData = $scope.filterData;
    //                $scope.hideloader();
    //                $scope.flagForChange = 0;
    //                return false;
    //
    //            });
    //        }

    // $scope.removeDataFromFilter = function(keyvalue) {
    //     delete $scope.filterData[keyvalue];
    //     $scope.filteredData($scope.filterData, 1, 30);
    // }


    $scope.manageCountry = function() {
        Data.get('manage-states/manageCountry').then(function(response) {
            $scope.countryRow = response.records;
        });
    };

    $scope.initialModal = function(id, name, country, country_id, index, index1, del) {
        console.log('id=' + id + 'name=' + name + 'country=' + country + 'country_id=' + country_id + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add State';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete State';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit State';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.name = name;
        $scope.statesForm.index = index * ($scope.noOfRows - 1) + (index1 + 1);
        $scope.country = country;
        $scope.country_id = country_id;
    }

    //dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'Country') {
            if ($scope.OrderRec == 'name') {
                $scope.OrderRec = 'country_name';
            } else if ($scope.OrderRec == '-country_name') {
                $scope.OrderRec = 'country_name';
            } else if ($scope.OrderRec == '-country_name') {
                $scope.OrderRec = 'country_name';
            }
        } else if (sort == 'State') {
            if ($scope.OrderRec == 'name') {
                $scope.OrderRec = '-name';
            } else if ($scope.OrderRec == '-name') {
                $scope.OrderRec = 'name';
            }
        }
    }

    $scope.doStatesAction = function() {

        $scope.errorMsg = '';
        if ($scope.id == 0) //for create
        {
            if ($scope.domethod == 'post') {
                Data.post('manage-states/', {
                    name: $scope.name,
                    country_id: $scope.country_id
                }).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.statesRow = response.records;
                        $scope.statesRowLength = response.totalCount;
                        $('#statesModal').modal('toggle');
                        // $scope.statesRow.push({ 'name': $scope.name, 'id': response.lastinsertid, 'country_id': $scope.country_id, 'country_name': response.country_name });
                        //$scope.success("State details created successfully");
                        toaster.pop('success', 'Manage Sates ', 'Record successfully Added');
                    }
                });
            } else { console.log("domethod"); }
        } else {
            if ($scope.domethod == 'put') { //for update
                //alert("doStatesAction");
                Data.put('manage-states/' + $scope.id, {
                    name: $scope.name,
                    id: $scope.id,
                    country_id: $scope.country_id
                }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        // $scope.statesRow.splice($scope.statesForm.index - 1, 1);
                        // $scope.statesRow.splice($scope.statesForm.index - 1, 0, { name: $scope.name, id: $scope.id, country_name: $scope.country, 'country_id': $scope.country_id, 'country_name': response.country_name});
                        //$scope.success("State details updated successfully");

                        // Data.post('manage-states/manageStates').then(function(response) {
                        //     $scope.statesRow = response.records;
                        //     $scope.statesRowLength = response.totalCount;
                        //     $scope.flagForChange = 0;
                        //     $('#statesModal').modal('toggle');
                        //     toaster.pop('success', 'Manage Sates ', 'Record successfully updated');
                        // });

                        $scope.statesRow = response.records;
                        $scope.statesRowLength = response.totalCount;
                        $('#statesModal').modal('toggle');
                        toaster.pop('success', 'Manage Sates ', 'Record successfully updated');
                        //     toaster.pop('success', 'Manage Sates ', 'Record successfully updated');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('manage-states/' + $scope.id).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        // $('#statesModalD').modal('toggle');
                        // $scope.statesRow.push({'name': $scope.name, 'id': response.lastinsertid, 'country_id': $scope.country_id, 'country_name': response.country_name});
                        // //$scope.success("State details created successfully");
                        // toaster.pop('success', 'Manage Sates ', 'Record Deleted successfully');

                        // Data.post('manage-states/manageStates').then(function(response) {
                        //     $scope.statesRow = response.records;
                        //     $scope.statesRowLength = response.totalCount;
                        //     $scope.flagForChange = 0;
                        //     $('#statesModal').modal('toggle');
                        //     toaster.pop('success', 'Manage Sates ', 'Record Deleted successfully');
                        // });

                        $scope.statesRow = response.records;
                        $scope.statesRowLength = response.totalCount;
                        $('#statesModal').modal('toggle');
                        toaster.pop('success', 'Manage Sates ', 'Record Deleted successfully');
                    }
                });
            }
        }
    }

    $scope.Cancel = function() {
        $('#statesModal').modal('toggle');
    };

    // $scope.success = function(message) {
    //     Flash.create('success', message);
    // };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        $scope.getexcel = window.location = "/manage-states/exportToxls";
        if ($scope.getexcel) {
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
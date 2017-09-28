app.controller('countryCtrl', ['$scope', 'Data', 'toaster', function($scope, Data, toaster) {
    //for OrderFunction
    $scope.OrderRec = 'name';

    $scope.itemsPerPage = 30;
    $scope.pageNumber = 1;
    $scope.noOfRows = 1;

    $scope.pageChanged = function(pageNo, functionName, id) {
        $scope[functionName](id, pageNo, $scope.itemsPerPage);
        $scope.pageNumber = pageNo;
    };

    $scope.manageCountry = function(empId, pageNumber, itemPerPage) {
        Data.post('manage-country/manageCountry', {
            id: empId,
            pageNumber: pageNumber,
            itemPerPage: itemPerPage,
        }).then(function(response) {
            $scope.countryRow = response.records;
            $scope.countryRowLength = response.totalCount;
            console.log("countryRowLength" + $scope.countryRowLength);
        });
    };

    $scope.searchData = {};
    $scope.searchDetails = {};

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
    //            page = noOfRecords * (page - 1);
    //            Data.post('manage-country/filteredData', {filterData: data, getProcName: $scope.getProcName, pageNumber: page, itemPerPage: noOfRecords}).then(function (response) {
    //                if (response.success)
    //                {
    //                    $scope.countryRow = response.records;
    //                    $scope.countryRowLength = response.totalCount;
    //                } else
    //                {
    //                    $scope.countryRow = response.records;
    //                    $scope.countryRowLength = 0;
    //                }
    //                $('#showFilterModal').modal('hide');
    //                $scope.showFilterData = $scope.filterData;
    //                $scope.hideloader();
    //                return false;
    //
    //            });
    //        }
    //
    //        $scope.removeDataFromFilter = function (keyvalue)
    //        {
    //            delete $scope.filterData[keyvalue];
    //            $scope.filteredData($scope.filterData, 1, 30);
    //        }

    $scope.initialModal = function(id, name, index, index1, phonecode, sortname, del) {
        console.log('id=' + id + 'name=' + name + 'index=' + index + 'index1=' + index1 + 'phonecode' + phonecode + 'sortname' + sortname + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add Country';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Country';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Country';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }

        $scope.id = id;
        $scope.name = name;
        $scope.index = index * ($scope.noOfRows - 1) + (index1 + 1);
        $scope.phonecode = phonecode;
        $scope.sortname = sortname;
    }

    //dynamic orderby function
    $scope.OrderFunction = function() {
        if ($scope.OrderRec == 'name') {
            $scope.OrderRec = '-name';
        } else if ($scope.OrderRec == '-name') {
            $scope.OrderRec = 'name';
        }
    }

    $scope.doCountryAction = function() {
        $scope.errorMsg = '';

        if ($scope.id == 0) //for create
        {
            if ($scope.domethod == 'post') {
                Data.post('manage-country/', {
                    name: $scope.name,
                    phonecode: $scope.phonecode,
                    sortname: $scope.sortname
                }).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        // $scope.countryRow.push({ 'name': $scope.name, 'id': response.lastinsertid, 'sortname': $scope.sortname, 'phonecode': $scope.phonecode });
                        $scope.countryRow = response.records;
                        $scope.countryRowLength = response.totalCount;
                        $('#countryModal').modal('toggle');
                        //$scope.success("Country details created successfully");
                        toaster.pop('success', 'Manage Country', 'Record Created Successfully');
                    }
                });
            } else { console.log("domethod"); }

        } else { //for update

            if ($scope.domethod == 'put') {
                Data.put('manage-country/' + $scope.id, {
                    name: $scope.name,
                    id: $scope.id,
                    'sortname': $scope.sortname,
                    'phonecode': $scope.phonecode
                }).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        // $scope.countryRow.splice($scope.index - 1, 1);
                        // $scope.countryRow.splice($scope.index - 1, 0, {
                        //     name: $scope.name,
                        //     id: $scope.id,
                        //     name: $scope.name,
                        //     'sortname': $scope.sortname,
                        //     'phonecode': $scope.phonecode
                        // });

                        $scope.countryRow = response.records;
                        $scope.countryRowLength = response.totalCount;

                        $('#countryModal').modal('toggle');
                        toaster.pop('success', 'Manage Country', 'Record Updated Successfully');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('manage-country/' + $scope.id).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        // $scope.countryRow.splice($scope.index - 1, 1);
                        // $scope.countryRow.splice($scope.index - 1, 0, { name: $scope.name, id: $scope.id, name: $scope.name, 'sortname': $scope.sortname, 'phonecode': $scope.phonecode});
                        $scope.countryRow = response.records;
                        $scope.countryRowLength = response.totalCount;
                        console.log("countryRowLength" + $scope.countryRowLength);
                        $('#countryModal').modal('toggle');
                        toaster.pop('success', 'Manage Country', 'Record Deleted Successfully');
                    }
                });
            }

        }
    }

    //for delete
    $scope.Cancel = function() {
        $('#countryModal').modal('toggle');
    };

    $scope.pageChangeHandler = function(num) {
        $scope.noOfRows = parseInt(num);
        $scope.itemsPerPage = parseInt($scope.itemsPerPage);
        $scope.currentPage = num * $scope.itemsPerPage;
    };

}]);
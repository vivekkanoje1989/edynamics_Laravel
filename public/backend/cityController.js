app.controller('citiesCtrl', ['$scope', 'Data', 'toaster', function($scope, Data, toaster) {
    //for OrderFunction
    $scope.OrderRec = 'name';

    $scope.itemsPerPage = 30;
    $scope.noOfRows = 1;

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


    $scope.manageCities = function() {
        Data.get('manage-city/manageCity').then(function(response) {
            $scope.a = JSON.parse(JSON.stringify(response));
            $scope.citiesRow = $scope.a.records;
            $scope.citiesRowLength = $scope.a.totalCount
        });
    };
    $scope.manageStates = function($id, country_id) {
        if ($id == 1) {
            $scope.country_name_id = country_id;

        } else {
            $scope.country_id = $scope.countryRow[$scope.country_id - 1].id;

        }
        Data.post('manage-city/manageStates', { country_id: $scope.country_id }).then(function(response) {
            $scope.statesRow = response.records;
        });
    };
    $scope.manageCountry = function() {
        Data.get('manage-city/manageCountry').then(function(response) {
            $scope.countryRow = response.records;
        });
    };

    $scope.initialModal = function(id, list, index, index1, del) {
        console.log('id=' + id + 'list=' + list + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.country_id = list.country_id;
        $scope.id = id;
        $scope.name = list.name;
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
            $scope.manageStates(1, $scope.country_id);
        } else {
            $scope.heading = 'Edit Vertical';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
            $scope.manageStates(1, $scope.country_id);
        }
        $scope.state_id = list.state_id;
        $scope.states = list.state_id;
        $scope.index = index * ($scope.noOfRows - 1) + (index1 + 1);
    }

    //dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'State') {
            if ($scope.OrderRec == 'state_name') {
                $scope.OrderRec = '-state_name';
            } else if ($scope.OrderRec == '-state_name') {
                $scope.OrderRec = 'state_name';
            } else if ($scope.OrderRec == 'name') {
                $scope.OrderRec = 'state_name';
            } else if ($scope.OrderRec == '-name') {
                $scope.OrderRec = 'state_name';
            }
        } else if (sort == 'City') {
            if ($scope.OrderRec == 'name') {
                $scope.OrderRec = '-name';
            } else if ($scope.OrderRec == '-name') {
                $scope.OrderRec = 'name';
            } else if ($scope.OrderRec == 'state_name') {
                $scope.OrderRec = 'name';
            } else if ($scope.OrderRec == '-state_name') {
                $scope.OrderRec = 'name';
            }
        }

    }

    $scope.doCitiesAction = function() {
        $scope.errorMsg = '';
        if ($scope.id == 0) //for create
        {
            if ($scope.domethod == 'post') {
                Data.post('manage-city/', {
                    'name': $scope.name,
                    'state_id': $scope.state_id
                }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.citiesRow.push({ 'name': $scope.name, 'state_id': $scope.state_id, 'country_id': $scope.country_id, id: response.lastinsertid, 'country_name': response.country_name, 'state_name': response.state_name });
                        $('#cityModal').modal('toggle');
                        toaster.pop('success', 'Manage city ', 'Record successfully created');
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update

            if ($scope.domethod == 'put') {
                Data.put('manage-city/' + $scope.id, {
                    name: $scope.name,
                    id: $scope.id,
                    state_id: $scope.state_id
                }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        Data.get('manage-city/manageCity').then(function(response) {
                            $scope.a = JSON.parse(JSON.stringify(response));
                            $scope.citiesRow = $scope.a.records;

                            $('#cityModal').modal('toggle');
                            toaster.pop('success', 'Manage city ', 'Record successfully updated');
                        });
                        //$scope.citiesRow.splice($scope.index - 1, 1);
                        //$scope.citiesRow.splice($scope.index - 1, 0, { name: $scope.name, id: $scope.id, country_id: $scope.country_id, state_id: $scope.state_id, state_name: response.state_name});                       
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('manage-city/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        Data.get('manage-city/manageCity').then(function(response) {
                            $scope.a = JSON.parse(JSON.stringify(response));
                            $scope.citiesRow = $scope.a.records;
                            $('#cityModalD').modal('toggle');
                            toaster.pop('success', 'Manage city ', 'Record Deleted successfully');
                        });
                        //$scope.citiesRow.splice($scope.index - 1, 1);
                        //$scope.citiesRow.splice($scope.index - 1, 0, { name: $scope.name, id: $scope.id, country_id: $scope.country_id, state_id: $scope.state_id, state_name: response.state_name});                       
                    }
                });
            }
        }
    }

    //vivek delete
    $scope.Cancel = function() {
        $('#cityModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        $scope.getexcel = window.location = "/manage-city/exportToxls";
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
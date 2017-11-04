app.controller('manageProfessionCtrl', ['$scope', '$state', '$stateParams', 'Data', 'toaster', '$rootScope', '$timeout', '$location', function($scope, $state, $stateParams, Data, toaster, $rootScope, $timeout, $location) {
    //for OrderFunction
    $scope.OrderRec = 'profession';
    $scope.adnBtn = "Add New Profession";

    $scope.noOfRows = 1;
    $scope.itemsPerPage = 30;
    $scope.profBtn = false;
    $scope.manageProfession = function() {
        $scope.showloader();
        Data.post('manage-profession/manageProfession').then(function(response) {
            $scope.professionRow = response.records;
            $scope.professionRowCount = response.totalCount;
            $scope.hideloader();
        });
    };

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

    $scope.initialModal = function(id, profession, status, index, index1, del) {
        // console.log('id=' + id + 'profession=' + profession + 'status=' + status + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add Profession';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Profession';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Profession';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.profession = profession;
        $scope.status = status;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    }

    //dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'Profession') {
            if ($scope.OrderRec == 'profession') {
                $scope.OrderRec = '-profession';
            } else if ($scope.OrderRec == '-profession') {
                $scope.OrderRec = 'profession';
            } else if ($scope.OrderRec == 'status') {
                $scope.OrderRec = 'profession';
            } else if ($scope.OrderRec == '-status') {
                $scope.OrderRec = 'profession';
            }
        } else if (sort == 'Status') {
            if ($scope.OrderRec == 'status') {
                $scope.OrderRec = '-status';
            } else if ($scope.OrderRec == '-status') {
                $scope.OrderRec = 'status';
            } else if ($scope.OrderRec == 'profession') {
                $scope.OrderRec = 'status';
            } else if ($scope.OrderRec == '-profession') {
                $scope.OrderRec = 'status';
            }
        }
    }

    $scope.doprofessionAction = function() {
        $scope.errorMsg = '';
        $scope.profBtn = true;
        if ($scope.id == 0) //for create
        {
            $scope.profBtn = false;
            if ($scope.domethod == 'post') {
                Data.post('manage-profession/', {
                    profession: $scope.profession,
                    'status': $scope.status
                }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.professionRow.push({ 'profession': $scope.profession, 'status': $scope.status, 'id': response.lastinsertid });
                        toaster.pop('success', 'Manage Profession', "record created successfully");
                        $scope.professionRowCount = $scope.professionRowCount + 1;
                        $('#professionModal').modal('toggle');
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update
            $scope.profBtn = false;
            if ($scope.domethod == 'put') {
                Data.put('manage-profession/' + $scope.id, {
                    profession: $scope.profession,
                    'status': $scope.status,
                    id: $scope.id
                }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.professionRow.splice($scope.index, 1);
                        $scope.professionRow.splice($scope.index, 0, {
                            profession: $scope.profession,
                            'status': $scope.status,
                            id: $scope.id
                        });
                        toaster.pop('success', 'Manage Profession', "record updated successfully");
                        $('#professionModal').modal('toggle');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('manage-profession/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        // $scope.professionRow.splice($scope.index, 1);
                        // $scope.professionRow.splice($scope.index, 0, { profession: $scope.profession, 'status': $scope.status, id: $scope.id});
                        $scope.professionRow = response.records;
                        $scope.professionRowCount = $scope.professionRowCount - 1;
                        $('#professionModal').modal('toggle');
                        toaster.pop('success', 'Manage Profession', "record deleted successfully");
                    }
                });
            }
        }
    }

    //vivek nk delete
    $scope.Cancel = function() {
        $('#professionModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        if (window.location = "/manage-profession/exportToxls") {
            toaster.pop('info', '', 'Exporting....');
        } else {
            toaster.pop('error', '', 'Exporting fails....');
        }
    };

    $scope.pageChangeHandler = function(num) {
        $scope.noOfRows = num;
        $scope.currentPage = num * $scope.itemsPerPage;
    };

    //viveknk call to dashboard
    $scope.goDashboard = function() {
        $state.go('dashboard');
    };

}]);
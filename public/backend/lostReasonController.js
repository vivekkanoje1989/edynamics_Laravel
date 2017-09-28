app.controller('lostReasonsController', ['$scope', 'Data', 'toaster', function($scope, Data, toaster) {
    //for OrderFunction
    $scope.OrderRec = 'reason';
    $scope.adnBtn = "Add New Lost Reason";

    $scope.heading = 'Create Lost Reason';
    $scope.noOfRows = 1;
    $scope.itemsPerPage = 30;
    $scope.manageLostReasons = function() {
        $scope.modal = {};
        Data.post('lost-reasons/manageLostReason').then(function(response) {
            $scope.LostReasonsRow = response.records;
            $scope.LostReasonsRowCount = response.totalCount;
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

    $scope.initialModal = function(id, reason, status, index, index1, del) {
        console.log('id=' + id + 'reason=' + reason + 'status=' + status + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add Lost Reason';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Lost Reason';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Lost Reason';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.reason = reason;
        $scope.lost_reason_status = status;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    };

    //dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'Reason') {
            if ($scope.OrderRec == 'reason') {
                $scope.OrderRec = '-reason';
            } else if ($scope.OrderRec == '-reason') {
                $scope.OrderRec = 'reason';
            } else if ($scope.OrderRec == 'lost_reason_status') {
                $scope.OrderRec = 'reason';
            } else if ($scope.OrderRec == '-lost_reason_status') {
                $scope.OrderRec = 'reason';
            }
        } else if (sort == 'Status') {
            if ($scope.OrderRec == 'lost_reason_status') {
                $scope.OrderRec = '-lost_reason_status';
            } else if ($scope.OrderRec == '-lost_reason_status') {
                $scope.OrderRec = 'lost_reason_status';
            } else if ($scope.OrderRec == '-reason') {
                $scope.OrderRec = 'lost_reason_status';
            } else if ($scope.OrderRec == 'reason') {
                $scope.OrderRec = 'lost_reason_status';
            }
        }
    }

    $scope.doLostReasonsAction = function() {
        if ($scope.id == 0) {
            if ($scope.domethod == 'post') {
                Data.post('lost-reasons/', {
                    reason: $scope.reason,
                    lost_reason_status: $scope.lost_reason_status
                }).then(function(response) {
                    if (response.success) {
                        toaster.pop('success', 'Manage lost reason', "record updated successfully");
                        $scope.LostReasonsRow.push({ 'id': response.lastinsertid, 'reason': $scope.reason, lost_reason_status: $scope.lost_reason_status });
                        $scope.LostReasonsRowCount = response.totalCount;
                        $('#lostReasonModal').modal('toggle');
                    } else {
                        $scope.errorMsg = response.errormsg;
                    }
                });
            } else { console.log("domethod"); }
        } else { //update
            if ($scope.domethod == 'put') {
                Data.put('lost-reasons/' + $scope.id, {
                    reason: $scope.reason,
                    lost_reason_status: $scope.lost_reason_status,
                    id: $scope.id
                }).then(function(response) {
                    // console.log(response)
                    if (response.success) {
                        toaster.pop('success', 'Manage lost reason', "record updated successfully");
                        $('#lostReasonModal').modal('toggle');
                        $scope.LostReasonsRowCount = response.totalCount;
                        $scope.LostReasonsRow.splice($scope.index, 1);
                        $scope.LostReasonsRow.splice($scope.index, 0, {
                            reason: $scope.reason,
                            lost_reason_status: $scope.lost_reason_status,
                            id: $scope.id
                        });
                    } else {
                        $scope.errorMsg = response.errormsg;
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('lost-reasons/' + $scope.id).then(function(response) {
                    // console.log(response)
                    if (response.success) {
                        // $scope.listLostReasons.splice($scope.index, 1);
                        // $scope.listLostReasons.splice($scope.index, 0, {reason: $scope.reason, lost_reason_status: $scope.lost_reason_status, id: $scope.id});
                        $scope.LostReasonsRow = response.records;
                        $scope.LostReasonsRowCount = response.totalCount;
                        toaster.pop('success', 'Manage lost reason', "record deleted successfully");
                        $('#lostReasonModal').modal('toggle');
                    } else {
                        $scope.errorMsg = response.errormsg;
                    }
                });
            }
        }
    }

    //vivek nk delete
    $scope.Cancel = function() {
        $('#lostReasonModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {
        if (window.location = "/lost-reasons/exportToxls") {
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
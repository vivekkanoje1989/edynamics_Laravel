app.controller('highestEducationCtrl', ['$scope', 'Data', 'toaster', function($scope, Data, toaster) {
    //for OrderFunction
    $scope.OrderRec = 'education';
    $scope.adnBtn = "Add New Highest Education";
    $scope.itemsPerPage = 30;
    $scope.eduBtn = false;
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

    $scope.manageHighestEducation = function() {
        Data.post('highest-education/manageHighestEducation').then(function(response) {
            $scope.educationRow = response.records;
            $scope.educationRowCount = response.totalCount;
        });
    };

    $scope.initialModal = function(id, education, status, index, index1, del) {
        console.log('id=' + id + 'education=' + education + 'status' + status + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add Highest Education';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Highest Education';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Highest Education';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.status = status;
        $scope.education = education;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
        $scope.sbtBtn = false;
    }

    //dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'Education') {
            if ($scope.OrderRec == 'education') {
                $scope.OrderRec = '-education';
            } else if ($scope.OrderRec == '-education') {
                $scope.OrderRec = 'education';
            } else if ($scope.OrderRec == 'status') {
                $scope.OrderRec = 'education';
            } else if ($scope.OrderRec == '-status') {
                $scope.OrderRec = 'education';
            }
        } else if (sort == 'Status') {
            if ($scope.OrderRec == 'status') {
                $scope.OrderRec = '-status';
            } else if ($scope.OrderRec == '-status') {
                $scope.OrderRec = 'status';
            } else if ($scope.OrderRec == 'education') {
                $scope.OrderRec = 'status';
            } else if ($scope.OrderRec == '-education') {
                $scope.OrderRec = 'status';
            }
        }
    }

    $scope.doHighestEducationAction = function() {
        $scope.errorMsg = '';
        $scope.eduBtn = true;
        if ($scope.id == '0') //for create
        {
            $scope.eduBtn = false;
            if ($scope.domethod == 'post') {
                Data.post('highest-education/', { education: $scope.education, 'status': $scope.status, }).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.educationRow.push({ 'education': $scope.education, 'status': $scope.status, 'id': response.lastinsertid });
                        $('#highesteducModal').modal('toggle');
                        // $scope.success("Education details Created successfully"); 
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update
            $scope.eduBtn = false;
            if ($scope.domethod == 'put') {
                Data.put('highest-education/' + $scope.id, {
                    education: $scope.education,
                    'status': $scope.status
                }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.educationRow.splice($scope.index, 1);
                        $scope.educationRow.splice($scope.index, 0, { education: $scope.education, 'status': $scope.status, id: $scope.id });
                        $('#highesteducModal').modal('toggle');
                        toaster.pop('success', 'Manage Country', 'Record Updated Successfully');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('highest-education/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.educationRow = response.record;
                        $('#highesteducModalD').modal('toggle');
                        toaster.pop('success', 'Manage Country', 'Record deleted Successfully');
                    }
                });
            }
        }
    }

    //viveknk delete
    $scope.Cancel = function() {
        $('#highesteducModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        // $scope.getexcel = window.location = "/highest-education/exportToxls";
        if (window.location = "/highest-education/exportToxls") {
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
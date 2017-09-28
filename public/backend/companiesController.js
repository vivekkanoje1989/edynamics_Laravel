app.controller('companiesController', ['$scope', 'Data', 'toaster', '$rootScope', '$timeout', '$location', function($scope, Data, toaster, $rootScope, $timeout, $location) {
    //for OrderFunction
    // $scope.OrderRec = 'company_name';
    // $scope.adnBtn = "Add New company";

    // $scope.itemsPerPage = 30;
    // $scope.pageNumber = 1;
    // $scope.noOfRows = 1;
    // $scope.errorMsg = '';

    // $scope.pageChanged = function(pageNo, functionName, id) {
    //     $scope[functionName](id, pageNo, $scope.itemsPerPage);
    //     $scope.pageNumber = pageNo;
    // };

    // $scope.manageGender = function(empId, pageNumber, itemPerPage) {
    //     $scope.showloader();
    //     Data.get('/manageGender/getGender').then(function(response) {
    //         $scope.hideloader();
    //         $scope.genderRow = response.records;
    //         $scope.genderRowLength = response.totalCount;
    //     });
    // };


    // $scope.getProcName = $scope.type = '';
    // $scope.procName = function(procedureName, isTeam) {
    //     $scope.getProcName = angular.copy(procedureName);
    //     $scope.type = angular.copy(isTeam);
    // }


    // $scope.searchDetails = {};
    // $scope.searchData = {};

    // $scope.filterDetails = function(search) {
    //     //$scope.searchDetails = {};
    //     $scope.searchData = search;
    //     $('#showFilterModal').modal('hide');
    // }
    // $scope.removeFilterData = function(keyvalue) {
    //     delete $scope.searchData[keyvalue];
    //     $scope.filterDetails($scope.searchData);
    // }
    // $scope.closeModal = function() {
    //     $scope.searchData = {};
    // }

    // $scope.initialModal = function(id, gender, status, index, index1, del) {
    //     console.log('id=' + id + 'gender=' + gender + 'status=' + status + 'index=' + index + 'index1=' + index1 + 'del' + del);
    //     $scope.sbtBtn = false;
    //     if (id == 0) {
    //         $scope.heading = 'Add gender';
    //         $scope.action = "Submit";
    //         $scope.cancl = false;
    //         $scope.domethod = 'post';
    //     } else if (del == "del") {
    //         $scope.heading = 'Delete gender';
    //         $scope.action = "Confirm";
    //         $scope.cancl = true;
    //         $scope.domethod = 'delete';
    //     } else {
    //         $scope.heading = 'Edit gender';
    //         $scope.action = "Update";
    //         $scope.cancl = true;
    //         $scope.domethod = 'put';
    //     }
    //     $scope.id = id;
    //     $scope.gender = gender;
    //     $scope.status = status;
    //     $scope.index = index * ($scope.noOfRows - 1) + (index1);
    //     $scope.index1 = index1;
    // }

    // //dynamic orderby function
    // $scope.OrderFunction = function(sort) {
    //     if (sort == 'Gender') {
    //         if ($scope.OrderRec == 'gender') {
    //             $scope.OrderRec = '-gender';
    //         } else if ($scope.OrderRec == '-gender') {
    //             $scope.OrderRec = 'gender';
    //         } else if ($scope.OrderRec == 'status') {
    //             $scope.OrderRec = 'gender';
    //         } else if ($scope.OrderRec == '-status') {
    //             $scope.OrderRec = 'gender';
    //         }
    //     } else if (sort == 'Status') {
    //         if ($scope.OrderRec == 'status') {
    //             $scope.OrderRec = '-status';
    //         } else if ($scope.OrderRec == '-status') {
    //             $scope.OrderRec = 'status';
    //         } else if ($scope.OrderRec == 'gender') {
    //             $scope.OrderRec = 'status';
    //         } else if ($scope.OrderRec == '-gender') {
    //             $scope.OrderRec = 'status';
    //         }
    //     }
    // }

    // $scope.doGenderAction = function() {
    //     $scope.errorMsg = '';
    //     if ($scope.id == 0) //for store
    //     {
    //         //$scope.sbtBtn = false;
    //         if ($scope.domethod == 'post') {
    //             Data.post('/manageGender', { gender: $scope.gender, status: $scope.status }).then(function(response) {
    //                 if (!response.success) {
    //                     $scope.errorMsg = response.errormsg;
    //                 } else {
    //                     // $scope.clientRoleRow = response.records;
    //                     $scope.genderRowLength = response.totalCount;
    //                     $scope.last_insertedId = response.last_insertedId
    //                         // $scope.flagForChange = 0;
    //                     $scope.genderRow.push({ 'id': $scope.last_insertedId, 'gender': $scope.gender, 'status': $scope.status });

    //                     $('#genderModal').modal('toggle');
    //                     toaster.pop('success', 'Manage Gender ', 'Record Added successfully');
    //                 }
    //             });
    //         } else { console.log("domethod"); }
    //     } else { //for update

    //         if ($scope.domethod == 'put') {
    //             Data.put('/manageGender/' + $scope.id, { gender: $scope.gender, status: $scope.status, id: $scope.id }).then(function(response) {
    //                 if (!response.success) {
    //                     $scope.errorMsg = response.errormsg;
    //                 } else {
    //                     $scope.genderRow = response.records;
    //                     $scope.genderRowLength = response.totalCount;
    //                     // $scope.flagForChange = 0;
    //                     // console.log("clientRoleRow bfr" + JSON.stringify($scope.clientRoleRow));
    //                     // $scope.clientRoleRow.splice($scope.index1 - 1, 1);
    //                     // $scope.clientRoleRow.splice($scope.index1, 1, { id: $scope.id, role_name: $scope.role_name, status: $scope.status });
    //                     // console.log("clientRoleRow aftr" + JSON.stringify($scope.clientRoleRow));

    //                     // $scope.clientRoleRow.push({ id: $scope.id, role_name: $scope.role_name, status: $scope.status });
    //                     $('#genderModal').modal('toggle');
    //                     toaster.pop('success', 'Manage Gender ', 'Record successfully updated');
    //                 }
    //             });
    //         } else if ($scope.domethod == 'delete') { //for delete

    //             Data.delete('/manageGender/' + $scope.id).then(function(response) {

    //                 if (!response.success) {
    //                     $scope.errorMsg = response.errormsg;
    //                 } else {
    //                     $scope.genderRow = response.records;
    //                     $scope.genderRowLength = response.totalCount;
    //                     // $scope.clientRoleRow.splice($scope.index1 - 1, 1);
    //                     // $scope.flagForChange = 0;
    //                     $('#genderModal').modal('toggle');
    //                     toaster.pop('success', 'Manage Gender ', 'Record Deleted successfully');
    //                 }
    //             });
    //         }
    //     }
    // }

    // //vivek Delete
    // $scope.Cancel = function() {
    //     $('#genderModal').modal('toggle');
    // };

    // //vivek Export to xlsx
    // $scope.ExportToxls = function() {
    //     if (window.location = "/manageGender/exportToxls") {
    //         toaster.pop('info', '', 'Exporting....');
    //     } else {
    //         toaster.pop('error', '', 'Exporting fails....');
    //     }
    // };

    // //paginator
    // $scope.pageChangeHandler = function(num) {
    //     $scope.noOfRows = parseInt(num);
    //     $scope.itemsPerPage = parseInt($scope.itemsPerPage);
    //     $scope.currentPage = num * $scope.itemsPerPage;
    // };
}]);
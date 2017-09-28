app.controller('employeeDocumentsCtrl', ['$scope', 'Data', '$rootScope', '$timeout', 'toaster', function($scope, Data, $rootScope, $timeout, toaster) {
    //for OrderFunction
    $scope.OrderRec = 'document_name';
    $scope.adnBtn = "Add New Document";
    $scope.vloader = false;
    $scope.hidethis = false;
    $scope.document_name = '';

    //viveknk for itemperpage model dropdown
    $scope.itemsPerPageModel = [30, 100, 200, 300, 400, 500, 600, 700, 800, 900, 999];

    //set default itemsPerPage
    $scope.itemsPerPage = 30

    $scope.pageNumber = 1;
    $scope.noOfRows = 1;

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

    $scope.initialModal = function(id, document_name, index, index1, del) {
        console.log('id=' + id + 'document_name=' + document_name + 'index=' + index + 'index1=' + index1 + 'del=' + del);
        $scope.sbtBtn = false;
        $scope.Add = false;
        $scope.Edit = false;
        $scope.delete = false;
        $scope.id = '';
        $scope.document_name = '';

        if (id == 0) {
            $scope.heading = 'Add Document';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.Add = true;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Document';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
            $scope.delete = true;
        } else {
            $scope.heading = 'Edit Document';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.Edit = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.document_name = document_name;

        $scope.index = index * ($scope.noOfRows - 1) + (index1);
        $scope.index1 = parseInt(index1);
    }

    //watch model if not empty and such disable submit button
    $scope.$watch('document_name', function() {
        if ($scope.document_name.length <= 0) {
            $scope.clntrlBtn = true;
        } else {
            $scope.clntrlBtn = false;
        }
    });

    //dynamic orderby function
    $scope.OrderFunction = function() {
        if ($scope.OrderRec == 'document_name') {
            $scope.OrderRec = '-document_name';
        } else if ($scope.OrderRec == '-document_name') {
            $scope.OrderRec = 'document_name';
        }
    }


    $scope.manageEmployeeDocuments = function() {
        Data.get('employee-document/employeeDocuments').then(function(response) {
            $scope.DocumentsRow = response.records;
        });
    };

    $scope.doDocumentsAction = function() {
        if ($scope.id == 0) {
            $scope.sbtBtn = false;
            if ($scope.domethod == 'post') {
                Data.post('employee-document', { 'document_name': $scope.document_name }).then(function(response) {

                    if (response.success) {
                        $scope.DocumentsRow.push({ 'document_name': response.result.document_name, 'id': response.lastinsertid });
                        $("#documentModal").modal("toggle");
                        toaster.pop('success', 'Manage Documents', 'Record Added successfully');
                    } else {
                        $scope.errorMsg = response.errorMsg;
                        toaster.pop('error', 'Manage Documents', 'Record can not be added.');
                    }
                });
            } else { console.log("domethod"); }
        } else {
            $scope.sbtBtn = false;
            if ($scope.domethod == 'put') {
                Data.put('employee-document/' + $scope.id, { 'document_name': $scope.document_name }).then(function(response) {
                    if (response.success) {
                        $scope.DocumentsRow.splice($scope.index, 1);
                        $scope.DocumentsRow.splice($scope.index, 0, { 'document_name': response.result.document_name, 'id': $scope.id })
                        $("#documentModal").modal("toggle");
                        toaster.pop('success', 'Manage Documents', 'Record Updated Successfully');
                    } else {
                        $scope.errorMsg = response.errorMsg;
                        toaster.pop('error', 'Manage Documents', $scope.errorMsg);
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('/employee-document/' + $scope.id).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                        $('#documentModal').modal('toggle');
                        toaster.pop('error', 'Manage Documents', $scope.errorMsg);
                    } else {
                        $scope.DocumentsRow = response.records;
                        // $scope.clientRoleRow.splice($scope.index1 - 1, 1);
                        // $scope.flagForChange = 0;
                        $('#documentModal').modal('toggle');
                        toaster.pop('success', 'Manage Documents', 'Record Deleted Successfully');
                    }
                });
            }
        }
    }


    //vivek Delete
    $scope.Cancel = function() {
        $('#documentModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {
        if (window.location = "/employee-document/exportToxls") {
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

function newFunction() {
    return 'document_name';
}
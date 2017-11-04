app.controller('projecttypesController', ['$scope', '$state', '$stateParams', 'Data', 'toaster', '$rootScope', '$timeout', '$location', function($scope, $state, $stateParams, Data, toaster, $rootScope, $timeout, $location) {
    //for OrderFunction
    $scope.OrderRec = 'project_type';
    $scope.adnBtn = "Add New Project Type";

    $scope.noOfRows = 1;
    $scope.itemsPerPage = 30;
    $scope.proTypeBtn = false;

    $scope.manageProjectTypes = function() {
        $scope.showloader();
        Data.post('project-types/manageProjectTypes').then(function(response) {
            $scope.ProjectTypesRow = response.records;
            $scope.ProjectTypesRowLength = response.totalCount;
            $scope.hideloader();
        });
    };

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

    $scope.initialModal = function(id, project_type, index, index1, del) {
        console.log('id=' + id + 'project_type=' + project_type + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add Project Types';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Project Types';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Project Types';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.project_type = project_type;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
        $scope.index1 = index1;
    }

    //dynamic orderby function
    $scope.OrderFunction = function() {
        if ($scope.OrderRec == 'project_type') {
            $scope.OrderRec = '-project_type';
        } else if ($scope.OrderRec == '-project_type') {
            $scope.OrderRec = 'project_type';
        }
    }

    $scope.doProjectTypesAction = function() {
        $scope.proTypeBtn = true;
        $scope.errorMsg = '';
        if ($scope.id == 0) //for create
        {
            $scope.proTypeBtn = false;
            if ($scope.domethod == 'post') {
                Data.post('project-types/', {
                    project_type: $scope.project_type
                }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        $('#projecttypesModal').modal('toggle');
                        $scope.ProjectTypesRowLength = response.totalCount;
                        $scope.ProjectTypesRow.push({ 'project_type': $scope.project_type, 'id': response.lastinsertid });
                        toaster.pop('success', 'Project types', 'Record successfully created');
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update
            $scope.proTypeBtn = false;
            if ($scope.domethod == 'put') {
                Data.put('project-types/' + $scope.id, {
                    project_type: $scope.project_type,
                    id: $scope.id
                }).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.ProjectTypesRowLength = response.totalCount;
                        // $scope.ProjectTypesRow.splice($scope.index1, 1);
                        console.log("ProjectTypesRow bfr" + JSON.stringify($scope.ProjectTypesRow));
                        $scope.ProjectTypesRow.splice($scope.index1 - 1, 1, { project_type: $scope.project_type, id: $scope.id });
                        console.log("ProjectTypesRow aftr" + JSON.stringify($scope.ProjectTypesRow));

                        $('#projecttypesModal').modal('toggle');
                        toaster.pop('success', 'Project types', 'Record successfully updated');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('project-types/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.ProjectTypesRow = response.records;
                        $scope.ProjectTypesRowLength = response.totalCount;
                        $('#projecttypesModal').modal('toggle');
                        toaster.pop('success', 'Project types', 'Record successfully deleted');
                    }
                });
            }
        }
    }

    //vivek nk delete
    $scope.Cancel = function() {
        $('#projecttypesModal').modal('toggle');
    }

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        if (window.location = "/project-types/exportToxls") {
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
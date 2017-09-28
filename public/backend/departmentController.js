app.controller('manageDepartmentCtrl', ['$scope', 'Data', '$rootScope', '$timeout', 'toaster', '$location', function($scope, Data, $rootScope, $timeout, toaster, $location) {
    //for OrderFunction
    $scope.OrderRec = 'department_name';
    $scope.adnBtn = "Add New Department";

    $scope.departmentData = {};
    $scope.itemsPerPage = 30;
    $scope.noOfRows = 1;
    $scope.deptBtn = false;

    $scope.manageDepartment = function() {
        Data.post('manage-department/manageDepartment').then(function(response) {
            $scope.departmentRow = response.records;
            $scope.departmentRowCount = response.totalCount;
            // console.log("departmentRow==>"+ JSON.stringify($scope.departmentRow));
        });
    };

    $scope.initialModal = function(id, list, index, index1, del) {
        // console.log('id=' + id + 'list=' + list + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add Departments';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Departments';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
            $scope.departmentData.department_name = list.department_name;
            $scope.departmentData.vertical_id = list.vertical.id;
        } else {
            $scope.heading = 'Edit Departments';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
            $scope.departmentData.department_name = list.department_name;
            $scope.departmentData.vertical_id = list.vertical.id;
        }
        $scope.id = id;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    }

    //dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'Department') {
            if ($scope.OrderRec == 'department_name') {
                $scope.OrderRec = '-department_name';
            } else if ($scope.OrderRec == '-department_name') {
                $scope.OrderRec = 'department_name';
            } else if ($scope.OrderRec == '-verticalData') {
                $scope.OrderRec = 'department_name';
            } else if ($scope.OrderRec == 'verticalData') {
                $scope.OrderRec = 'department_name';
            }
        } else if (sort == 'Vertical') {
            if ($scope.OrderRec == 'verticalData') {
                $scope.OrderRec = '-verticalData';
            } else if ($scope.OrderRec == '-verticalData') {
                $scope.OrderRec = 'verticalData';
            } else if ($scope.OrderRec == 'department_name') {
                $scope.OrderRec = 'verticalData';
            } else if ($scope.OrderRec == '-department_name') {
                $scope.OrderRec = 'verticalData';
            }
        }
    }

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

    $scope.doDepartmentAction = function(deptData) {
        $scope.errorMsg = '';
        $scope.deptBtn = true;

        if ($scope.id === 0) //for create
        {
            $scope.deptBtn = false;
            if ($scope.domethod == 'post') {
                Data.post('manage-department/', { department_name: deptData.department_name, vertical_id: deptData.vertical_id, }).then(function(response) {
                    // console.log("response store==>"+ JSON.stringify(response));

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                        toaster.pop('error', 'Manage department', 'Something Went Wrong!!');
                    } else {
                        $scope.departmentRow.push({ 'department_name': deptData.department_name, 'vertical_id': deptData.vertical_id, 'verticalData': response.verticalData, 'id': response.lastinsertid, 'vertical': { 'id': deptData.vertical_id, 'name': response.verticalData } });
                        $('#departmentModal').modal('toggle');
                        toaster.pop('success', 'Manage department', 'Record added successfully');
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update
            $scope.deptBtn = false;
            if ($scope.domethod == 'put') {
                Data.put('manage-department/' + $scope.id, {
                    department_name: deptData.department_name,
                    vertical_id: deptData.vertical_id,
                    id: $scope.id
                }).then(function(response) {
                    // console.log("response update==>"+ JSON.stringify(response));
                    if (!response.success) {
                        toaster.pop('error', 'Manage department', 'Something Went Wrong!!');
                        $scope.errorMsg = response.errormsg;
                    } else {
                        $scope.vertical = { 'id': deptData.vertical_id, 'name': response.vertical.name, };
                        $scope.departmentRow.splice($scope.index, 1);
                        $scope.departmentRow.splice($scope.index, 0, { department_name: deptData.department_name, vertical: $scope.vertical, 'verticalData': $scope.vertical.name, id: $scope.id });
                        $('#departmentModal').modal('toggle');
                        toaster.pop('success', 'Manage department', 'Record updated successfully');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('manage-department/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        toaster.pop('error', 'Manage department', 'Record cannot be deleted');
                        $scope.errorMsg = response.errormsg;
                    } else {

                        Data.post('manage-department/manageDepartment').then(function(response) {
                            $scope.departmentRow = response.records;
                            // console.log("departmentRow delete==>"+ JSON.stringify($scope.departmentRow));                            
                            $('#departmentModal').modal('toggle');
                            toaster.pop('success', 'Manage department', 'Record Deleted successfully');
                        });
                    }
                });
            }
        }
    }

    //vivek delete
    $scope.Cancel = function() {
        $('#departmentModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        if (window.location = "/manage-department/exportToxls") {
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
app.controller('emailconfigCtrl', ['$scope', 'Data', '$rootScope', '$timeout', 'toaster', '$state', function($scope, Data, $rootScope, $timeout, toaster, $state) {
    //for OrderFunction
    $scope.OrderRec = 'email';
    $scope.adnBtn = "Add New Email Account";
    $scope.vloader = false;
    $scope.hidethis = false;

    //viveknk for itemperpage model dropdown
    $scope.itemsPerPageModel = [30, 100, 200, 300, 400, 500, 600, 700, 800, 900, 999];

    //set default itemsPerPage
    $scope.itemsPerPage = 30

    $scope.pageNumber = 1;
    $scope.noOfRows = 1;
    // $scope.listDepartmentOnCreate = [];
    $scope.listDepartment = [];
    // $scope.pageHeading = "Create Email Account";
    $scope.emailData = {};


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

    $scope.initialModal = function(id, email, password, deptName, projectId, status, index, index1, del) {
        console.log('id=' + id + 'email=' + email + 'password=' + password + 'deptName=' + deptName + 'projectId=' + projectId + 'status=' + status + 'index=' + index + 'index1=' + index1 + 'del=' + del);
        $scope.sbtBtn = false;
        $scope.Add = false;
        $scope.Edit = false;
        $scope.delete = false;
        $scope.id = '';
        $scope.emailData.email = '';
        $scope.emailData.password = '';
        $scope.emailData.status = '';
        $scope.emailData.department_id = '';
        $scope.emailData.project_id = '';
        $scope.prj_id = '';
        // $scope.clntrlBtn = true;        

        if (id == 0) {
            $scope.heading = 'Add Email Account';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.Add = true;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Email Account';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
            $scope.delete = true;
        } else {
            $scope.heading = 'Edit Email Account';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.Edit = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.emailData.email = email;
        $scope.emailData.password = password;
        $scope.emailData.status = status;
        $scope.emailData.project_id = projectId;
        $scope.prj_id = parseInt(projectId);

        $scope.index = index * ($scope.noOfRows - 1) + (index1);
        $scope.index1 = parseInt(index1);

        Data.post('email-config/getdeptsel', { deptName }).then(function(response) {
            if (response) {
                $scope.emailData.department_id = response;
            }
        });

        $scope.listDepartment = [];
        Data.get('email-config/getDepartments').then(function(response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.listDepartment = response.records;
            }
        });

        if ($scope.emailData.department_id.length === 0) {
            $scope.clntrlBtn = true;
            $scope.applyClassDepartment = 'ng-active';
        } else {
            $scope.applyClassDepartment = 'ng-inactive';
            $scope.clntrlBtn = false;
        }
    }

    $scope.checkDepartment = function() {

        if ($scope.Edit || $scope.delete) {
            $scope.emptyDepartmentId = false;
            $scope.applyClassDepartment = 'ng-inactive';
            $scope.clntrlBtn = false;
            $scope.hidethis = false;
        } else {

            if ($scope.emailData.department_id.length === 0) {
                $scope.emptyDepartmentId = true;
                $scope.clntrlBtn = true;
                $scope.hidethis = true;
                $scope.applyClassDepartment = 'ng-active';
            } else {
                $scope.emptyDepartmentId = false;
                $scope.applyClassDepartment = 'ng-inactive';
                $scope.clntrlBtn = false;
                $scope.hidethis = false;
            }

        }
    };

    // $scope.deptSelect = function(deptName) {
    //     Data.get('email-config/getdeptsel/', { id: 1 }).then(function(response) {
    //         if (response) {

    //         }
    //     });
    // }

    // $scope.manageEmailConfig = function(id) {
    //     // $scope.pageHeading = "Edit Email Account";
    //     Data.post('email-config/manageEmails', { id: id }).then(function(response) {
    //         if (id === 'index') { // index
    //             $scope.listmails = response.records;
    //             $scope.listmailsLength = response.totalCount;
    //         }
    //         if (id > 0) { // Edit
    //             $scope.emailData = angular.copy(response.records[0]);
    //             $scope.emailData.department_id = response.departments;
    //         }
    //     });
    // }

    $scope.manageEmailConfig = function() {
        Data.post('email-config/manageEmails').then(function(response) {
            $scope.listmails = response.records;
            $scope.listmailsLength = response.totalCount;
        });
    }

    //check mail vnk
    $scope.checkteest = function(username, pass) {
        $scope.hidethis = true;
        $scope.vloader = true; //loader
        toaster.pop('info', '', 'Sending test mail....');
        // alert("checkteest" + username + " pass=" + pass);
        Data.post('/email-config/testEmail', { emaildata: { 'email': username, 'password': pass } }).then(function(response) {
            if (!response.success) {
                toaster.pop('error', 'Email Configuration', response.message);
                $scope.vloader = false; //loader
                $scope.hidethis = false;
            } else {
                toaster.pop('success', 'Email Configuration', response.message);
                $scope.vloader = false; //loader
                $scope.hidethis = false;
            }
        });
    }

    $scope.createEmail = function(emaildata, id) {
        if (id > 0) { // for update
            Data.put('email-config/' + id, { emaildata: emaildata }).then(function(response) {
                if (!response.success) {
                    toaster.pop('error', 'Email Configuration', response.message);
                } else {
                    toaster.pop('success', 'Email Configuration', response.message);
                    $state.go('emailConfigIndex');
                }
            });
        } else { // for create
            Data.post('email-config/', { emaildata: emaildata }).then(function(response) {
                if (!response.success) {
                    toaster.pop('error', 'Email Configuration', response.message);
                } else {
                    toaster.pop('success', 'Email Configuration', response.message);
                    $state.go('emailConfigIndex');
                }
            });
        }
    }

    //dynamic orderby function
    $scope.OrderFunction = function() {
        if ($scope.OrderRec == 'email') {
            $scope.OrderRec = '-email';
        } else if ($scope.OrderRec == '-email') {
            $scope.OrderRec = 'email';
        }
    }

    $scope.doConfEmailAction = function() {
        //loader
        $scope.vloader = true;

        // alert("doConfEmailAction");
        console.log($scope.id);
        console.log($scope.emailData);
        $scope.errorMsg = '';
        if ($scope.id == 0) //for store
        {
            $scope.sbtBtn = false;
            if ($scope.domethod == 'post') {
                Data.post('/email-config', { 'emailData': $scope.emailData }).then(function(response) {
                    if (!response.success) {
                        $scope.vloader = false; //loader
                        $scope.errorMsg = response.errormsg;
                        $('#emailConfigModal').modal('toggle');
                        toaster.pop('error', 'Configure Email Account', $scope.errorMsg);
                    } else {
                        $scope.vloader = false; //loader
                        // console.log("responserecords--->" + response.records);
                        $scope.listmails = response.records;
                        $scope.listmailsLength = response.totalCount;
                        $scope.last_insertedId = response.last_insertedId
                            // $scope.flagForChange = 0;
                            // $scope.listmails.push({ 'id': $scope.last_insertedId, 'role_name': $scope.role_name, 'status': $scope.status });
                        $('#emailConfigModal').modal('toggle');
                        toaster.pop('success', 'Configure Email Account', 'Email Account Added successfully');
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update
            $scope.sbtBtn = false;
            if ($scope.domethod == 'put') {
                console.log("update domethod put" + $scope.domethod);
                console.log("update id" + $scope.id);
                Data.put('/email-config/' + $scope.id, { 'emailData': $scope.emailData }).then(function(response) {
                    if (!response.success) {
                        $scope.vloader = false; //loader
                        $scope.errorMsg = response.errormsg;
                        toaster.pop('success', 'Configure Email Account', $scope.errorMsg);
                    } else {
                        $scope.vloader = false; //loader
                        $scope.listmails = response.records;
                        $scope.listmailsLength = response.totalCount;
                        $scope.last_insertedId = response.last_insertedId
                            // $scope.flagForChange = 0;
                            // console.log("clientRoleRow bfr" + JSON.stringify($scope.clientRoleRow));
                            // $scope.clientRoleRow.splice($scope.index1 - 1, 1);
                            // $scope.clientRoleRow.splice($scope.index1, 1, { id: $scope.id, role_name: $scope.role_name, status: $scope.status });
                            // console.log("clientRoleRow aftr" + JSON.stringify($scope.clientRoleRow));

                        // $scope.clientRoleRow.push({ id: $scope.id, role_name: $scope.role_name, status: $scope.status });
                        $('#emailConfigModal').modal('toggle');
                        toaster.pop('success', 'Configure Email Account', 'Record successfully updated');
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                // alert("doConfEmailAction delete");
                // return false;
                console.log("delete domethod delete" + $scope.domethod);
                console.log("delete id" + $scope.id);

                Data.delete('/email-config/' + $scope.id).then(function(response) {

                    if (!response.success) {
                        $scope.vloader = false; //loader
                        $scope.errorMsg = response.errormsg;
                        $('#emailConfigModal').modal('toggle');
                        toaster.pop('success', 'Configure Email Account', $scope.errorMsg);
                    } else {
                        $scope.vloader = false; //loader
                        $scope.listmails = response.records;
                        $scope.listmailsLength = response.totalCount;
                        // $scope.clientRoleRow.splice($scope.index1 - 1, 1);
                        // $scope.flagForChange = 0;
                        $('#emailConfigModal').modal('toggle');
                        toaster.pop('success', 'Configure Email Account', 'Record Deleted successfully');
                    }
                });
            }
        }
        $scope.emailData = {}; //this for model value = null
    }

    //vivek Delete
    $scope.Cancel = function() {
        $('#emailConfigModal').modal('toggle');
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {
        if (window.location = "/email-config/exportToxls") {
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

// app.controller('listDepartmentOnUpdateCtrl', function($scope, Data, $timeout) {
//     // alert("listDepartmentOnUpdateCtrl");
//     $scope.listDepartmentOnUpdate = [];
//     Data.get('email-config/getDepartments').then(function(response) {
//         if (!response.success) {
//             $scope.errorMsg = response.message;
//         } else {
//             $scope.listDepartmentOnUpdate = response.records;
//         }
//     });
// });

// app.controller('listDepartmentOnCreateCtrl', function($scope, Data, $timeout) {
//     // alert("listDepartmentOnCreateCtrl");
//     Data.get('email-config/getDepartments').then(function(response) {
//         if (!response.success) {
//             $scope.errorMsg = response.message;
//         } else {
//             $scope.listDepartmentOnCreate = response.records;
//         }
//     });
// });
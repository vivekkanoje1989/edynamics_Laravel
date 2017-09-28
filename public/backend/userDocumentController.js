app.controller('userDocumentController', ['$scope', 'Data', 'Upload', 'toaster', '$timeout', function($scope, Data, Upload, toaster, $timeout) {
    //for OrderFunction
    $scope.OrderRec = 'document_name';

    $scope.action = 'Submit';
    $scope.del = '';
    $scope.id = 0;
    $scope.getEmployees = function() {
        Data.get('getUsers').then(function(response) {
            $scope.employeeRow = response.records;
        });
    };
    $scope.getUserDocumentsLists = function(employee_id) {
        $scope.errorMsgg = '';
        if (typeof employee_id == 'undefined') {
            $scope.showDiv = false;
        } else {
            $scope.showDiv = true;

            Data.post('user-document/userDocumentLists', { 'employee_id': employee_id }).then(function(response) {
                $scope.documentRow = response.result;
                //viveknk for sorting document_name key value added to root element
                angular.forEach($scope.documentRow, function(value, key) {
                    value['document_name'] = value.user_documents.document_name;
                });
            });
        }
    };
    $scope.updateDocument = function(list, index) {
        // console.log("updateDocument" + JSON.stringify(list));
        $scope.action = 'Update';
        $scope.del = 'update';
        $scope.id = list.id;
        $scope.userData.document_number = list.document_number;
        $scope.document_url = list.document_url;
        $scope.userData.document_id = list.user_documents.id;
        $scope.index = index;

        //viveknk submit button tooltip dynamic

        $('#fncbtn').attr('title', 'click here');
        $('#fncbtn').tooltip({ trigger: 'manual' }).tooltip('show');
        $timeout($scope.hidetooltip, 2000);
        // $("#fncbtn").trigger('mouseenter');
    };

    //viveknk submit button tooltip dynamic hide fn
    $scope.hidetooltip = function() {
        $('#fncbtn').removeAttr('title');
        $('#fncbtn').tooltip({ trigger: 'manual' }).tooltip('hide');
    };

    //Viveknk delete button initialize
    $scope.deleteDocument = function(list, index) {
        $scope.action = 'Delete';
        $scope.del = 'delete';
        $scope.id = list.id;
        $scope.userData.document_number = list.document_number;
        $scope.document_url = list.document_url;
        $scope.userData.document_id = list.user_documents.id;
        $scope.index = index;

        //viveknk submit button tooltip dynamic
        $('#fncbtn').attr('title', 'click here');
        $('#fncbtn').tooltip({ trigger: 'manual' }).tooltip('show');
        $timeout($scope.hidetooltip, 2000);
    };

    //Viveknk dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'Document') {
            if ($scope.OrderRec == 'document_name') {
                $scope.OrderRec = '-document_name';
            } else if ($scope.OrderRec == '-document_name') {
                $scope.OrderRec = 'document_name';
            } else {
                $scope.OrderRec = 'document_name';
            }
        } else if (sort == 'Number') {
            if ($scope.OrderRec == 'document_number') {
                $scope.OrderRec = '-document_number';
            } else if ($scope.OrderRec == '-document_number') {
                $scope.OrderRec = 'document_number';
            } else {
                $scope.OrderRec = 'document_number';
            }
        }
    }

    $scope.createUserDocuments = function(documentUrl, userData) {
        // console.log("createUserDocuments " + " documentUrl =" + JSON.stringify(documentUrl) + " userData = " + JSON.stringify(userData) + "id " + $scope.id);
        // return false;
        if (typeof documentUrl === 'undefined') {
            documentUrl = new File([""], "fileNotSelected", { type: "text/jpg", lastModified: new Date() });
        }
        $scope.empId = userData.employee_id;

        if ($scope.id == 0) {
            var url = '/user-document/';
            var datas = {
                'employee_id': userData.employee_id,
                'document_id': userData.document_id,
                'document_number': userData.document_number,
                'documentUrl': { 'documentUrl': documentUrl }
            }
        } else {
            if ($scope.del == 'update') {
                var url = '/user-document/edit';
                var datas = {
                    'id': $scope.id,
                    'employee_id': userData.employee_id,
                    'document_id': userData.document_id,
                    'document_number': userData.document_number,
                    'documentUrl': { 'documentUrl': documentUrl }
                }
            } else if ($scope.del == 'delete') {
                var url = '/user-document/delete';
                var datas = {
                    'id': $scope.id,
                    'employee_id': userData.employee_id,
                    'document_id': userData.document_id,
                    'document_number': userData.document_number,
                    'documentUrl': { 'documentUrl': documentUrl }
                }
            } else {}
        }
        documentUrl.upload = Upload.upload({
            url: url,
            headers: { enctype: 'multipart/form-data' },
            data: datas
        });
        documentUrl.upload.then(function(response) {
            if (response.data.success) {
                if ($scope.documentRow == undefined) {
                    $scope.documentRow = [];
                }
                var user_documents = { 'id': userData.document_id, 'document_name': response.data.doc }
                if ($scope.id == 0) {
                    $scope.documentRow.push({ 'document_id': userData.document_id, 'document_number': userData.document_number, 'document_url': response.data.document_url, 'id': response.data.lastinsertid, 'user_documents': user_documents, 'document_name': response.data.doc })
                    $scope.action = 'Submit';
                    toaster.pop('success', 'Employee Documents', 'Document added.');
                } else if (response.data.delAct) {
                    $scope.documentRow = [];
                    $scope.documentRow = response.data.record;
                    //viveknk for sorting document_name key value added to root element
                    angular.forEach($scope.documentRow, function(value, key) {
                        value['document_name'] = value.user_documents.document_name;
                    });
                    $scope.action = 'Submit';
                    toaster.pop('success', 'Employee Documents', 'Document deleted.');
                } else {
                    $scope.documentRow.splice($scope.index, 1);
                    $scope.documentRow.splice($scope.index, 0, { 'id': $scope.id, 'document_id': userData.document_id, 'document_number': userData.document_number, 'document_url': response.data.document_url, 'user_documents': user_documents, 'document_name': response.data.doc })
                    $scope.action = 'Submit';
                    toaster.pop('success', 'Employee Documents', 'Document updated.');
                }
                $scope.userData = { 'document_id': '', 'document_number': '' };
                $scope.id = '0';
                $scope.document_url = '';
                $scope.userForm.$setPristine();
                $scope.userForm.$setUntouched(true);
                $scope.sbtBtn = false;
                $scope.userForm.$submitted = false;
                $scope.userData.employee_id = $scope.empId;
            } else {
                $scope.errorMsgg = response.data.errorMsgg;
                toaster.pop('error', 'Employee Documents', $scope.errorMsgg);
            }

        }, function(response) {
            if (response.success !== 200) {
                $scope.err_msg = "Please Select image for upload";
                toaster.pop('error', 'User Documents', $scope.err_msg);
            }
        });
    }; //createUserDocuments ends

    $scope.removeImg = function(imgname, id) {
        // console.log("removeImg" + id);
        if (window.confirm("Are you sure want to remove this image?")) {
            Data.post('user-document/removeImage/', id).then(function(response) {
                if (response.success) {
                    $scope.document_url = '';
                    toaster.pop('success', 'Employee Documents', response.message);
                } else {
                    toaster.pop('error', 'Employee Documents', response.message);
                }
            });
        }
    }

    $scope.manageEmployeeDocuments = function() {
        Data.get('user-document/documents').then(function(response) {
            $scope.DocumentsRow = response.records;
        });
    };

    $scope.changeErrorMsg = function() {
        $scope.errorMsgg = '';
    }
}]);
'use strict';
app.controller('taskManagement', ['$scope', '$state', '$stateParams', 'Data', 'Upload', '$rootScope', '$http', '$timeout', 'toaster', function($scope, $state, $stateParams, Data, Upload, $rootScope, $http, $timeout, toaster) {
    //for OrderFunction
    $scope.OrderRec = '-id';
    $scope.TaskManagement = {};
    $scope.taskthreeData = {}; //for task management
    $scope.taskfourData = {}; //for task management 

    // console.log("Onload-->" + JSON.stringify($scope.TaskManagement) + "   ");


    $scope.itemsPerPage = 30;
    $scope.pageNumber = 1;
    $scope.noOfRows = 1;

    //dynamic orderby function
    $scope.OrderFunction = function() {
        if ($scope.OrderRec == 'id') {
            $scope.OrderRec = '-id';
        } else if ($scope.OrderRec == '-id') {
            $scope.OrderRec = 'id';
        }
    }


    //viveknk for itemperpage model dropdown
    $scope.itemsPerPageModel = [1, 30, 100, 200, 300, 400, 500, 600, 700, 800, 900, 999];

    $scope.pageChanged = function(pageNo, functionName, id) {
        $scope.itemsPerPage = parseInt($scope.itemsPerPage);
        pageNo = parseInt(pageNo);
        $scope[functionName](id, pageNo, $scope.itemsPerPage);
        $scope.pageNumber = pageNo;
    };

    $scope.pageChangeHandler = function(num) {
        $scope.itemsPerPage = parseInt($scope.itemsPerPage);
        $scope.noOfRows = parseInt(num);
        $scope.currentPage = num * $scope.itemsPerPage;
    };

    $scope.getProcName = $scope.type = '';
    $scope.procName = function(procedureName, isTeam) {
        $scope.getProcName = angular.copy(procedureName);
        $scope.type = angular.copy(isTeam);
    }

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

    //vivek  ---delete model close
    $scope.Cancel = function() {
        $('#').modal('toggle');
    };

    //viveknk call to dashboard
    $scope.goDashboard = function() {
        $state.go('dashboard');
    };

    //viveknk call to Add Task
    $scope.gotasklist = function() {
        $state.go('tasklistIndex');
    };

    //viveknk call to Add Task
    $scope.goaddtask = function() {
        $state.go('addtask');
    };

    //viveknk call to back page
    $scope.backpage = function() {
        window.history.back();
    };

    $scope.getProducts = function(empId, pageNumber, itemPerPage) {
        $scope.showloader();
        Data.post('/Product_management/getproducts').then(function(response) {
            $scope.productRow = response.records;
            // console.log("productRow=" + JSON.stringify($scope.productRow));
            $scope.productLength = response.totalCount;
            $scope.hideloader();
        });
    };

    $scope.getsubProducts = function(empId, pageNumber, itemPerPage) {
        $scope.showloader();
        Data.post('/Product_management/getsubproducts').then(function(response) {
            $scope.subproductRow = response.records;
            $scope.subproductLength = response.totalCount;
            $scope.hideloader();
        });
    };

    $scope.getpmodules = function() {
        $scope.showloader();
        Data.post('/Product_management/getpmodules').then(function(response) {
            $scope.moduleRow = response.records;
            $scope.moduleLength = response.totalCount;
            $scope.hideloader();
        });
    };

    $scope.submoduleRow = {};
    $scope.getsubmodules = function() {
        $scope.showloader();
        Data.post('/Product_management/getsubmodules').then(function(response) {
            $scope.submoduleRow = response.records;
            $scope.submoduleLength = response.totalCount;
            $scope.hideloader();
        });
    };

    $scope.getSupportEmp = function() {
        $scope.showloader();
        Data.post('/TaskManagement/getSupportEmp').then(function(response) {
            $scope.SupportEmpRow = response.records;
            $scope.SupportEmpLength = response.totalCount;
            $scope.hideloader();
        });
    };

    $scope.tmStatusRow = {};
    $scope.getTmStatus = function() {
        $scope.showloader();
        Data.post('/TaskManagement/getTmStatus').then(function(response) {
            $scope.tmStatusRow = response.records;
            $scope.tmStatusLength = response.totalCount;
            $scope.hideloader();
        });
    };

    $scope.getTmPriority = function() {
        $scope.showloader();
        Data.post('/TaskManagement/getTmPriority').then(function(response) {
            $scope.tmPriorityRow = response.records;
            $scope.tmPriorityLength = response.totalCount;
            $scope.hideloader();
        });
    };

    $scope.getTasklist = function() {
        $scope.showloader();
        Data.post('/TaskManagement/getTasklist').then(function(response) {
            $scope.TasklistRow = response.records;
            $scope.TasklistLength = response.totalCount;
            $scope.hideloader();
        });
    };



    $scope.searchP = {};
    $scope.pchange = function(id) {
        $scope.searchP.product_id = id;
    }

    $scope.searchM = {};
    $scope.spchange = function(id) {
        $scope.searchM.sub_product_id = id;
    }

    $scope.searchsbM = {};
    $scope.mchange = function(id) {
        $scope.searchsbM.module_id = id;
    }

    $scope.developerList = {};
    $scope.getDeveloper = function() {
        Data.post('/Product_management/getDeveloper').then(function(response) {
            // console.log('response dev -->' + JSON.stringify(response.records));
            $scope.developerList = response.records;
        });
    };

    $scope.testerList = {};
    $scope.getTester = function() {
        Data.post('/Product_management/getTester').then(function(response) {
            // console.log('response tester -->' + JSON.stringify(response.records));
            $scope.testerList = response.records;
        });
    };

    //sub product dependable dropdown filter    
    $scope.selsbProduct = function(prid, sbprods) {
        $scope.subproduct = [];
        $scope.sbprdDpnd = [];
        angular.forEach(sbprods, function(value, key) {
            if (value.product_id == prid) {
                $scope.sbprdDpnd.push(value);
            } else {}
        });
        $scope.subproduct = $scope.sbprdDpnd;
    };

    $scope.createTask = function(taskData1, empId) {

        $scope.TaskManagement['createTask'] = taskData1;

        $scope.sub_modules_id = taskData1['sub_modules_id'];
        // console.log("createStatus-->" + JSON.stringify(taskData1) + "--empId==" + JSON.stringify(empId) + "--sub_module_id==" + JSON.stringify($scope.sub_module_id));

        $("#wiredstep2").addClass('active');
        $(".wiredstep2").removeClass('complete');
        $("#wiredstep1").addClass('ng-hide');
        $("#wiredstep1").removeClass('active');
        $("#wiredstep2").removeClass('ng-hide');
        $("#wiredstep1").css('display', 'none');
        $("#wiredstep2").css('display', 'block');
        $(".wiredstep2").addClass("active");
        $(".wiredstep1").removeClass("active");
        $(".wiredstep1").addClass('complete');

        $scope.assign = true;

        $scope.developer_list = '';
        $scope.tester_list = '';
        angular.forEach($scope.submoduleRow, function(value, key) {
            if (value.id == $scope.sub_modules_id) {
                // console.log("developer_list-->" + JSON.stringify(value.developer_list));
                $scope.developer_list = value.developer_list;
                $scope.tester_list = value.tester_list;
            } else {}
        });

        $scope.developer_list = $scope.developer_list.split(",");
        // console.log("developer_list split-->" + JSON.stringify($scope.developer_list));

        $scope.newdevList = [];
        angular.forEach($scope.developerList, function(value, key) {
            // console.log("developerList foreach 1st-->" + JSON.stringify(value));
            angular.forEach($scope.developer_list, function(value1, key1) {
                if (value.employee_id == value1) {
                    // console.log("developer_list foreach 2nd-->" + JSON.stringify(value1) + "---value==" + JSON.stringify(value));
                    $scope.newdevList.push(value);
                } else {}
            });
        });
        // console.log("developer_list foreach 2nd newdevList-->" + JSON.stringify($scope.newdevList));
        $scope.developerList = $scope.newdevList;



        $scope.tester_list = $scope.tester_list.split(",");
        // console.log("developer_list split-->" + JSON.stringify($scope.tester_list));

        $scope.newtstrList = [];
        angular.forEach($scope.testerList, function(valuet, keyt) {
            // console.log("developerList foreach 1st-->" + JSON.stringify(valuet));
            angular.forEach($scope.tester_list, function(value2, key2) {
                if (valuet.employee_id == value2) {
                    // console.log("developer_list foreach 2nd-->" + JSON.stringify(value2) + "---value==" + JSON.stringify(valuet));
                    $scope.newtstrList.push(valuet);
                } else {}
            });
        });
        // console.log("developer_list foreach 2nd newdevList-->" + JSON.stringify($scope.testerList));
        $scope.testerList = $scope.newtstrList;

        // console.log("createTask-->" + JSON.stringify($scope.TaskManagement) + "--empId==" + JSON.stringify(empId));

    }

    $scope.createAssignto = function(taskData2, empId) {

        $scope.TaskManagement['createAssignto'] = taskData2;
        // console.log("createAssignto-->" + JSON.stringify(taskData2) + "--empId==" + JSON.stringify(empId));

        // alert("createAssignto");

        $("#wiredstep3").addClass('active');
        $("#wiredstep2").addClass('ng-hide');
        $("#wiredstep2").removeClass('active');
        $("#wiredstep3").removeClass('ng-hide');
        $("#wiredstep2").css('display', 'none');
        $("#wiredstep3").css('display', 'block');
        $(".wiredstep3").removeClass('complete');
        $(".wiredstep3").addClass('active');
        $(".wiredstep2").addClass('complete');
        $(".wiredstep3").removeClass('complete');
        $(".wiredstep2").removeClass('active');

        // console.log("createAssignto-->" + JSON.stringify($scope.TaskManagement) + "--empId==" + JSON.stringify(empId));

    }

    $scope.createTaskdetails = function(taskData3, scrnsht, empId) {
        $scope.TaskManagement['createTaskdetails'] = taskData3;
        $scope.TaskManagement['Screenshot'] = scrnsht;
        // console.log("createTaskdetails-->" + JSON.stringify(taskData3) + "Screenshot==" + JSON.stringify(scrnsht) + "--empId==" + JSON.stringify(empId));
        // console.log("createTaskdetails-->" + JSON.stringify(taskData3) + "--empId==" + JSON.stringify(empId));

        $("#wiredstep4").addClass('active');
        $("#wiredstep3").addClass('ng-hide');
        $("#wiredstep3").removeClass('active');
        $("#wiredstep4").removeClass('ng-hide');
        $("#wiredstep3").css('display', 'none');
        $("#wiredstep4").css('display', 'block');
        $(".wiredstep4").removeClass('complete');

        $(".wiredstep4").addClass("active");
        $(".wiredstep3").removeClass("active");
        $(".wiredstep3").addClass('complete');

        // console.log("createTaskdetails-->" + JSON.stringify($scope.TaskManagement) + "--empId==" + JSON.stringify(empId));
    }

    $scope.createStatus = function(taskData4, empId) {
        // alert("createStatus");
        $scope.TaskManagement['createStatus'] = taskData4;

        // console.log("createStatus-->" + JSON.stringify($scope.TaskManagement) + "--empId==" + JSON.stringify(empId));
        var createTask = $scope.TaskManagement['createTask'];
        var createAssignto = $scope.TaskManagement['createAssignto'];
        var createTaskdetails = $scope.TaskManagement['createTaskdetails'];
        var screenshot = $scope.TaskManagement['Screenshot'];
        var createStatus = $scope.TaskManagement['createStatus'];

        //upload all data to create new task
        if (typeof screenshot == "undefined" || typeof screenshot == "string") {
            screenshot = new File([""], "fileNotSelected", { type: "text/jpg", lastModified: new Date() });
        }

        var url = 'TaskManagement/createTask';
        var data = { createTask: createTask, createAssignto: createAssignto, createTaskdetails: createTaskdetails, createStatus: createStatus, screenshot: screenshot };

        screenshot.upload = Upload.upload({
            url: url,
            headers: { enctype: 'multipart/form-data' },
            data: data
        });

        screenshot.upload.progress(function(evt) {

        }).success(function(data, status, headers, config) {

            if (data.success) {
                toaster.pop('success', 'Task Management', data.message);
                $state.go('tasklistIndex');
            } else {
                toaster.pop('error', 'Task Management', data.message);
            }
        }).error(function(data, status, headers, config) {
            console.log(' error data==' + JSON.stringify(data));
        });
    }

    $scope.checkImageExtension = function(scnshts) {
        // console.log('checkImageExtension' + JSON.stringify(scnshts));
        var scnsht = document.getElementById('employee_photo_file_name').value;
        $scope.screenshotprevw = scnshts;
        // console.log('screenshotprevw' + JSON.stringify($scope.screenshotprevw));
        if (typeof scnsht != 'undefined' || typeof scnsht == 'object') {
            var ext = scnsht.split('.');
            ext = ext[((ext.length) - 1)];
            if (angular.lowercase(ext) === 'jpg' || angular.lowercase(ext) === 'jpeg' || angular.lowercase(ext) === 'png' || angular.lowercase(ext) === 'bmp' || angular.lowercase(ext) === 'gif' || angular.lowercase(ext) === 'svg') {
                $scope.invalidImage = '';
                $scope.taskthreeForm.$valid = true;
            } else {
                alert("else");
                $(".imageFile").val("");
                $scope.invalidImage = "Invalid file format. File type should be jpg or jpeg or png or bmp format only.";
                $scope.taskthreeForm.$valid = false;
            }
        } else {}
    };

    // $scope.goprevious = function(pre) {
    //     if (pre == 1) {
    //         $("#wiredstep" + pre).addClass('active');
    //         $("#wiredstep" + pre).removeClass('ng-hide');
    //         $("#wiredstep" + pre).css('display', 'block');
    //         $(".wiredstep" + pre).addClass('active');
    //         $(".wiredstep" + pre).removeClass('complete');
    //         $scope.place = [2, 3, 4];
    //         angular.forEach(place, function(key, value) {
    //             $("#wiredstep" + value).css('display', 'none');
    //             $(".wiredstep" + value).removeClass('active');
    //             $("#wiredstep" + value).addClass('ng-hide');
    //             $("#wiredstep" + value).removeClass('active');
    //             $(".wiredstep" + value).addClass('complete');
    //         });
    //     } else if (pre == 2) {
    //         $("#wiredstep" + pre).addClass('active');
    //         $("#wiredstep" + pre).removeClass('ng-hide');
    //         $("#wiredstep" + pre).css('display', 'block');
    //         $(".wiredstep" + pre).addClass('active');
    //         $(".wiredstep" + pre).removeClass('complete');
    //         $scope.place = [3, 4, 1];
    //         angular.forEach($scope.place, function(key, value) {
    //             $("#wiredstep" + value).css('display', 'none');
    //             $(".wiredstep" + value).removeClass('active');
    //             $("#wiredstep" + value).addClass('ng-hide');
    //             $("#wiredstep" + value).removeClass('active');
    //             $(".wiredstep" + value).addClass('complete');
    //         });
    //     } else if (pre == 3) {
    //         $("#wiredstep" + pre).addClass('active');
    //         $("#wiredstep" + pre).removeClass('ng-hide');
    //         $("#wiredstep" + pre).css('display', 'block');
    //         $(".wiredstep" + pre).addClass('active');
    //         $(".wiredstep" + pre).removeClass('complete');
    //         $scope.place = [4, 2, 1];
    //         angular.forEach($scope.place, function(key, value) {
    //             $("#wiredstep" + value).css('display', 'none');
    //             $(".wiredstep" + value).removeClass('active');
    //             $("#wiredstep" + value).addClass('ng-hide');
    //             $("#wiredstep" + value).removeClass('active');
    //             $(".wiredstep" + value).addClass('complete');
    //         });
    //     } else if (pre == 4) {
    //         $("#wiredstep" + pre).addClass('active');
    //         $("#wiredstep" + pre).removeClass('ng-hide');
    //         $("#wiredstep" + pre).css('display', 'block');
    //         $(".wiredstep" + pre).addClass('active');
    //         $(".wiredstep" + pre).removeClass('complete');
    //         $scope.place = [3, 2, 1];
    //         angular.forEach($scope.place, function(key, value) {
    //             $("#wiredstep" + value).css('display', 'none');
    //             $(".wiredstep" + value).removeClass('active');
    //             $("#wiredstep" + value).addClass('ng-hide');
    //             $("#wiredstep" + value).removeClass('active');
    //             $(".wiredstep" + value).addClass('complete');
    //         });
    //     }
    // }

    $scope.previous = function(pre, current) {
        $("#wiredstep" + pre).addClass('active');
        $("#wiredstep" + current).addClass('ng-hide');
        $("#wiredstep" + current).removeClass('active');
        $("#wiredstep" + pre).removeClass('ng-hide');
        $("#wiredstep" + current).css('display', 'none');
        $("#wiredstep" + pre).css('display', 'block');
        $(".wiredstep" + pre).addClass('active');
        $(".wiredstep" + current).removeClass('active');
        $(".wiredstep" + pre).removeClass('complete');
        $(".wiredstep" + current).addClass('complete');

        // if (pre == 1) {
        //     if ($scope.userPersonalData.birth_date == '0000-00-00' || $scope.userPersonalData.birth_date == 'NaN-aN-NaN') {
        //         $scope.userPersonalData.birth_date = '';
        //     }
        //     if ($scope.userData.birth_date === null) {
        //         $scope.userData.birth_date = new Date();
        //     }

        //     if ($scope.userPersonalData.marriage_date == '0000-00-00' || $scope.userPersonalData.marriage_date == 'NaN-aN-NaN') {
        //         $scope.userPersonalData.marriage_date = '';
        //     }
        //     if ($scope.userData.marriage_date === null) {
        //         $scope.userData.marriage_date = new Date();
        //     }
        // }
        // if (pre == 4) {
        //     if ($scope.userJobData.joining_date == '0000-00-00' || $scope.userJobData.joining_date == 'NaN-aN-NaN') {
        //         $scope.userJobData.joining_date = '';
        //     }
        // }
    }

    //viveknk to catch file helps directive ngFiles
    var formdata = new FormData();
    $scope.getTheFiles = function($files) {

        angular.forEach($files, function(value, key) {
            // console.log("fileskey showDiv getTheFiles=" + $scope.showDiv);
            // // console.log("filesvalue=" + value.name);
            // // console.log("fileskey=" + key);
            // if ($scope.showDiv == "Bulk") {
            //     // console.log("fileskey showDiv if=" + $scope.showDiv);                

            //     str = value.name;
            //     str.toString();
            //     var l = (str.split('.').length) - 1;
            //     // console.log("str=" + str.split('.').length);
            //     // console.log("str end=" + str.split('.')[l]);
            //     var ext = str.split('.')[l];
            //     $scope.extention = ext.toString();
            // } else if ($scope.showDiv == "Individual") {
            //     // console.log("fileskey showDiv else=" + $scope.showDiv);           

            //     str = value.name;
            //     str.toString();
            //     var l = (str.split('.').length) - 1;
            //     // console.log("str=" + str.split('.').length);
            //     // console.log("str end=" + str.split('.')[l]);
            //     var ext = str.split('.')[l];
            //     $scope.extention = ext.toString();

            // } else {}
            formdata.append(key, value);

        });
    };

    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        $scope.getexcel = window.location = "/TaskManagement/exportToxls";
        if ($scope.getexcel) {
            toaster.pop('info', '', 'Exporting....');
        } else {
            toaster.pop('error', '', 'Exporting fails....');
        }
    };

    $scope.initModal = function(id) {
        $scope.id = id;
        $scope.heading = 'Approve Task';
        $scope.action = "Approve";
        $scope.cancl = true;
        $scope.domethod = 'put';
        $scope.statusId = '';

        //get id of status close     

        angular.forEach($scope.tmStatusRow, function(value, key) {
            angular.forEach(value, function(v1, k1) {
                // console.log('--StRow k==' + k1 + "--V==" + v1);
                if (k1 == 'status_name' && v1 == "Close") {
                    console.log('--StRow k==' + k1 + "--V==" + v1);
                    console.log('--StRow k==' + value['id']);
                    $scope.statusId = value['id'];
                } else {
                    $scope.statusId = 0;
                }
            });
        });

        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
        console.log('--statusId==' + $scope.statusId);
    };

    $scope.doTasklistAction = function(id, remark) {

        $scope.remark = remark;
        if ($scope.domethod == 'put') {

            Data.put('TaskManagement/' + $scope.id, { remark: $scope.remark, id: $scope.id }).then(function(response) {

                if (!response.success) {
                    toaster.pop('error', 'Manage Task', 'Task is not Approved.');
                } else {
                    $scope.TasklistRow = response.records;
                    $scope.TasklistLength = response.totalCount;

                    $('#tasklistModal').modal('toggle');
                    toaster.pop('success', 'Manage Task', 'Task Approved.');
                }
            });
        }
    };

    //vivek  ---delete model close
    $scope.Cancel = function() {
        $('#tasklistModal').modal('toggle');
    };

}]);

//this directive is defined to catch zip file
app.directive('ngFiles', ['$parse', function($parse) {

    function fn_link(scope, element, attrs) {
        var onChange = $parse(attrs.ngFiles);
        element.on('change', function(event) {
            onChange(scope, { $files: event.target.files });
        });
    };

    return {
        link: fn_link
    }
}]);
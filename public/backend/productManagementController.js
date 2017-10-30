'use strict';
app.controller('productManagementCtrl', ['$scope', '$state', '$stateParams', 'Data', 'Upload', '$rootScope', '$http', '$timeout', 'toaster', function($scope, $state, $stateParams, Data, Upload, $rootScope, $http, $timeout, toaster) {
    //for OrderFunction
    $scope.OrderRec = 'product_name';

    $scope.itemsPerPage = 30;
    $scope.pageNumber = 1;
    $scope.noOfRows = 1;


    //viveknk for itemperpage model dropdown
    $scope.itemsPerPageModel = [1, 30, 100, 200, 300, 400, 500, 600, 700, 800, 900, 999];

    $scope.pageChanged = function(pageNo, functionName, id) {
        $scope.itemsPerPage = parseInt($scope.itemsPerPage);
        pageNo = parseInt(pageNo);
        $scope[functionName](id, pageNo, $scope.itemsPerPage);
        $scope.pageNumber = pageNo;
    };

    $scope.getProducts = function(empId, pageNumber, itemPerPage) {
        $scope.showloader();
        Data.post('/Product_management/getproducts').then(function(response) {
            $scope.productRow = response.records;
            $scope.productLength = response.totalCount;
            $scope.hideloader();
        });
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

    $scope.initialModal = function(id, name, index, index1, del) {
        console.log('id=' + id + 'name=' + name + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        if (id == 0) {
            $scope.heading = 'Add New Product';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Product';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Product';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.product_name = name;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    }

    //dynamic orderby function
    $scope.OrderFunction = function() {
        if ($scope.OrderRec == 'product_name') {
            $scope.OrderRec = '-product_name';
        } else if ($scope.OrderRec == '-product_name') {
            $scope.OrderRec = 'product_name';
        }
    }

    $scope.doProductAction = function() {

        $scope.errorMsg = '';
        if ($scope.id === 0) //for create
        {
            if ($scope.domethod == 'post') {
                Data.post('Product_management/', {
                    product_name: $scope.product_name
                }).then(function(response) {
                    // response = json_decode(response);
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        $scope.productRow = response.records;
                        $scope.productLength = response.totalCount;

                        // $scope.bloodGrpRow.push({ 'blood_group': $scope.blood_group, 'id': response.lastinsertid });
                        $('#productModal').modal('toggle');
                        toaster.pop('success', 'Products', 'Record Created Successfully');
                        //$scope.success("Blood group details created successfully");
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update
            if ($scope.domethod == 'put') {

                Data.put('Product_management/' + $scope.id, { product_name: $scope.product_name, id: $scope.id }).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        $scope.productRow = response.records;
                        $scope.productLength = response.totalCount;

                        // $scope.bloodGrpRow.splice($scope.index, 1);
                        // $scope.bloodGrpRow.splice($scope.index, 0, {
                        //     blood_group: $scope.blood_group,
                        //     id: $scope.id
                        // });
                        $('#productModal').modal('toggle');
                        toaster.pop('success', 'Products', 'Record Updated Successfully');
                        // $scope.success("Blood group details updated successfully");
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('Product_management/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                        toaster.pop('error', 'Product', $scope.errorMsg);
                    } else {
                        $scope.productRow = response.records;
                        $scope.productLength = response.totalCount;

                        $('#productModal').modal('toggle');
                        toaster.pop('success', 'Products', 'Record Deleted Successfully');
                    }
                });
            }
        }
    }

    //vivek  ---delete model close
    $scope.Cancel = function() {
        $('#productModal').modal('toggle');
    };



    //vivek Export to xlsx
    $scope.ExportToxls = function() {

        $scope.getexcel = window.location = "/Product_management/exportToxls";
        if ($scope.getexcel) {
            toaster.pop('info', '', 'Exporting....');
        } else {
            toaster.pop('error', '', 'Exporting fails....');
        }
    };

    $scope.pageChangeHandler = function(num) {
        $scope.itemsPerPage = parseInt($scope.itemsPerPage);
        $scope.noOfRows = parseInt(num);
        $scope.currentPage = num * $scope.itemsPerPage;
    };

    //viveknk call to dashboard
    $scope.goDashboard = function() {
        $state.go('dashboard');
    };

    $scope.getsubProducts = function(empId, pageNumber, itemPerPage) {
        $scope.showloader();
        Data.post('/Product_management/getsubproducts').then(function(response) {
            $scope.subproductRow = response.records;
            $scope.subproductLength = response.totalCount;
            $scope.hideloader();
        });
    };

    //init model for sb product
    $scope.initialSbPModal = function(id, prdID, sbname, index, index1, del) {
        console.log('id=' + id + 'name=' + name + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        $scope.domethod = '';
        if (id == 0) {
            $scope.heading = 'Add Sub Product';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
        } else if (del == "del") {
            $scope.heading = 'Delete Sub Product';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';
        } else {
            $scope.heading = 'Edit Sub Product';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';
        }
        $scope.id = id;
        $scope.product_id = prdID;
        $scope.sub_product_name = sbname;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    }

    //viveknk sub product Action
    $scope.dosubProductAction = function() {

        $scope.errorMsg = '';
        if ($scope.id === 0) //for create
        {
            if ($scope.domethod == 'post') {
                Data.post('Product_management/store_sbproduct', {
                    product_id: $scope.product_id,
                    sub_product_name: $scope.sub_product_name
                }).then(function(response) {
                    // response = json_decode(response);
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        $scope.subproductRow = response.records;
                        $scope.subproductLength = response.totalCount;

                        // $scope.bloodGrpRow.push({ 'blood_group': $scope.blood_group, 'id': response.lastinsertid });
                        $('#productModal').modal('toggle');
                        toaster.pop('success', 'Sub Products', 'Record Created Successfully');
                        //$scope.success("Blood group details created successfully");
                    }
                });
            } else { console.log("domethod"); }
        } else { //for update
            if ($scope.domethod == 'put') {

                Data.put('Product_management/update_sbproduct/' + $scope.id, { sub_product_name: $scope.sub_product_name, product_id: $scope.product_id, id: $scope.id }).then(function(response) {

                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                    } else {

                        $scope.subproductRow = response.records;
                        $scope.subproductLength = response.totalCount;

                        // $scope.bloodGrpRow.splice($scope.index, 1);
                        // $scope.bloodGrpRow.splice($scope.index, 0, {
                        //     blood_group: $scope.blood_group,
                        //     id: $scope.id
                        // });
                        $('#productModal').modal('toggle');
                        toaster.pop('success', 'Sub Products', 'Record Updated Successfully');
                        // $scope.success("Blood group details updated successfully");
                    }
                });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('Product_management/destroy_subproduct/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        $scope.errorMsg = response.errormsg;
                        toaster.pop('error', 'Product', $scope.errorMsg);
                    } else {
                        $scope.subproductRow = response.records;
                        $scope.subproductLength = response.totalCount;

                        $('#productModal').modal('toggle');
                        toaster.pop('success', 'Sub Products', 'Record Deleted Successfully');
                    }
                });
            }
        }
    }

    //viveknk ---- Module ----
    $scope.getpmodules = function() {
        $scope.showloader();
        Data.post('/Product_management/getpmodules').then(function(response) {
            $scope.moduleRow = response.records;
            $scope.moduleLength = response.totalCount;

            // $scope.submoduleRow = response.records;
            // $scope.submoduleLength = response.totalCount;
            $scope.hideloader();
        });
    };

    $scope.developerList = [];
    $scope.testerList = [];
    //viveknk ---- Module ----
    $scope.getDeveloper = function() {

        Data.post('/Product_management/getDeveloper').then(function(response) {
            console.log('response dev -->' + JSON.stringify(response.records));

            $scope.developerList = response.records;
        });
    };


    $scope.getTester = function() {

        Data.post('/Product_management/getTester').then(function(response) {
            console.log('response tester -->' + JSON.stringify(response.records));
            $scope.testerList = response.records;
        });
    };

    //init model for Module
    $scope.initialModule = function(id, prdID, prdNM, sbprdID, sbprdNM, modNM, descr, screenshot, devp, testr, subproductRow, index, index1, del) {
        console.log('id=' + id + 'prdID=' + prdID + 'prdNM=' + prdNM + 'sbprdID=' + sbprdID + 'sbprdNM=' + sbprdNM + 'modNM=' + modNM + 'descr=' + descr + 'screenshot=' +
            screenshot + 'devp=' + devp + 'testr=' + testr + 'subproductRow=' + JSON.stringify(subproductRow) + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        $scope.mdata = {};
        $scope.domethod = '';
        if (id == 0) {
            $scope.heading = 'Add Module';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';
            $scope.screenshotsUrl = '';
        } else if (del == "del") {
            $scope.heading = 'Delete Module';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';

            $scope.id = id;
            $scope.mdata.product_id = prdID;
            $scope.mdata.product_name = prdNM;
            $scope.mdata.sub_product_id = sbprdID;
            $scope.mdata.sub_product_name = sbprdNM;
            //sub product for edit
            // $scope.selsbProduct(prdID, subproductRow);
            $scope.subproduct = subproductRow;
            //developer list for edit
            if (devp) {

                Data.post('/Product_management/getdeveloperById', {
                    devs: devp
                }).then(function(response) {
                    // console.log('response getdeveloperById -->' + JSON.stringify(response.records));
                    $scope.devRec = response.records;
                    $scope.mdata.developer_list = response.records;
                });

            } else {}

            //tester list for edit
            if (testr) {

                Data.post('/Product_management/gettesterById', {
                    testrs: testr
                }).then(function(response) {
                    // console.log('response getdeveloperById -->' + JSON.stringify(response.records));
                    $scope.testrRec = response.records;
                    $scope.mdata.tester_list = response.records;
                });

            } else {}

            $scope.mdata.pmodule = modNM;
            $scope.mdata.description = descr;
            $scope.screenshotsUrl = screenshot;

        } else {
            $scope.heading = 'Edit Module';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';


            $scope.id = id;
            $scope.mdata.product_id = prdID;
            $scope.mdata.product_name = prdNM;
            $scope.mdata.sub_product_id = sbprdID;
            $scope.mdata.sub_product_name = sbprdNM;
            //sub product for edit
            // $scope.selsbProduct(prdID, subproductRow);
            $scope.subproduct = subproductRow;
            //developer list for edit
            if (devp) {

                Data.post('/Product_management/getdeveloperById', {
                    devs: devp
                }).then(function(response) {
                    // console.log('response getdeveloperById -->' + JSON.stringify(response.records));
                    $scope.devRec = response.records;
                    $scope.mdata.developer_list = response.records;
                });

            } else {}

            //tester list for edit
            if (testr) {

                Data.post('/Product_management/gettesterById', {
                    testrs: testr
                }).then(function(response) {
                    // console.log('response getdeveloperById -->' + JSON.stringify(response.records));
                    $scope.testrRec = response.records;
                    $scope.mdata.tester_list = response.records;
                });

            } else {}

            $scope.mdata.pmodule = modNM;
            $scope.mdata.description = descr;
            $scope.screenshotsUrl = screenshot;
        }

        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    }


    //viveknk  ---delete model close
    $scope.Cancel = function() {
        $('#productModal').modal('toggle');
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

    $scope.checkImageExtension = function(scnshts) {
        var scnsht = document.getElementById('screenshots').value;
        $scope.screenshotprevw = scnshts;
        // console.log('screenshotprevw' + JSON.stringify($scope.screenshotprevw));
        if (typeof scnsht != 'undefined' || typeof scnsht == 'object') {
            var ext = scnsht.split('.');
            ext = ext[((ext.length) - 1)];
            if (angular.lowercase(ext) === 'jpg' || angular.lowercase(ext) === 'jpeg' || angular.lowercase(ext) === 'png' || angular.lowercase(ext) === 'bmp' || angular.lowercase(ext) === 'gif' || angular.lowercase(ext) === 'svg') {
                $scope.invalidImage = '';
                $scope.productForm.$valid = true;
            } else {
                alert("else");
                $(".imageFile").val("");
                $scope.invalidImage = "Invalid file format. File type should be jpg or jpeg or png or bmp format only.";
                $scope.productForm.$valid = false;
            }
        } else {}
    };

    //viveknk to catch zip file helps directive ngFiles
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



    //viveknk Module Action
    $scope.doModulesAction = function(mdata) {
        // console.log("productForm ===" + JSON.stringify(productForm));
        // return false;
        mdata['id'] = $scope.id;
        $scope.moduleprod = JSON.stringify(mdata);
        // console.log("doModulesAction moduleprod=" + $scope.moduleprod);
        formdata.append('mdata', $scope.moduleprod);

        // console.log("formdata ===" + formdata);
        // console.log("formdata ===" + JSON.stringify(formdata));
        // return false;

        $scope.errorMsg = '';
        if ($scope.id === 0) //for create
        {
            if ($scope.domethod == 'post') {

                //initialize request object
                var request = {
                    method: 'POST',
                    url: '/Product_management/store_pmodule',
                    // data: formdata,
                    headers: {
                        'Content-Type': undefined
                    },
                    data: formdata
                };

                // SEND THE FILES.
                $http(request)
                    .success(function(response) {

                        if (response.success) {

                            // $scope.fileData.month = $scope.monthdrpdn[$scope.crntmnth];
                            // $scope.fileData.remark = "";
                            // document.getElementById('file1').value = ''
                            // $scope.vloader = false;
                            // toaster.pop('success', 'Module', response.message);
                            $scope.moduleRow = response.records;
                            $scope.moduleLength = response.totalCount;
                            $('#productModal').modal('toggle');
                            toaster.pop('success', 'Module', response.message);
                        } else {
                            // $scope.vloader = false;
                            // toaster.pop('error', 'Employee Salary Slip', response.message);
                            toaster.pop('error', 'Module', response.message);
                        }
                    });

            } else { console.log("domethod"); }
        } else { //for update
            if ($scope.domethod == 'put') {
                console.log("edit module ===" + JSON.stringify($scope.mdata));
                // return false;

                //initialize request object
                var request = {
                    method: 'POST',
                    url: '/Product_management/update_pmodule',
                    // data: formdata,
                    headers: {
                        'Content-Type': undefined
                    },
                    data: formdata
                };

                console.log("edit module request ===" + JSON.stringify(request));
                // return false;
                // SEND THE FILES.
                $http(request)
                    .success(function(response) {

                        if (response.success) {
                            // $scope.fileData.month = $scope.monthdrpdn[$scope.crntmnth];
                            // $scope.fileData.remark = "";
                            // document.getElementById('file1').value = ''
                            // $scope.vloader = false;
                            $scope.moduleRow = response.records;
                            $scope.moduleLength = response.totalCount;
                            $('#productModal').modal('toggle');
                            toaster.pop('success', 'Module', response.message);
                        } else {
                            // $scope.vloader = false;
                            toaster.pop('error', 'Module', response.message);
                        }
                    });

            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('Product_management/destroy_module/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        toaster.pop('error', 'Product', response.message);
                    } else {
                        $scope.moduleRow = response.records;
                        $scope.moduleLength = response.totalCount;
                        $('#productModal').modal('toggle');
                        toaster.pop('success', 'Module', response.message);
                    }
                });
            }
        }
    }

    //viveknk ----sub Module ----
    $scope.getsubmodules = function() {
        $scope.showloader();
        Data.post('/Product_management/getsubmodules').then(function(response) {
            $scope.submoduleRow = response.records;
            $scope.submoduleLength = response.totalCount;
            $scope.hideloader();
        });
    };

    //init Sub model for Module
    $scope.initialsubModule = function(id, mdlID, mdlNM, sbmodNM, descr, screenshot, devp, testr, index, index1, del) {
        console.log('id=' + id + 'mdlID=' + mdlID + 'mdlNM=' + mdlNM + 'sbmodNM=' + sbmodNM + 'descr=' + descr + 'screenshot=' + screenshot + 'devp=' + devp + 'testr=' + testr + 'index=' + index + 'index1=' + index1 + 'del' + del);
        $scope.sbtBtn = false;
        $scope.mdata = {};
        $scope.domethod = '';
        if (id == 0) {
            $scope.heading = 'Add Sub Module';
            $scope.action = "Submit";
            $scope.cancl = false;
            $scope.domethod = 'post';


        } else if (del == "del") {
            $scope.heading = 'Delete Sub Module';
            $scope.action = "Confirm";
            $scope.cancl = true;
            $scope.domethod = 'delete';

            $scope.id = id;
            $scope.mdata.module_id = mdlID;
            $scope.mdata.module_name = mdlNM;
            $scope.mdata.sub_module_name = sbmodNM;
            $scope.mdata.description = descr;

            //developer list for edit
            if (devp) {

                Data.post('/Product_management/getdeveloperById', {
                    devs: devp
                }).then(function(response) {
                    // console.log('response getdeveloperById -->' + JSON.stringify(response.records));
                    $scope.devRec = response.records;
                    $scope.mdata.developer_list = response.records;
                });

            } else {}

            //tester list for edit
            if (testr) {

                Data.post('/Product_management/gettesterById', {
                    testrs: testr
                }).then(function(response) {
                    // console.log('response getdeveloperById -->' + JSON.stringify(response.records));
                    $scope.testrRec = response.records;
                    $scope.mdata.tester_list = response.records;
                });

            } else {}

            $scope.screenshotsUrl = screenshot;

        } else {
            $scope.heading = 'Edit Sub Module';
            $scope.action = "Update";
            $scope.cancl = true;
            $scope.domethod = 'put';

            $scope.id = id;
            $scope.mdata.module_id = mdlID;
            $scope.mdata.module_name = mdlNM;
            $scope.mdata.sub_module_name = sbmodNM;
            $scope.mdata.description = descr;

            //developer list for edit
            if (devp) {

                Data.post('/Product_management/getdeveloperById', {
                    devs: devp
                }).then(function(response) {
                    // console.log('response getdeveloperById -->' + JSON.stringify(response.records));
                    $scope.devRec = response.records;
                    $scope.mdata.developer_list = response.records;
                });

            } else {}

            //tester list for edit
            if (testr) {

                Data.post('/Product_management/gettesterById', {
                    testrs: testr
                }).then(function(response) {
                    // console.log('response getdeveloperById -->' + JSON.stringify(response.records));
                    $scope.testrRec = response.records;
                    $scope.mdata.tester_list = response.records;
                });

            } else {}

            $scope.screenshotsUrl = screenshot;
        }
        // $scope.id = id;
        // $scope.product_id = prdID;
        // $scope.sub_product_name = sbname;
        $scope.index = index * ($scope.noOfRows - 1) + (index1);
    }


    //viveknk Sub Module Action
    $scope.dosubModulesAction = function(mdata) {
        // console.log("productForm ===" + JSON.stringify(productForm));
        // return false;
        mdata['id'] = $scope.id;
        $scope.moduleprod = JSON.stringify(mdata);
        // console.log("doModulesAction moduleprod=" + $scope.moduleprod);
        formdata.append('mdata', $scope.moduleprod);

        // console.log("formdata ===" + formdata);
        // console.log("formdata ===" + JSON.stringify(formdata));
        // return false;

        $scope.errorMsg = '';
        if ($scope.id === 0) //for create
        {
            if ($scope.domethod == 'post') {

                //initialize request object
                var request = {
                    method: 'POST',
                    url: '/Product_management/store_submodule',
                    // data: formdata,
                    headers: {
                        'Content-Type': undefined
                    },
                    data: formdata
                };

                // SEND THE FILES.
                $http(request)
                    .success(function(response) {

                        if (response.success) {
                            // $scope.fileData.month = $scope.monthdrpdn[$scope.crntmnth];
                            // $scope.fileData.remark = "";
                            // document.getElementById('file1').value = ''
                            // $scope.vloader = false;
                            // toaster.pop('success', 'Employee Salary Slip', response.message);
                            $scope.submoduleRow = response.records;
                            $scope.submoduleRowLength = response.totalCount;
                            $('#productModal').modal('toggle');
                            toaster.pop('success', 'Sub Module', response.message);
                        } else {
                            // $scope.vloader = false;
                            toaster.pop('error', 'Sub Module', response.message);
                        }
                    });

            } else { console.log("domethod"); }
        } else { //for update
            if ($scope.domethod == 'put') {

                console.log("edit sub module ===" + JSON.stringify($scope.mdata));
                // return false;

                //initialize request object
                var request = {
                    method: 'POST',
                    url: '/Product_management/update_submodule',
                    // data: formdata,
                    headers: {
                        'Content-Type': undefined
                    },
                    data: formdata
                };

                console.log("edit sub module request ===" + JSON.stringify(request));
                // return false;
                // SEND THE FILES.
                $http(request)
                    .success(function(response) {

                        if (response.success) {
                            // $scope.fileData.month = $scope.monthdrpdn[$scope.crntmnth];
                            // $scope.fileData.remark = "";
                            // document.getElementById('file1').value = ''
                            // $scope.vloader = false;
                            $scope.submoduleRow = response.records;
                            $scope.submoduleLength = response.totalCount;
                            $('#productModal').modal('toggle');
                            toaster.pop('success', 'Sub Module', response.message);
                        } else {
                            // $scope.vloader = false;
                            toaster.pop('error', 'Sub Module', response.message);
                        }
                    });

                // Data.put('Product_management/update_sbproduct/' + $scope.id, { sub_product_name: $scope.sub_product_name, product_id: $scope.product_id, id: $scope.id }).then(function(response) {

                //     if (!response.success) {
                //         $scope.errorMsg = response.errormsg;
                //     } else {

                //         $scope.subproductRow = response.records;
                //         $scope.subproductLength = response.totalCount;

                //         // $scope.bloodGrpRow.splice($scope.index, 1);
                //         // $scope.bloodGrpRow.splice($scope.index, 0, {
                //         //     blood_group: $scope.blood_group,
                //         //     id: $scope.id
                //         // });
                //         $('#productModal').modal('toggle');
                //         toaster.pop('success', 'Sub Products', 'Record Updated Successfully');
                //         // $scope.success("Blood group details updated successfully");
                //     }
                // });
            } else if ($scope.domethod == 'delete') { //for delete
                Data.delete('Product_management/destroy_submodule/' + $scope.id).then(function(response) {
                    if (!response.success) {
                        toaster.pop('error', 'Sub Module', response.message);
                    } else {
                        $scope.submoduleRow = response.records;
                        $scope.submoduleLength = response.totalCount;

                        $('#productModal').modal('toggle');
                        toaster.pop('success', 'Sub Module', response.message);
                    }
                });
            }
        }
    }



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
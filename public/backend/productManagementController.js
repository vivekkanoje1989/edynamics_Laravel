'use strict';
app.controller('productManagementCtrl', ['$scope', '$state', '$stateParams', 'Data', '$rootScope', '$timeout', 'toaster', function($scope, $state, $stateParams, Data, $rootScope, $timeout, toaster) {
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

    $scope.getsubProducts = function(empId, pageNumber, itemPerPage) {
        $scope.showloader();
        Data.post('/Product_management/getsubproducts').then(function(response) {
            $scope.subproductRow = response.records;
            $scope.subproductLength = response.totalCount;
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
}]);
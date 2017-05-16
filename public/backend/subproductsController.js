/* 
 * client controller 
*/
'use strict';
app.controller('subproductsCtrl', ['$scope', 'Data', 'toaster','$rootScope','Upload','$state','$timeout', function ($scope, Data,toaster,$rootScope,Upload,$state,$timeout) {
        $scope.currentPage =  $scope.itemsPerPage = 10;
        $scope.noOfRows = 1;
        $scope.totalrecords;
        
        /*all list of products*/
        $scope.manageSubProducts = function () {
            
            Data.post('subproducts/manageSubProducts').then(function (response) {
                $scope.subProductList = response.records;
                $scope.totalrecords = response.count;
            });
            
        };
        
        $scope.getProductList = function()
        {
            Data.post('products/manageProducts').then(function (response) {
                $scope.productList = response.records;
            });
            
        }
        
        $scope.initialSubProductModal = function (id,name,status,product_id,index) {
            $scope.heading = 'Sub Products'
            $scope.subproduct_id = id;
            $scope.subproduct_name = name;
            $scope.product_id=product_id;
            $scope.index = index;
            $scope.status = status;
            $scope.display_msg=false;
            $scope.errorMsg="";
            
        }
        
        $scope.pageChangeHandler = function(num) {
            $scope.noOfRows = num;
            $scope.currentPage = num * $scope.itemsPerPage;
        };
        
        $scope.processSubproducts = function()
        {
            
            if($scope.subproduct_id  === 0)
            {
                
                Data.post('subproducts/', 
                     {
                        subproduct_name: $scope.subproduct_name,
                        status:$scope.status,
                        product_id : $scope.product_id
                     })
                     .then(function (response) 
                     {

                        if (!response.success)
                        {
                            $scope.errorMsg = response.errormsg;
                        } 
                        else 
                        {
                            
                            $scope.subProductList.push({
                                    'subproduct_name' : response.result.subproduct_name,'product_id':response.result.product_id,'subproduct_id':response.result.subproduct_id,status:response.result.status,
                                    'get_product_info': {
                                                    "product_id": response.result.get_product_info.product_id,
                                                    "product_name": response.result.get_product_info.product_name,
                                                } 
                                
                                
                            });
                            $scope.totalrecords = $scope.subProductList.length;
                            toaster.pop('success', 'Manage Sub Products', 'Sub Product created successfully');
                            $('#subproductModal').modal('toggle');
                        }
                     });
            }
            else
            {
                 Data.put('subproducts/'+$scope.subproduct_id, 
                    {
                        subproduct_id : $scope.subproduct_id,
                        subproduct_name: $scope.subproduct_name,
                        status:$scope.status,
                        product_id : $scope.product_id
                        
                    }).then(function (response) {

                     if (!response.success)
                     {
                         $scope.errorMsg = response.errormsg;
                     } 
                     else 
                     {
                        
                        $scope.subProductList.splice($scope.index, 1);
                        $scope.subProductList.splice($scope.index, 0, 
                        {
                           'subproduct_name' : response.result.subproduct_name,'product_id':response.result.product_id,'subproduct_id':response.result.subproduct_id,status:response.result.status,
                           'get_product_info': {
                                                    "product_id": response.result.get_product_info.product_id,
                                                    "product_name": response.result.get_product_info.product_name,
                                                } 
                           
                        });   
                        $scope.totalrecords = $scope.subProductList.length;
                        toaster.pop('success', 'Manage Sub Products', 'Sub Product updated successfully');
                        $('#subproductModal').modal('toggle');

                     }
                 });
             }
            
            
        }
        
        
        
}]);
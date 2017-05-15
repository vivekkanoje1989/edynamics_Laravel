/* 
 * client controller 
*/
'use strict';
app.controller('subproductsCtrl', ['$scope', 'Data', 'toaster','$rootScope','Upload','$state','$timeout', function ($scope, Data,toaster,$rootScope,Upload,$state,$timeout) {
        $scope.currentPage =  $scope.itemsPerPage = 10;
        $scope.noOfRows = 1;
        
        /*all list of products*/
        $scope.manageSubProducts = function () {
            
            Data.post('subproducts/manageSubProducts').then(function (response) {
                $scope.subProductList = response.records;
            });
            
        };
        
        $scope.initialProductModal = function (id,name,status,index) {
            $scope.heading = 'Products'
            $scope.product_id = id;
            $scope.product_name = name;
            $scope.index = index;
            $scope.status = status;
            $scope.display_msg=false;
            $scope.errorMsg="";
            
        }
        
        $scope.processProducts = function()
        {
            
            if($scope.product_id  === 0)
            {
                
                Data.post('products/', 
                     {
                        product_name: $scope.product_name,
                        status:$scope.status
                     })
                     .then(function (response) 
                     {

                        if (!response.success)
                        {
                            $scope.errorMsg = response.errormsg;
                        } 
                        else 
                        {
                            
                            $scope.productList.push({'product_name': $scope.product_name,'product_id':response.lastRecordId,status:response.result.status});
                            
                            toaster.pop('success', 'Manage Products', 'Product created successfully');
                            $('#productModal').modal('toggle');
                        }
                     });
            }
            else
            {
                 Data.put('products/'+$scope.product_id, {
                     product_name: $scope.product_name, product_id: $scope.product_id,status:$scope.status}).then(function (response) {

                     if (!response.success)
                     {
                         $scope.errorMsg = response.errormsg;
                     } 
                     else 
                     {
                         
                        $scope.productList.splice($scope.index, 1);
                        $scope.productList.splice($scope.index, 0, 
                        {
                           'product_name': $scope.product_name, 'product_id': $scope.product_id,'status':$scope.status
                        });
                        toaster.pop('success', 'Manage Products', 'Product updated successfully');
                        $('#productModal').modal('toggle');

                     }
                 });
             }
            
            
        }
        
        
        
}]);
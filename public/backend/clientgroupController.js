'use strict';
app.controller('clientgroupController',['$scope', 'Data','$filter','Upload','$window','$timeout','$state','$rootScope','toaster', function($scope, Data, $filter,Upload, $window,$timeout,$state,$rootScope,toaster) {
$scope.pageHeading = 'Client Group';
$scope.clientgroupData = {};
 $scope.currentPage = 1;
 $scope.itemsPerPage = 30;
    
    $scope.clientGroup = function (clientgroupData) {
        console.log(clientgroupData);
        $scope.submitted = true;
        var group_id = $("#group_id").val();
                if (group_id == '' || group_id == 0) {
                    $scope.clientgroupData.id = '';
                }
            Data.post('clientgroup', {
                data: {clientgroupData: clientgroupData},
            }).then(function (response,evt) {
                if (!response.success) {
                    $scope.errorMsg = response.message;
                    toaster.pop('success', 'Client Group', response.message);
                } else {
                    $scope.clientgroupData = {};
                    $scope.step1 = false;
                    toaster.pop('success', 'Client Group', response.message);
                    $timeout(function () {
                        $state.go('clientgroupIndex');
                    }, 200);


                }
            });
    };
    
    
    $scope.manageLists = function (id,action) { //edit/index page
        
        Data.post('clientgroup/manageLists',{
            id: id,
        }).then(function (response) {
            if (response.success) {
                if(action === 'index'){
                    $scope.listClientGroups = response.records.data;
                    $scope.listClientGroupLength = response.records.total;
                   
                }
                else if(action === 'edit'){
                    if(id !== '0'){
                        $scope.pageHeading = 'Edit Client Group';
                        $timeout(function () {
                            $scope.clientgroupData = angular.copy(response.records.data[0]);
                        }, 100);
                    }
                }else{
                    $scope.clientgroupData.id = id;
                }
            } else {
                $scope.errorMsg = response.message;
            }
        });
    };
     $scope.pageChangeHandler = function (num) {
            $scope.noOfRows = num;
            $scope.currentPage = num * $scope.itemsPerPage;
        };
    
}]);
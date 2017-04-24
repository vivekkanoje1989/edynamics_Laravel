/* 
 * client groups controller 
 */
'use strict';
app.controller('clientInfoCtrl', ['$scope', 'Data', 'toaster','$rootScope','$timeout', function ($scope, Data,toaster,$rootScope,$timeout) {
        $scope.currentPage =  $scope.itemsPerPage = 4;
        $scope.noOfRows = 1;
     
        /*all list of client groups*/
        $scope.manageClients = function () {
            Data.post('clients/manageClients').then(function (response) {
                $scope.clientInfoList = response.records;
            });
        };
       
       
}]);
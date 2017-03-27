/* 
 * client groups controller 
 */


'use strict';
app.controller('clientGroupCtrl', ['$scope', 'Data', '$rootScope','$timeout', function ($scope, Data, $rootScope,$timeout) {
        
        
        /*all list of client groups*/
        $scope.manageBloodGroup = function () {
            Data.post('blood-groups/manageBloodGroup').then(function (response) {
                $scope.bloodGrpRow = response.records;
            });
        };


}]);
/* 
 * client groups controller 
 */
'use strict';
app.controller('clientGroupCtrl', ['$scope', 'Data', '$rootScope','$timeout', function ($scope, Data, $rootScope,$timeout) {
        
        /* initial the Modal */
        $scope.initialModal = function (id, name, index) {
            $scope.heading = 'Client Group';
            $scope.id = id;
            $scope.group_name = name;
            $scope.index = index;
            $scope.display_msg=false;
        }
        
        /*all list of client groups*/
        $scope.manageClientGroups = function () {
            Data.post('clientgroups/manageClientGroup').then(function (response) {
                $scope.clientgroupslist = response.records;
            });
        };
       
       
       /*insertion & updation client group */
       $scope.processClientGroups = function(){
           
           
           if($scope.id  === 0)
           {
               Data.post('clientgroups/', 
                    {
                        group_name: $scope.group_name
                    })
                    .then(function (response) 
                    {
                        
                        if (!response.success)
                        {
                            $scope.errorMsg = response.errormsg;
                        } 
                        else 
                        {
                            $scope.clientgroupslist.push({'group_name': $scope.group_name,'id':response.lastRecordId});
                            $('#clientGroupsModal').modal('toggle');
                        }
                    });
           }
           else
           {
                Data.put('clientgroups/'+$scope.id, {
                    group_name: $scope.group_name, id: $scope.id}).then(function (response) {
                  
                    if (!response.success)
                    {
                        $scope.errorMsg = response.errormsg;
                    } 
                    else 
                    {
                        $scope.clientgroupslist.splice($scope.index, 1);
                        $scope.clientgroupslist.splice($scope.index, 0, 
                        {
                            group_name: $scope.group_name, id: $scope.id
                        });
                        
                        $('#clientGroupsModal').modal('toggle');
                        
                    }
                });
            }
           
       }
       
       
       
       
}]);
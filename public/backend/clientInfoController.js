/* 
 * client groups controller 
 */
'use strict';
app.controller('clientInfoCtrl', ['$scope', 'Data', 'toaster','$rootScope','Upload','$state','$timeout', function ($scope, Data,toaster,$rootScope,Upload,$state,$timeout) {
        $scope.currentPage =  $scope.itemsPerPage = 4;
        $scope.noOfRows = 1;
        $scope.clientData={};
        $scope.clientPkId=0;
     
        /*all list of client groups*/
        $scope.manageClients = function () {
            
            Data.post('clients/manageClients').then(function (response) {
                $scope.clientInfoList = response.records;
            });
            
        };
        
        $scope.editClients = function (id) {
            
            if(id !=0)
            {
               Data.post('clients/manageClients',{
                    id: id,
            }).then(function (response) {
                     $scope.clientInfoList = response.records;
            }); 
                
                
            }    
            
        }
        
        /*Data.post('clients/manageClients',{
                id:id
            }).then(function (response) {
                $scope.clientInfoList = response.records;
            });*/
        
        /*create client*/
        $scope.createClients = function (clientData) {
            
            var url = getUrl+'/clients/';
            var data = {data: clientData};
            var successMsg = "Record successfully created.";
            
            
            clientData.company_logo.upload = Upload.upload({
                url : url,
                headers: {enctype: 'multipart/form-data'},
                data: data
                
            })
            
            clientData.company_logo.upload.then(function (response) {
                    toaster.pop('success', 'Manage Clients', 'client created successfully');
                    $state.go(getUrl + '.clientsIndex');   
           
            }, function (response) {
                if (response.status !== 200) {
                    $scope.err_msg = "Please Select image for upload";
                }
            });
            
    }
        
}]);

app.controller('getClientGroupsCtrl', function ($scope, $timeout, Data) {
    Data.get('getClientGroupsList').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.clientGroupsList = response.records;
        }
    });
});


app.controller('getClientGroupsCtrl', function ($scope, $timeout, Data) {
    Data.get('getClientGroupsList').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.clientGroupsList = response.records;
        }
    });
});

app.controller('getCompanyTypeCtrl', function ($scope, $timeout, Data) {
    Data.get('getCompanyTypeList').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.companyTypeList = response.records;
        }
    });
});




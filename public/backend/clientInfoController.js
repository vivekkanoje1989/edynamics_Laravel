/* 
 * client groups controller 
 */
'use strict';
app.controller('clientInfoCtrl', ['$scope', 'Data', 'toaster','$rootScope','Upload','$state','$timeout', function ($scope, Data,toaster,$rootScope,Upload,$state,$timeout) {
        $scope.currentPage =  $scope.itemsPerPage = 4;
        $scope.noOfRows = 1;
        $scope.clientData={};
        $scope.clientPkId=0;
        $scope.clientData.company;
        $scope.companyLogoValidation;
        $scope.reqnone;
        /*all list of client groups*/
        $scope.manageClients = function () {
            
            Data.post('clients/manageClients').then(function (response) {
                $scope.clientInfoList = response.records;
            });
            
        };
        
        $scope.editClients = function (id) {
            
            
            if(id !=0)
            {
                $scope.companyLogoValidation = false;
                $scope.reqnone='false';
                Data.post('clients/manageClients',{
                         id: id,
                }).then(function (response) {
                          $scope.clientData = response.records;
                          $scope.clientData.company = response.records.company_logo;
                          $scope.clientData.company_logo="";
                          $scope.$broadcast('countryEvent',response.records.country_id);
                          $scope.state_id = response.records.state_id;
                          $scope.$broadcast('stateEvent',response.records.state_id);
                          $scope.city_id = response.records.city_id;
                          
                          
                }); 
            } 
            else
            {
                $scope.companyLogoValidation = true;
                $scope.reqnone='true';
            }    
        }
        
        
        /*create client*/
        $scope.createClients = function (clientData) {
            
            if(clientData.id == 0)
            {
                var url = getUrl+'/clients/';
                var data = {data: clientData};
                clientData.company_logo.upload = Upload.upload({
                    url : url,
                    headers: {enctype: 'multipart/form-data'},
                    data: data

                })
            }
            else
            {
                clientData.company_logo_flag = 1;
                if (typeof clientData.company_logo === 'undefined' || clientData.company_logo == "") {
                           clientData.company_logo = new File([""], "fileNotSelected", {type: "text/jpg", lastModified: new Date()});
                           clientData.company_logo_flag = 0 ;
                }
                
                var url = getUrl + '/clients/update/' + clientData.id;
                var data = {data : clientData}
                
                
                clientData.company_logo.upload = Upload.upload({
                    url : url,
                    headers: {enctype: 'multipart/form-data'},
                    data: data

                })
                
            }    
            
            clientData.company_logo.upload.then(function (response) {
                    if(clientData.id == 0)
                    {    
                        toaster.pop('success', 'Manage Clients', 'client created successfully');
                    }
                    else
                    {
                        toaster.pop('success', 'Manage Clients', 'client updated successfully');
                    }  
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







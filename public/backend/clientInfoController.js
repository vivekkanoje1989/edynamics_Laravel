/* 
 * client controller 
 */
'use strict';
app.controller('clientInfoCtrl', ['$scope', 'Data', 'toaster','$rootScope','Upload','$state','$timeout', function ($scope, Data,toaster,$rootScope,Upload,$state,$timeout) {
        $scope.currentPage =  $scope.itemsPerPage = 10;
        $scope.isexitsContact;
        
        $scope.clientContactInfo=[];
        $scope.noOfRows = 1;
        $scope.clientData={};
        $scope.cltcontactdata = {};
        $scope.clientPkId=0;
        $scope.clientData.company;
        $scope.companyLogoValidation;
        $scope.reqnone;
        $scope.totalrecords;
        /*all list of client groups*/
        $scope.manageClients = function () {
            
            Data.post('clients/manageClients').then(function (response) {
                $scope.clientInfoList = response.records;
                $scope.totalrecords = response.count;
                
                $scope.clientContactInfo = response;
                console.log(response.contactinfo);
                
            });
            
        };
        //{{ list.id}},'{{list.first_name}}','{{list.last_name}}',{{list.title_id}},{{list.designation_id}},{{list.gender_id}},{{list.mobile_number}},'{{list.email_id}}','{{list.password}}',{{list.high_security_password_type}},{{list.high_security_password}},$index
        /*init the contact modal*/
        $scope.initialContactModal = function (id,list,index)
        {
            $scope.contactModalHeading = 'Contact Information';  
            $scope.clt_contact_display_msg = false;
            $scope.cltcontactdata=list;
//            $scope.cltcontactdata.person_type = person_type;
//            $scope.cltcontactdata.first_name = first_name;
//            $scope.cltcontactdata.last_name = last_name;
//            $scope.cltcontactdata.title_id = title_id;
//            $scope.cltcontactdata.designation_id = designation_id;
//            $scope.cltcontactdata.gender_id = gender_id;
//            $scope.cltcontactdata.mobile_number = mobile_number;
//            $scope.cltcontactdata.email_id = email_id;
//            $scope.cltcontactdata.password = password;
//            $scope.cltcontactdata.high_security_password_type = high_security_password_type;
//            $scope.cltcontactdata.high_security_password = high_security_password;
//            $scope.cltcontactdata.status = status;
            $scope.cltcontactdata.index = index;
            $scope.display_msg=false;
            
            if(id !="")
                $scope.isexitsContact = 1;
            else 
                $scope.isexitsContact = 0;
        }
        
        /*push client the contact info*/
        $scope.processCltContactInfo = function(cltcontactdata)
        {
            
            
            $('#contactInfoModal').modal('toggle');
            if($scope.isexitsContact == 1)
            {    
                $scope.clientContactInfo.splice($scope.index, 1);
                $scope.clientContactInfo.splice($scope.index, 0, 
                {
                   'id': cltcontactdata.id,
                    'person_type': cltcontactdata.person_type,
                    'title_id':cltcontactdata.title_id,
                    'first_name':cltcontactdata.first_name,
                    'last_name':cltcontactdata.last_name,
                    'designation_id':cltcontactdata.designation_id,
                    'gender_id':cltcontactdata.gender_id,
                    'mobile_number':cltcontactdata.mobile_number,
                    'email_id':cltcontactdata.email_id,
                    'password':cltcontactdata.password,
                    'high_security_password_type':cltcontactdata.high_security_password_type,
                    'high_security_password':cltcontactdata.high_security_password,
                    'status':$scope.status
                });
                toaster.pop('success', 'Contact Information', 'contact information updated successfully');
            }
            else
            {
                $scope.clientContactInfo.push({
                    
                    'id': 0,
                    'person_type': cltcontactdata.person_type,
                    'title_id':cltcontactdata.title_id,
                    'first_name':cltcontactdata.first_name,
                    'last_name':cltcontactdata.last_name,
                    'designation_id':cltcontactdata.designation_id,
                    'gender_id':cltcontactdata.gender_id,
                    'mobile_number':cltcontactdata.mobile_number,
                    'email_id':cltcontactdata.email_id,
                    'password':cltcontactdata.password,
                    'high_security_password_type':cltcontactdata.high_security_password_type,
                    'high_security_password':cltcontactdata.high_security_password,
                    'status':cltcontactdata.status
                
                });
                toaster.pop('success', 'Contact Information', 'contact information created successfully');
            }    
                
        }
        
        /*display page no.*/
        $scope.pageChangeHandler = function(num) {
            $scope.noOfRows = num;
            $scope.currentPage = num * $scope.itemsPerPage;
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
                           if(response.contactflag)
                                $scope.clientContactInfo = response.contactinfo;
                          
                          
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
            
            
            if($scope.clientContactInfo.length == 0)
            {    
                toaster.pop('error', 'Manage Clients', 'You must at least add one contact information');
                return false;
            }    
            else
            {
                clientData.contactInfo = $scope.clientContactInfo;
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







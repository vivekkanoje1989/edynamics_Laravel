/* 
 * client controller 
 */
'use strict';
app.controller('clientInfoCtrl', ['$scope', 'Data', 'toaster','$rootScope','Upload','$state','$timeout','$location', function ($scope, Data,toaster,$rootScope,Upload,$state,$timeout,$location) {
        $scope.currentPage =  $scope.itemsPerPage = 30;
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
        $scope.servicelist = {};
        $scope.discountInfo=[];
        $scope.isUpdate = false;
        $scope.invoicebtn =false;
        $scope.serviceTypesData = {};
        
        /*all list of client groups*/
        $scope.manageClients = function () {
            
            Data.post('clients/manageClients').then(function (response) {
                $scope.clientInfoList = response.records;
                $scope.totalrecords = response.count;
                $scope.clientContactInfo = response;
                
            });
            
        };
        
        
         $scope.validateMobile = function(mobNo,label){
        var mobNoSplit = mobNo.split('-')[1];
        var firstDigit = mobNoSplit.substring(0, 1);
        
        var model = $parse(label);        
        if(mobNoSplit.length >= 10)
        {
            if(mobNoSplit === "0000000000" ){
                model.assign($scope, "Mobile number should not be 0000000000");
                $scope.applyClassMobile = 'ng-active';
            }else if(firstDigit === "0"){
                model.assign($scope, "First digit of mobile number should not be 0");
                $scope.applyClassMobile = 'ng-active';
            }
            else
            {
                model.assign($scope, "");
                $scope.errPersonalMobile = "";
                $scope.applyClassMobile = 'ng-inactive';
            }  
        }
    }
        /*init the contact modal*/
        $scope.initialContactModal = function (id,list,isexitsContact,index)
        {
            $scope.contactModalHeading = 'Contact Information';  
            $scope.clt_contact_display_msg = false;
            $scope.cltcontactdata=list;
            $scope.index = index;
            $scope.display_msg=false;
            
            if(isexitsContact == 1)
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
                    'password_confirmation':cltcontactdata.password_confirmation,
                    'high_security_password_type':cltcontactdata.high_security_password_type,
                    'high_security_password':cltcontactdata.high_security_password,
                    'status':cltcontactdata.status
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
                    'password_confirmation':cltcontactdata.password_confirmation,
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
        
        
        $scope.manageClientinfowithservices = function(id){
            if(id !=0)
            {
                
                $scope.companyLogoValidation = false;
                $scope.reqnone='false';
                Data.post('clients/manageClientinfowithservices',{
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
                           
                           console.log(response.serviceInfo);
                            $scope.clientServices = response.serviceInfo;
                            
                }); 
            } 
            else
            {
                $scope.companyLogoValidation = true;
                $scope.reqnone='true';
            }  
        }
        
       
         $scope.changeServiceStatus = function(val,index,id){
             
            Data.post('clients/changeServiceStatus', {
                val: val,
                id: id
            }).then(function (response) {
                if (response.success) {
                    var successMsg = response.successMsg;
                    toaster.pop('success', 'Services Settings', successMsg);               
                } else {
                    var errorMsg = response.errorMsg;
                    toaster.pop('error', 'Services Settings', errorMsg);
                }
            });
        };
        
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
                    var url = '/clients/';
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

                    var url = '/clients/update/' + clientData.id;
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
                
                $state.go('clientsIndex');   
           
            }, function (response) {
                if (response.status !== 200) {
                    $scope.err_msg = "Please Select image for upload";
                }
            });
            
        }    
            
    }
    
        $scope.addMlstServices = function(mlstservicename){
            Data.post('clients/addmstservices',{
                service_name:mlstservicename
            }).then(function(response){
                if (response.success) {
                         var successMsg = response.successMsg;
                         $('#addserviceModal').modal('toggle');
                         toaster.pop('success', 'Services', successMsg);    
                                Data.get('getServicesList').then(function (response) {
                                    if (!response.success) {
                                        $scope.errorMsg = response.message;
                                    } else {
                                        $scope.clientservicesList = response.records;
                                    }
                                });
                     } else {
                         var errorMsg = response.errorMsg;
                         toaster.pop('error', 'Services', errorMsg);
                     }
            });
        }
        
         Data.get('getServicesList').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.clientservicesList = response.records;
        }
    });
    
    
    $scope.isStatusChange = function(value){
        $scope.serviceData.status = value;
        
    }
    
    
    $scope.initialDiscountModal = function (id,list,isexits,index,serviceID)
        {
           Data.post('getDiscountList',{serviceid:serviceID}).then(function (response) {
                if (!response.success) {
                    $scope.errorMsg = response.message;
                } else {
                    $scope.discountlist = response.records;
                }
            });
        
            $scope.contactModalHeading = 'Contact Information';  
            $scope.clt_contact_display_msg = false;
            $scope.discountdata=list;
            $scope.index = index;
            $scope.display_msg=false;
            
            if(isexits == 1)
                $scope.isexits = 1;
            else 
                $scope.isexits = 0;
        }
         
        /*push client the contact info*/
        
       
        $scope.processDiscount = function(discountdata)
        {
           
           var discount_for = $("#discount_for_id").find("option:selected").text();
            
            $('#addDiscountModal').modal('toggle');
            if($scope.isexits == 1)
            {    
                $scope.discountInfo.splice($scope.index, 1);
                $scope.discountInfo.splice($scope.index, 0, 
                {
                   'id': discountdata.id,
                    'discount_amt':discountdata.discount_amt,
                    'applicable_month':discountdata.applicable_month,
                    'discount_for_id':discountdata.discount_for_id,
                    'discount_for': discount_for,
                    'status':discountdata.status
                });
                toaster.pop('success', 'Discount Information', 'Discount information updated successfully');
            }
            else
            {
              
               var discount =  $("#discount_for_id option[value='"+discountdata.discount_for_id+"']").text();
              
                $scope.discountInfo.push({
                    'id': 0,
                    'discount_amt':discountdata.discount_amt,
                    'applicable_month':discountdata.applicable_month,
                    'discount_for_id':discountdata.discount_for_id,
                    'discount_for': discount_for,
                    'status':discountdata.status
                
                });
                toaster.pop('success', 'Discount Information', 'Discount information created successfully');
            }    
                
        }
        
        $scope.createService = function(serviceData,discountInfo){
            Data.post('clients/createServices',{
                serviceData:serviceData,discountInfo:discountInfo
            }).then(function (response) {
                    if (!response.success) {
                        $scope.errorMsg = response.message;
                    } else {
                        var successMsg = response.successMsg;
                        toaster.pop('success', 'Services Settings', successMsg);
                        $location.url('/clients/clientinfo/'+serviceData.clientid); 
                    }
                });
        }
        
        $scope.manageserviceswithdiscount = function(clientId,serviceId)
        {
            if(serviceId != 0){
                $scope.discountIds = [];
                Data.post('clients/getServiceanddiscount',{
                    serviceId:serviceId,clientId:clientId
                }).then(function(response){
                        $scope.discountdata = response.servicesDiscount;
                        if($scope.discountdata != undefined){
                        for(i=0;i<$scope.discountdata.length;i++){
                            $scope.discountIds.push($scope.discountdata[i].discount_for_id);

                        }
                        }

                        Data.post('clients/getdiscountdetails',{
                             discountId:$scope.discountIds,discountdata : $scope.discountdata
                         }).then(function(response){
                             if(response.success){
                                 $scope.discountInfo = response.discountdata;
                            }
                        });

                      $scope.clientData = response.clients;
                     $scope.isUpdate = true;
                    $scope.serviceData = response.subscribedServices;
                });
            }else
            {
                Data.post('clients/getClientDetails',{
                    clientId:clientId
                }).then(function(response){
                     $scope.clientData = response.clients;
                });
                
            }
            
        }
        

            $scope.servicesID = [];
            $scope.selectedService = function(id) {
                $scope.serviceselected = true;
                var index = $scope.servicesID.indexOf(id);
                if(index === -1 ){
                       $scope.servicesID.push(id); 
                } else {
                        $scope.servicesID.splice(index, 1);
                        if( $scope.servicesID == ''){
                            $scope.serviceselected = false;
                        }
                }
                
                
               

            };
            
            $scope.service = [];
            $scope.firmspartnerslist = [];
            $scope.initialGenerateInvoiceModal =  function(servicesID,clientId)
            {
                Data.post('clients/getClientfirmpartners',{
                            clientId:clientId
                        }).then(function (response) {
                           if(response.status){
                               
                                $scope.firmspartnerslist = response.records;
                            }else
                            {
                                $scope.firmspartnerslist = '';
                            }
                        });
                        
               $scope.service = servicesID;
             
                
            }
            
            $scope.generateData = {};
            $scope.serviceTypesData ={};
            $scope.generateInvoice = function (generateData,client_id,services){
                    $scope.generateData = generateData;
                   
                   $scope.invoicebtn =true;
                   
                    if(services[0] == 3){
                        
                            Data.post('clients/generateCtInvoice',{
                             generateData:$scope.generateData,servicestype:services,clientId:client_id
                        }).then(function (response) {
                          
                            $scope.invoicebtn =false;
                                $('#generateInvoiceModal').modal('toggle');
                                if (response.success) {
                                    var successMsg = response.message;
                                    toaster.pop('success', 'Invoice Generated Status', successMsg);
                                    $scope.generateData = {};
                                    $scope.Savebtn = false;
                                } else {
                                    var errorMsg = response.message;
                                    toaster.pop('error', 'Invoice Generated Status', errorMsg);
                                    
                                }
                        });
                    }else
                    {
                    Data.post('clients/getServicefrmMaster',{
                            serviceId:services
                        }).then(function (response) {
                               
                        $scope.generateData.client_id = client_id;
                        Data.post('clients/generateInvoice',{
                                 generateData:$scope.generateData,servicestype:response.records
                            }).then(function (response) {
                                $scope.invoicebtn =false;
                                $('#generateInvoiceModal').modal('toggle');
                                if (response.success) {
                                    var successMsg = response.message;
                                    toaster.pop('success', 'Invoice Generated Status', successMsg);
                                    $scope.generateData = {};
                                    $scope.Savebtn = false;
                                } else {
                                    var errorMsg = response.message;
                                    toaster.pop('error', 'Invoice Generated Status', errorMsg);
                                    
                                }

                        });
                    });
                }
        }
        
        $scope.gettotalprice =  function(no,price)
        {
            $scope.serviceData.total_price = no * price;
            
            
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

app.controller('accountTypeCtrl', function ($scope, $timeout, Data) {
    Data.get('getAccountType').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            
            $scope.accountTypes = response.records;
        }
    });
});

app.controller('systemTypeCtrl', function ($scope, $timeout, Data) {
    Data.get('getSystemType').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.systemTypes = response.systemTypes;
            $scope.systemsubTypes = response.systemsubTypes;
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

app.controller('discountCtrl', function ($scope, $timeout, Data) {
     Data.post('getDiscountList',{serviceid:serviceID}).then(function (response) {
                if (!response.success) {
                    $scope.errorMsg = response.message;
                } else {
                    $scope.discountlist = response.records;
                }
            });
});









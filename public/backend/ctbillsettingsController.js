'use strict';
app.controller('ctbillsettingsController', ['$scope', 'Data', 'toaster','$rootScope','Upload','$state','$timeout', function ($scope, Data,toaster,$rootScope,Upload,$state,$timeout) {
      
        $scope.currentPage =  $scope.itemsPerPage = 30;
        $scope.ctnumbersList = {};
        $scope.noOfRows = 1;
        $scope.totalrecords;
       $scope.ctnumbersData = {};
        $scope.ctnumberbtn = false;
        
        $scope.manageClientCtnumbers = function (client_id){
            
            Data.post('ctbillsettings/manageClientCtnumbers', {
                client_id: client_id,
            }).then(function (response) {
                if (response.success) {
                    $scope.ctnumbersList = response.records.data;
                    $scope.clientId = response.records.data.client_id;
                    $scope.ctnumbersData.client_id = client_id;
                    $scope.clientName = response.records.data[0].marketing_name;
                } else if(response.success == false) {
                    $scope.totalrecords = 0;
                    $scope.ctnumbersData.client_id = client_id;
                    $scope.clientName = response.records.data.marketing_name;
                }
            });
        }
        
        $scope.initialaddnumbersModal = function()
        {
                   
                   $scope.ctnumbersData.virtual_number = '';
                   $scope.ctnumbersData.display_number = '';
                   $scope.ctnumbersData.incoming_pulse_duration = '';
                   $scope.ctnumbersData.incoming_pulse_rate = '';
                   $scope.ctnumbersData.local_outbound_pulse_duration = '';
                   $scope.ctnumbersData.local_outbound_pulse_rate = '';
                   $scope.ctnumbersData.isd_outbound_pulse_duration = '';
                   $scope.ctnumbersData.isd_outbound_pulse_rate = '';
                   $scope.ctnumbersData.dial_outbound_callas = '';
                   $scope.ctnumbersData.activation_date = '';
                   $scope.ctnumbersData.rent_amount = '';
                   $scope.ctnumbersData.number_status = '';
        }
        
        $scope.addctnumberssettings = function(ctnumbersData)
        {
            console.log(ctnumbersData); 
            $scope.ctnumberbtn = true;
            if(ctnumbersData.id){
                Data.post('ctbillsettings/updateCtnumbers', {
                    ctnumbersData: ctnumbersData,
                }).then(function (response) {
                     $('#addnumbersModal').modal('toggle');
                    if (response.success) {
                        $scope.ctnumbersList = response.records;
                        var successMsg = 'Number Updated successfully !';
                        toaster.pop('success', 'Number status', successMsg);
                        $scope.ctnumberbtn = false; 
                        $scope.manageClientCtnumbers(ctnumbersData.client_id);
                       
                    } else {
                        $scope.errorMsg = response.message;
                    }
                });
                
            }else{
                
                Data.post('ctbillsettings/addCtnumbers', {
                    ctnumbersData: ctnumbersData,
                }).then(function (response) {
                     $('#addnumbersModal').modal('toggle');
                    if (response.success) {
                        $scope.ctnumbersList = response.records;
                        var successMsg = 'Number added successfully !';
                        toaster.pop('success', 'Number status', successMsg);
                        $scope.ctnumberbtn = false;
                        $scope.manageClientCtnumbers(ctnumbersData.client_id);
                        
                    } else {
                        $scope.errorMsg = response.message;
                    }
                });
                
            }
        }
        
        $scope.initialCtNumbersModal = function(id)
        {
            Data.post('ctbillsettings/getCtnumber', {
                ctnumberid: id,
            }).then(function (response) {
                if (response.success) {
                    console.log(response);
                    if(response.records.data.deactivation_date == "0000-00-00"){
                         $scope.ctnumbersData.deactivation_date = ' ';
                    }else
                    {
                        $scope.ctnumbersData.deactivation_date = response.records.data.deactivation_date;
                    }
                   $scope.ctnumbersData.id = id;
                   $scope.ctnumbersData.client_id = response.records.data.client_id;
                   $scope.ctnumbersData.virtual_number = response.records.data.virtual_number;
                   $scope.ctnumbersData.display_number = response.records.data.display_number;
                   $scope.ctnumbersData.default_number = response.records.data.default_number;
                   $scope.ctnumbersData.incoming_call_status = response.records.data.incoming_call_status;
                   $scope.ctnumbersData.incoming_pulse_duration = response.records.data.incoming_pulse_duration;
                   $scope.ctnumbersData.incoming_pulse_rate = response.records.data.incoming_pulse_rate;
                   $scope.ctnumbersData.outbound_call_status = response.records.data.outbound_call_status;
                   $scope.ctnumbersData.local_outbound_pulse_duration = response.records.data.local_outbound_pulse_duration;
                   $scope.ctnumbersData.local_outbound_pulse_rate = response.records.data.local_outbound_pulse_rate;
                   $scope.ctnumbersData.isd_outbound_pulse_duration = response.records.data.isd_outbound_pulse_duration;
                   $scope.ctnumbersData.isd_outbound_pulse_rate = response.records.data.isd_outbound_pulse_rate;
                   $scope.ctnumbersData.dial_outbound_callas = response.records.data.dial_outbound_callas;
                   $scope.ctnumbersData.activation_date = response.records.data.activation_date;
                   $scope.ctnumbersData.rent_amount = response.records.data.rent_amount;
                   $scope.ctnumbersData.number_status = response.records.data.number_status;
                  
                } else if(response.success == false) {
                    
                }
            });
            
        }
        
        
     
        
}]);
app.controller('ctnumberstatusctrl',['$scope', 'Data', 'toaster','$rootScope','Upload','$state','$timeout', function ($scope, Data,toaster,$rootScope,Upload,$state,$timeout) {
         
            Data.get('getctnumbersstatus').then(function (response) {
                if (response.success) {
                     $scope.numberstatuslist = response.records;
                } else {
                    $scope.errorMsg = response.message;
                }
            })
    
}]);

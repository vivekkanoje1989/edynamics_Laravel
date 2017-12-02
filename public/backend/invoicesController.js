'use strict';
app.controller('invoicesController', ['$scope', 'Data', 'toaster','$rootScope','Upload','$state','$timeout', function ($scope, Data,toaster,$rootScope,Upload,$state,$timeout) {
      
      $scope.currentPage =  $scope.itemsPerPage = 30;
        $scope.clientsServiceList = {};
        $scope.clientsInvoiceList = {};
        $scope.noOfRows = 1;
        $scope.totalrecords;
        $scope.generateData = {};
     
        
        $scope.manageClientInvoices = function (client_id){
            Data.post('invoices/manageClientInvoices',{
                         client_id: client_id,
                }).then(function (response) {
                    $scope.clientsInvoiceList = response.records;
                    $scope.totalrecords = response.count;
                    $scope.clientName = response.clientName;
                
            });
        }
        
        
        $scope.regenerateInvoice = function (generateData){
            Data.post('clients/regenerateInvoice',{
                         invoiceData: generateData,
                }).then(function (response) {
                     $('#generateInvoiceModal').modal('toggle');
                    if (response.success) {
                        var successMsg = response.message;
                        toaster.pop('success', 'Invoice Regenerated Status', successMsg);
                        $scope.generateData = {};
                        $scope.Savebtn = false;
                    } else {
                        var errorMsg = response.message;
                        toaster.pop('error', 'Invoice Regenerated Status', errorMsg);
                    }
                
            });
        }
        
        $scope.initialRegenerateInvoiceModal = function(invoice_id)
        {
            Data.post('clients/getinvoicedetails',{
                         invoice_id: invoice_id,
                }).then(function (response) {
                    if(response.success){
                        $scope.generateData.invoice_date = response.records.invoice_date;
                        $scope.generateData.start_date = response.records.from_date;
                        $scope.generateData.end_date = response.records.to_date;
                        $scope.generateData.company_id = response.records.company_id;
                        $scope.generateData.client_id = response.records.client_id;
                        $scope.generateData.invoice_id = invoice_id;
                        Data.post('clients/getClientfirmpartners',{
                                        clientId:$scope.generateData.client_id
                                }).then(function (response) {
                                   if(response.status){

                                        $scope.firmspartnerslist = response.records;
                                    }else
                                    {
                                        $scope.firmspartnerslist = '';
                                    }
                                });
                    }
                });
        }
        
       $scope.pageChangeHandler = function (num) {
            console.log(num);
            $scope.noOfRows = num;
            $scope.currentPage = num * $scope.itemsPerPage;
        };
        
        
}]);

app.controller('companyListingCtrl', function ($scope, Data) {
    $scope.channellist = [];
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
});

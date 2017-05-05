'use strict';
app.controller('adminController', function ($rootScope, $scope, $state, Data) {
    $scope.registration = {};
    $scope.errorMsg = '';

    $scope.checkUsername = function (usernameData) {
        Data.post('checkUsername', {
            username: usernameData.mobile,
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.successMsg = response.message;
            }
        });
    }
    $scope.resetErrorMsg = function () {
        $scope.errorMsg = '';
    }
    $scope.login = function (loginData) {
        Data.post('authenticate', {
            username: loginData.mobile, password: loginData.password,
        }).then(function (response) {
            if (response.success) {
                $state.reload();
                $state.go(getUrl + '.dashboard');
                return false;
            } else {
                $scope.errorMsg = response.message;
            }
        });
    };
    $scope.logout = function (logoutData) {
        Data.post('logout', {
            data: logoutData
        }).then(function (response) {
            if (response.success) {
                $rootScope.authenticated = false;
                $state.go('login');
            } else {
                $scope.errorMsg = response.message;
            }
        });
    }
    $scope.signUp = function (registerationData) {
        Data.post('saveRegister', {
            data: registerationData
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $state.go('login');
                $state.reload();
            }
        });
    };
    $scope.sendResetLink = function (sendEmailData) {
        Data.post('password/email', {
            data: sendEmailData
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.successMsg = response.message;
            }
        });
    }
    $scope.resetPassword = function (resetData) {
        Data.post('password/reset', {
            data: resetData
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $state.go(getUrl + '.dashboard');
            }
        });
    }

    $rootScope.alert = function (type, msg) {
        $rootScope.message = [];
        $rootScope.message.push(msg);
        $rootScope.alerts = {
            class: type,
            messages: $rootScope.message
        }
    }
});
app.controller('salesEnqCategoryCtrl', function ($scope, Data) {
    Data.get('getSalesEnqCategory').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.salesEnqCategoryList = response.records;
        }
    });
});
app.controller('projectCtrl', function ($scope, Data) {
    Data.get('getProjects').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.projectList = response.records;
        }
    });
});
app.controller('companyCtrl', function ($scope, Data) {
    Data.get('getCompany').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.firmPartnerList = response.records;
        }
    });
});
app.controller('stationaryCtrl', function ($scope, Data) {
    Data.get('getStationary').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.stationaryList = response.records;
        }
    });
});
app.controller('titleCtrl', function ($scope, Data) {
    Data.get('getTitle').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.titles = response.records;
        }
    });
});
app.controller('genderCtrl', function ($scope, Data) {
    Data.get('getGender').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.genders = response.records;
        }
    });
}); 
app.controller('bloodGroupCtrl', function ($scope, Data) {
    Data.get('getBloodGroup').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.bloodGroups = response.records;
        }
    });
});
app.controller('professionCtrl', function ($scope, Data) {
    Data.get('getProfessionList').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.professions = response.records;
        }
    });
});
app.controller('departmentCtrl', function ($scope, Data, $timeout) {
    $scope.departments = [];
    var empId = $("#empId").val();
    if (empId === "0") {

        Data.get('getDepartments').then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.departments = response.records;
            }
        });
    } else {
        $timeout(function () {
            Data.post('master-hr/editDepartments', {data: empId}).then(function (response) {
                if (!response.success) {
                    $scope.errorMsg = response.message;
                } else {
                    $scope.departments = response.records;
                }
            });
        }, 3000);
    }
});

app.controller('designationCtrl', function ($scope, Data) {
    Data.get('getDesignations').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.designationList = response.records;
        }
    });
});
app.controller('educationListCtrl', function ($scope, Data) {
    Data.get('getEducationList').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.educationList = response.records;
        }
    });
});
app.controller('blockTypeCtrl', function ($scope, Data) {
    $scope.blockTypeList = [];
    $scope.subBlockList = [];
    Data.get('getBlockTypes').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.blockTypeList = response.records;
        }
    });
    $scope.checkBlockLength = function () { 
        var blockTypeId = [];
        angular.forEach($scope.enquiryData.block_id, function(value, key){
            blockTypeId.push(value.id);
        });
        var myJsonString = JSON.stringify(blockTypeId);
        console.log(myJsonString);
        if ($scope.enquiryData.block_id.length === 0) {
            $scope.emptyBlockId = true;
            $scope.applyClassBlock = 'ng-active';
         } else {
            $scope.emptyBlockId = false;
            $scope.applyClassBlock = 'ng-inactive';
             
            Data.post('getSubBlocks/',{
                data: {myJsonString}
            }).then(function (response) {
                if (!response.success) {
                    $scope.errorMsg = response.message;
                } else {
                    $scope.subBlockList = response.records;
                    console.log($scope.subBlockList);
                }
            });
         }
    }; 
});

app.controller('currentCountryListCtrl', function ($scope, Data) {
    
    $scope.country_id;
    
    
    Data.get('getCountries').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.countryList = response.records;
        }
    });
    $scope.onCountryChange = function () {//for state list
        $scope.stateList = "";
        
        Data.post('getStates', {
            data: {countryId: $scope.country_id },
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.stateList = response.records;
            }
        });
    };
    $scope.onStateChange = function () {//for city list
        $scope.cityList = "";
        Data.post('getCities', {
            data: {stateId: $("#current_state_id").val()},
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.cityList = response.records;
            }
        });
    };
    $scope.onCityChange = function () { //for location list
        $scope.locationList = "";
        Data.post('getLocations', {
            data: {countryId: $("#current_country_id").val(),stateId: $("#current_state_id").val(),cityId: $("#current_city_id").val()},
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.locationList = response.records;
            }
        });
    };
});

app.controller('permanentCountryListCtrl', function ($scope, $timeout, Data) {
    Data.get('getCountries').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.countryList = response.records;
        }
    });

    $scope.onPCountryChange = function () {
        $scope.stateList = "";
        Data.post('getStates', {
            data: {countryId: $scope.userData.permenent_country_id},
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.stateList = response.records;
            }
        });
    };
    $scope.onPStateChange = function () {
        $scope.cityList = "";
        Data.post('getCities', {
            data: {stateId: $scope.userData.permenent_state_id},
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.cityList = response.records;
            }
        });
    };

    $scope.checkboxSelected = function (copy) {
        if (copy) {  // when checked
            $scope.userData.permenent_address = angular.copy($scope.userData.current_address);
            $scope.userData.permenent_country_id = angular.copy($scope.userData.current_country_id);
            $scope.userData.permenent_pin = angular.copy($scope.userData.current_pin);

            Data.post('getStates', {
                data: {countryId: $scope.userData.current_country_id},
            }).then(function (response) {
                if (!response.success) {
                    $scope.errorMsg = response.message;
                } else {
                    $scope.stateList = response.records;
                    Data.post('getCities', {
                        data: {stateId: $scope.userData.current_state_id},
                    }).then(function (response) {
                        if (!response.success) {
                            $scope.errorMsg = response.message;
                        } else {
                            $scope.cityList = response.records;
                        }
                        $timeout(function () {
                            $("#permenent_state_id").val($scope.userData.current_state_id);
                            $("#permenent_city_id").val($scope.userData.current_city_id);
                            $scope.userData.permenent_state_id = angular.copy($scope.userData.current_state_id);
                            $scope.userData.permenent_city_id = angular.copy($scope.userData.current_city_id);
                        }, 500);
                    });
                }
            });
        } else {
            $scope.userData.permenent_address = $scope.userData.permenent_country_id = $scope.userData.permenent_state_id = $scope.userData.permenent_city_id = $scope.userData.permenent_pin = "";
        }
    };
});

app.controller('enquirySourceCtrl', function ($scope, Data) {
    Data.get('getEnquirySource').then(function (response){
        $scope.sourceList = '';
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.sourceList = response.records;
        }
    });
    $scope.onEnquirySourceChange = function (sourceId){
        Data.post('getEnquirySubSource', {
        data: {sourceId: sourceId}}).then(function (response){
            $scope.subSourceList = '';
            if (!response.success){
                $scope.errorMsg = response.message;
            } else{
                $scope.subSourceList = response.records;
            }
        });
    };
});

/****************************UMA************************************/
app.controller('webPageListCtrl', function ($scope, Data) {
   Data.get('getWebPageList').then(function (response) {
       if (!response.success) {
           $scope.errorMsg = response.message;
       } else {
           $scope.listPages = response.records;
       }
   });
});
app.controller('verticalCtrl', function ($scope, Data) {
    Data.get('getVerticals').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.verticals = response.records;
        }
    });
}); 
/****************************UMA************************************/
/****************************MANDAR*********************************/
app.controller('employeesCtrl', function ($scope, Data) {
    $scope.employeeList = [];
    Data.get('getEmployees').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.employeeList = response.records;
        }
    });
});

app.controller('clientCtrl', function ($scope, Data) {
    Data.get('getClient').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.clients = response.records;
        }
    });
});

app.controller('vehiclebrandCtrl', function ($scope, Data) {
    Data.get('getVehiclebrands').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.vehiclebrands = response.records;
        }
    });
});

app.controller('vehiclemodelCtrl', function ($scope, Data) {
    Data.get('getVehiclemodels').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.vehiclemodels = response.records;
        }
    });
});

/*Rohit*/

app.controller('CountryListCtrl', function ($scope, Data) {
    
    $scope.country_id;
    $scope.state_id;
    
    $scope.$on('countryEvent',function(value,args){
            $scope.onCountryChange(args);
    });
   
   $scope.$on('stateEvent',function(value,args){
            $scope.onStateChange(args);
    });
   
    Data.get('getCountries').then(function (response) {
        if (!response.success) {
            $scope.errorMsg = response.message;
        } else {
            $scope.countryList = response.records;
        }
    });
    $scope.onCountryChange = function (args = 0) {//for state list
        $scope.stateList = "";
        
        if(args ==0)
            $scope.country_id = $("#country_id").val();
        else
            $scope.country_id = args;
        
        Data.post('getStates', {
            data: {countryId: $scope.country_id },
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.stateList = response.records;
            }
        });
    };
    
    $scope.onStateChange = function (args = 0) {//for city list
        $scope.cityList = "";
        
        if(args ==0)
            $scope.state_id = $("#state_id").val();
        else
            $scope.state_id = args;
        
        Data.post('getCities', {
            data: {stateId: $scope.state_id},
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.cityList = response.records;
            }
        });
    };
    $scope.onCityChange = function () { //for location list
        $scope.locationList = "";
        Data.post('getLocations', {
            data: {countryId: $("#current_country_id").val(),stateId: $("#current_state_id").val(),cityId: $("#current_city_id").val()},
        }).then(function (response) {
            if (!response.success) {
                $scope.errorMsg = response.message;
            } else {
                $scope.locationList = response.records;
            }
        });
    };
});

/****************************MANDAR*********************************/

//$(document).ready(function() {
//    $(document).on("contextmenu",function(e){
//       return false;
//    }); 
//});
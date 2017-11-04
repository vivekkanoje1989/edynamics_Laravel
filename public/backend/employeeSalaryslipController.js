app.controller('employeeSalaryslipController', ['$scope', '$state', '$stateParams', 'Data', 'Upload', 'toaster', '$timeout', '$http', function($scope, $state, $stateParams, Data, Upload, toaster, $timeout, $http) {
    //vloader
    $scope.vloader = false;
    //check if user wants to upload file
    $scope.salaryslip = 0;
    $scope.showDiv = false; //if value true then shows div
    $scope.extention = false; //to check extenstion of file

    //initialise months dropdown
    var date = new Date();
    $scope.monthdrpdn = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    //get current month
    $scope.crntmnth = date.getMonth();

    $scope.fileData = {};
    $scope.fileData.year = date.getFullYear();
    $scope.fileData.month = $scope.monthdrpdn[$scope.crntmnth];

    //close and open div as per permissionzip
    $scope.permissionzip = function(salaryslip) {
        if (salaryslip == "Individual") {
            $scope.showDiv = "Individual";
        } else if (salaryslip == "Bulk") {
            $scope.showDiv = "Bulk";
        } else {
            $scope.showDiv = "";
        }
    }

    //viveknk to catch zip file helps directive ngFiles
    var formdata = new FormData();
    $scope.getTheFiles = function($files) {
        angular.forEach($files, function(value, key) {
            console.log("fileskey showDiv getTheFiles=" + $scope.showDiv);
            // console.log("filesvalue=" + value.name);
            // console.log("fileskey=" + key);
            if ($scope.showDiv == "Bulk") {
                // console.log("fileskey showDiv if=" + $scope.showDiv);                

                str = value.name;
                str.toString();
                var l = (str.split('.').length) - 1;
                // console.log("str=" + str.split('.').length);
                // console.log("str end=" + str.split('.')[l]);
                var ext = str.split('.')[l];
                $scope.extention = ext.toString();
            } else if ($scope.showDiv == "Individual") {
                // console.log("fileskey showDiv else=" + $scope.showDiv);           

                str = value.name;
                str.toString();
                var l = (str.split('.').length) - 1;
                // console.log("str=" + str.split('.').length);
                // console.log("str end=" + str.split('.')[l]);
                var ext = str.split('.')[l];
                $scope.extention = ext.toString();

            } else {}
            formdata.append(key, value);
        });
    };

    // NOW UPLOAD THE FILES.
    $scope.uploadFiles = function(mnthData) {
        console.log("month" + JSON.stringify(mnthData));
        $scope.vloader = true;

        if ($scope.showDiv == "Bulk") {
            if ($scope.extention == "zip") {
                // console.log("chkfile" + $scope.chkfile);
            } else {
                toaster.pop('warning', 'Employee Salary Slip', 'Please! Choose zip file');
                $scope.vloader = false;
                return false;
            }
        } else if ($scope.showDiv == "Individual") {
            if ($scope.extention == "pdf") {
                // console.log("chkfile" + $scope.chkfile);
            } else {
                toaster.pop('warning', 'Employee Salary Slip', 'Please! Choose pdf file');
                $scope.vloader = false;
                return false;
            }
        } else {}

        if (mnthData.month) {
            console.log("month" + JSON.stringify(mnthData.month));
        } else {
            toaster.pop('warning', 'Employee Salary Slip', 'Please! Select Month');
            $scope.vloader = false;
            return false;
        }

        if (mnthData.remark) {
            // console.log("remark" + JSON.stringify(mnthData.remark));
        } else {
            toaster.pop('warning', 'Employee Salary Slip', 'Please! Give Remark.');
            $scope.vloader = false;
            return false;
        }

        mnthData.option = $scope.showDiv;
        //appent exta form data to file object
        $scope.datamnt = JSON.stringify(mnthData);
        formdata.append('extaData', $scope.datamnt);

        //initialize request object
        var request = {
            method: 'POST',
            url: '/employeeSalaryslip/uploadzip',
            // data: formdata,
            headers: {
                'Content-Type': undefined
            },
            data: formdata
        };

        // SEND THE FILES.
        $http(request)
            .success(function(response) {

                if (response.success) {
                    $scope.fileData.month = $scope.monthdrpdn[$scope.crntmnth];
                    $scope.fileData.remark = "";
                    document.getElementById('file1').value = ''
                    $scope.vloader = false;
                    toaster.pop('success', 'Employee Salary Slip', response.message);
                } else {
                    $scope.vloader = false;
                    toaster.pop('error', 'Employee Salary Slip', response.message);
                }
            });
        // .error(function(err) {
        //     toaster.pop('error', 'Salary Slips', err);
        // });
    }

    // $scope.myslrslips = '';
    $scope.itemsPerPage = 30;
    $scope.pageNumber = 1;
    $scope.noOfRows = 1;

    $scope.pageChanged = function(pageNo, functionName, id) {
        $scope.itemsPerPage = parseInt($scope.itemsPerPage);
        pageNo = parseInt(pageNo);
        $scope[functionName](id, pageNo, $scope.itemsPerPage);
        $scope.pageNumber = pageNo;
    };

    $scope.searchDetails = {};
    $scope.searchData = {};

    $scope.filterDetails = function(search) {
        //$scope.searchDetails = {};
        $scope.searchData = search;
        $('#showFilterModal').modal('hide');
    }
    $scope.removeFilterData = function(keyvalue) {
        delete $scope.searchData[keyvalue];
        $scope.filterDetails($scope.searchData);
    }
    $scope.closeModal = function() {
        $scope.searchData = {};
    }

    //viveknk for itemperpage model dropdown
    $scope.itemsPerPageModel = [1, 30, 100, 200, 300, 400, 500, 600, 700, 800, 900, 999];

    $scope.initialModal = function() {

        var year = new Date().getFullYear();
        var range = [];
        range.push(year);
        for (var i = 1; i < 7; i++) {
            range.push(year + i);
        }
        $scope.modelyears = range;
        // console.log('modelyears=' + $scope.modelyears);

        $scope.heading = 'Download Salary Slip ZIP';
        $scope.action = "Generate";
        $scope.domethod = 'post';
        $scope.downloadfile = false;
    }


    //get all employee salaryslips
    $scope.getMySalaryslips = function() {
        Data.get('/employeeSalaryslip/getMySalaryslips').then(function(response) {
            $scope.myslrslips = response.records;
            // console.log("myslrslips=" + JSON.stringify($scope.myslrslips));
        });
    }

    $scope.downloadfile = false; //hide download zip file button in model

    $scope.doSalayslipAction = function() {
        $scope.downloadfile = false;
        // console.log('doSalayslipAction zipyear=' + $scope.zipyear);

        // var config = {
        //     headers: {
        //         'Accept': "image/jpeg"
        //     }
        // };
        // filename = "1506601910_1870.jpg";
        // $http.get('https://storage.googleapis.com/edynamicsdevelopment/employee-photos/' + filename, config).then(function(response) {
        //     var myBuffer = new Uint8Array(response.data);

        //     var data = new Blob([myBuffer], { type: 'image/jpeg;charset=UTF-8' });
        //     FileSaver.saveAs(data, 'myimage/v.jpg');
        // })

        if ($scope.domethod == 'post') {
            Data.post('/employeeSalaryslip/downloadSalaryslipsZip', {
                year: $scope.zipyear
            }).then(function(response) {
                // response = json_decode(response);
                if (response.success) {
                    toaster.pop('success', 'My Salary Slips', response.message);
                    $scope.downloadfile = true;
                } else {
                    $scope.errorMsg = response.message;
                    $scope.downloadfile = false;
                }
            });
        } else { console.log("domethod"); }

    }

    $scope.dwnzip = function() {
        $('#salayslipModal').modal('toggle');
    }

    $scope.OrderRec = '-id';
    //dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'Year') {
            // alert($scope.OrderRec);
            if ($scope.OrderRec == 'year') {
                $scope.OrderRec = '-year';
            } else if ($scope.OrderRec == '-year') {
                $scope.OrderRec = 'year';
            } else {
                $scope.OrderRec = 'year';
            }
        } else if (sort == 'Month') {
            if ($scope.OrderRec == 'month') {
                $scope.OrderRec = '-month';
            } else if ($scope.OrderRec == '-month') {
                $scope.OrderRec = 'month';
            } else {
                $scope.OrderRec = 'month';
            }
        }
    }

    $scope.pageChangeHandler = function(num) {
        $scope.itemsPerPage = parseInt($scope.itemsPerPage);
        $scope.noOfRows = parseInt(num);
        $scope.currentPage = num * $scope.itemsPerPage;
    };

    //viveknk call to dashboard
    $scope.goDashboard = function() {
        $state.go('dashboard');
    };

    //viveknk call to dashboard
    $scope.goSalaryslip = function() {
        $state.go('employeeSalaryslip');
    };

}]);

//this directive is defined to catch zip file
app.directive('ngFiles', ['$parse', function($parse) {

    function fn_link(scope, element, attrs) {
        var onChange = $parse(attrs.ngFiles);
        element.on('change', function(event) {
            onChange(scope, { $files: event.target.files });
        });
    };

    return {
        link: fn_link
    }
}]);

// app.directive('yearSelect', function() {
//     var currentYear = new Date().getFullYear();
//     return {
//         restrict: 'AE',
//         replace: true,
//         scope: {},
//         template: '<select ng-options="y for y in years"></select>',
//         controller: ["$scope", "$element", "$attrs", function(scope, element, attrs) {

//             scope.years = [];
//             for (var i = (attrs.offset * 1); i < (attrs.range * 1) + 1; i++) {
//                 scope.years.push(currentYear + i);
//             }
//             // $scope.selected = moment().year();
//         }]
//     }
// });
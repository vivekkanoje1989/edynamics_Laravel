app.controller('employeeSalaryslipController', ['$scope', 'Data', 'Upload', 'toaster', '$timeout', '$http', function($scope, Data, Upload, toaster, $timeout, $http) {
    //vloader
    $scope.vloader = false;
    //check if user wants to upload file
    $scope.salaryslip = 0;
    $scope.showDiv = false; //if value true then shows div
    $scope.chkfile = false; //if value true zip file is selected

    //initialise months dropdown
    var date = new Date();
    $scope.monthdrpdn = [
        "Jan" + date.getFullYear(),
        "Feb" + date.getFullYear(),
        "Mar" + date.getFullYear(),
        "Apr" + date.getFullYear(),
        "May" + date.getFullYear(),
        "Jun" + date.getFullYear(),
        "Jul" + date.getFullYear(),
        "Aug" + date.getFullYear(),
        "Sep" + date.getFullYear(),
        "Oct" + date.getFullYear(),
        "Nov" + date.getFullYear(),
        "Dec" + date.getFullYear()
    ];

    //close and open div as per permissionzip
    $scope.permissionzip = function() {
        if ($scope.showDiv == false) {
            $scope.showDiv = true;
        } else if ($scope.showDiv == true) {
            $scope.showDiv = false;
        } else {
            $scope.showDiv = false;
        }
    }

    //viveknk to catch zip file helps directive ngFiles
    var formdata = new FormData();
    $scope.getTheFiles = function($files) {
        angular.forEach($files, function(value, key) {
            console.log("filesvalue=" + value.name);
            console.log("fileskey=" + key);

            if (!value.name) {
                toaster.pop('warning', 'Employee Salary Slip', 'Please! Choose zip file');
            } else {
                $scope.chkfile = true;
                str = value.name;
                str.toString();
                var l = (str.split('.').length) - 1;
                console.log("str=" + str.split('.').length);
                console.log("str end=" + str.split('.')[l]);
                var ext = str.split('.')[l];

                if (ext.toString() == 'zip') {} else {
                    console.log("str=" + ext);
                    toaster.pop('warning', 'Employee Salary Slip', 'Please! Choose file with .zip extention');
                }
            }

            formdata.append(key, value);
        });
    };

    // NOW UPLOAD THE FILES.
    $scope.uploadFiles = function(mnthData) {
        // console.log("month" + JSON.stringify(mnthData));
        $scope.vloader = true;

        if ($scope.chkfile) {
            // console.log("chkfile" + $scope.chkfile);
        } else {
            toaster.pop('warning', 'Employee Salary Slip', 'Please! Choose zip file');
            $scope.vloader = false;
            return false;
        }

        if (mnthData.month) {
            // console.log("month" + JSON.stringify(mnthData.month));
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
                    $scope.fileData.month = "";
                    $scope.fileData.remark = "";
                    // document.getElementById('file1').value = ''
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
    //get all employee salaryslips
    $scope.getMySalaryslips = function() {
        Data.get('/employeeSalaryslip/getMySalaryslips').then(function(response) {
            $scope.myslrslips = response.records;
            // console.log("myslrslips=" + JSON.stringify($scope.myslrslips));
        });
    }

    $scope.OrderRec = '-id';
    //dynamic orderby function
    $scope.OrderFunction = function(sort) {
        if (sort == 'SalarySlip') {
            if ($scope.OrderRec == 'salaryslip_docName') {
                $scope.OrderRec = '-salaryslip_docName';
            } else if ($scope.OrderRec == '-salaryslip_docName') {
                $scope.OrderRec = 'salaryslip_docName';
            } else {
                $scope.OrderRec = 'salaryslip_docName';
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
}])
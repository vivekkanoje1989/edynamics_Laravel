app.controller('DatepickerDemoCtrl', function($scope, $filter) {
    var today = new Date();
    today.setMonth(today.getMonth());

    $scope.maxDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());
    $scope.today = function() {
        $scope.dt = new Date();
    };
    $scope.today();

    $scope.clear = function() {
        $scope.dt = null;
    };

    // Disable weekend selection
    $scope.disabled = function(date, mode) {
        return (mode === 'day' && (date.getDay() === 0 || date.getDay() === 6));
    };

    $scope.toggleMin = function() {
        $scope.minDate = $scope.minDate ? null : new Date();
    };
    $scope.toggleMin();

    //  $scope.open = function($event) {
    //    $event.preventDefault();
    //    $event.stopPropagation();
    //
    //    $scope.opened = true;
    //  };



    $scope.open = function($event, type) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.opened = true;
        if (type == 1) {
            var date_of_birth = ($scope.maxDates.getFullYear() + '-' + ("0" + ($scope.maxDates.getMonth() + 1)).slice(-2) + '-' + $scope.maxDates.getDate());
            $scope.userData.birth_date = date_of_birth;
        }

        if (type == 2) {
            if ($scope.userPersonalData.birth_date == '' || $scope.userPersonalData.birth_date == '0000-00-00') {
                var date_of_birth = ($scope.maxDates.getFullYear() + '-' + ("0" + ($scope.maxDates.getMonth() + 1)).slice(-2) + '-' + $scope.maxDates.getDate());
                $scope.userPersonalData.birth_date = date_of_birth;
            }
        }

        //for task management
        if (type == 3) {
            if ($scope.taskthreeData.issued_date == '' || $scope.taskthreeData.issued_date == '0000-00-00') {
                var issued_date = ($scope.maxDates.getFullYear() + '-' + ("0" + ($scope.maxDates.getMonth() + 1)).slice(-2) + '-' + $scope.maxDates.getDate());
                $scope.taskthreeData.issued_date = issued_date;
            }
        }

        if (type == 4) {
            if ($scope.taskthreeData.estimated_date == '' || $scope.taskthreeData.estimated_date == '0000-00-00') {
                var estimated_date = ($scope.maxDates.getFullYear() + '-' + ("0" + ($scope.maxDates.getMonth() + 1)).slice(-2) + '-' + $scope.maxDates.getDate());
                $scope.taskthreeData.estimated_date = estimated_date;
            }
        }

        if (type == 5) {
            if ($scope.taskfourData.completion_date == '' || $scope.taskfourData.completion_date == '0000-00-00') {
                var completion_date = ($scope.maxDates.getFullYear() + '-' + ("0" + ($scope.maxDates.getMonth() + 1)).slice(-2) + '-' + $scope.maxDates.getDate());
                $scope.taskfourData.completion_date = completion_date;
            }
        }
    };
    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy-MM-dd', 'dd.MM.yyyy', 'shortDate'];
    $scope.format = $scope.formats[1];

});
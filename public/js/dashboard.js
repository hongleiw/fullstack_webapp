app = angular.module('SampleCodeHonglei',['ngFileUpload','ui.router', 'ngMaterial'], ['$httpProvider', function($httpProvider) {
    //Setting headers
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $httpProvider.defaults.headers.common['X-Requested-With'] = "XMLHttpRequest";
    $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=_token]').attr('content');
}]);
/*
 * Dynamic load subpage
 *
 */
app.config(function($stateProvider, $urlRouterProvider) {
	$stateProvider
		.state('Dashboard', {
			url: "",
			template: "Please first add Employee and then filter employee!"
		})

		.state('filterEmployee', {
			url: "/filteremployee",
			templateUrl: "../html/filteremployee.html",
			controller: function($scope, $rootScope, $location, $http) {
            	// model for bs-table
            	$scope.gender_choice = ["Male","Female"];
            	$scope.contactList = [];

            	var request = $http({
            		method: 'Get',

            		url: 'employees',

            	});

            	request.success(function(data, status) {
            		if(status == '200') {
            			$scope.contactList = data;
            		}
            	})
        	}
		})

		.state('batchAdd', {
			url: "/batchAdd",
			templateUrl: "../html/batchAdd.html"
		})

});

/*
 * Custom filter to filter cards array. If employee has any cards matches, show this employee 
 *
 */
app.filter('filtercard', function () {
    return function (input,s_card_number) {
        if(s_card_number == undefined){
            return input;
        }
        console.log(input);
        console.log(s_card_number);
        var output = [];
        angular.forEach(input, function (item) {
            for(var i=0;i<item.card_numbers.length;i++){
                card = item.card_numbers[i];
                if( card.substring(0,s_card_number.length) == s_card_number) {
                    output.push(item);
                    break;
                }
            }
            
            
        });
        return output;
    }
});
/*
 * Upload Controller
 *
 */
app.controller('uploadFileCtrl', ['$scope', 'Upload', '$timeout', function($scope, Upload, $timeout) {
    $scope.uploadFile = function(file) {
        console.log(file);
        console.log(file.name.split('.')[1]);
        if(file.name.split('.').length>1&&file.name.split('.')[1]!="csv") {
            $scope.errorMsg = "Error" + ': ' + "File format is not supported";
            return;
        }
        file.upload = Upload.upload({
            url: '../employees/batchadd',
            data: {file:file},
        });
        file.upload.then(function(response){
            $timeout(function() {
                file.result = response.data;
            });

        }, function(response) {
            if(response.status>0){
                $scope.errorMsg = response.status + ': ' + response.data;
            }
        }, function(evt) {
            file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    }
}]);
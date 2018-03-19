'use strict';
var pokerInsuranceApp = angular.module("pokerInsuranceApp", ['ngRoute', 'ngCookies']);
pokerInsuranceApp.config(function($routeProvider){
	$routeProvider.when("/",{
		templateUrl: function(params) {
			return 'views/Insurance.html';
		},
		controller: 'InsuranceCount'
    }).otherwise({redirectTo : '/'})
});
var InsuranceCount = function($scope,$routeParams )
{
	$scope.input ={};
	$scope.odds={
		'1' :36,
		'2' :18,
		'3' :12,
		'4' :8.5,
		'5' :6.5,
		'6' :5.5,
		'7' :4.5,
		'8' :3.8,
		'9':3.3,
		'10' :2.8,
		'11' :2.5,
		'12' :2.2,
		'13' :2,
		'14' :1.8,
		'15' :1.5,
		'16' :1.4,
		'17' :1.3,
		'18' :1.2,
		'19' :1.1,
		'20' :1,
	}
	
	$scope.$watch('input.pot', function(newValue, oldValue) {
		if(typeof newValue !="undefined")
		{
			
			$scope.input.i_maximum =  newValue/$scope.odds[$scope.input.outs];
			$scope.input.percentage50 =  newValue/2/$scope.odds[$scope.input.outs];
		}
	});
	
	
	$scope.$watch('input.outs', function(newValue, oldValue)
	{
		if(typeof newValue !="undefined" && typeof $scope.input.pot !="undefined")
		{
			$scope.input.i_maximum =  newValue/$scope.odds[$scope.input.outs]
			$scope.input.percentage50 =  newValue/2/$scope.odds[$scope.input.outs]
		}
	});
}
pokerInsuranceApp.controller('InsuranceCount',  ['$scope' ,'$routeParams', InsuranceCount]);
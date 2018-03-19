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
var InsuranceCount = function($scope,$routeParams,apiService )
{
	$scope.ajaxload = false;
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
			
			$scope.input.i_maximum =Math.floor(newValue/$scope.odds[$scope.input.outs]*10)/10;
			$scope.input.percentage50 =  Math.floor(newValue/2/$scope.odds[$scope.input.outs]*10)/10;
		}
		
	});
	
	
	$scope.$watch('input.outs', function(newValue, oldValue)
	{
		if(typeof newValue !="undefined" && typeof $scope.input.pot !="undefined")
		{
			$scope.input.i_maximum =  Math.floor(newValue/$scope.odds[$scope.input.outs]*10)/10;
			$scope.input.percentage50 =  Math.floor(newValue/2/$scope.odds[$scope.input.outs]*10)/10;
		}
	});
	
	$scope.$watch('input.amount', function(newValue, oldValue)
	{
		if(typeof newValue !="undefined" && newValue !=null)
		{
			if(newValue >$scope.input.i_maximum)
			{
				$scope.input.amount = oldValue;	
				var obj =
				{
					'message' :'超出购卖额度上限/over maximum',
				};
				dialog(obj);
			}else
			{
				$scope.input.payamount=newValue*$scope.odds[$scope.input.outs];
			}
		}

	});
	
	$scope.save = function()
	{
		if($scope.input.amount >$scope.input.i_maximum)
		{
			var obj =
			{
				'message' :'超出购卖额度上限/over maximum',
			};
			dialog(obj);
		}
		
		if($scope.ajaxload == true)
		{
			$scope.input.amount = oldValue;	
			var obj =
			{
				'message' :'系统忙禄中/system busy',
			};
			dialog(obj);
		}
		$scope.ajaxload = true;		
		var obj = $scope.input;
		var promise = apiService.adminApi('/Api/HdPokerInsurance/insert', obj);
		promise.then
		(
			function(r) 
			{
				$scope.ajaxload = false;
				if(r.data.status =="200")
				{
					console.log(r);
				
				}else
				{
					var obj =
					{
						'message' :r.data.message,
					};
					dialog(obj);
				}
				
			},
			function() {
				$scope.ajaxload = false;
				var obj ={
					'message' :'system error'
				};
				dialog(obj);
			}
		)
		
	}
	
	$scope.step2 = function()
	{
		$(window).scrollTop(0);
		$scope.step =2;
	}
}
pokerInsuranceApp.controller('InsuranceCount',  ['$scope' ,'$routeParams', 'apiService', InsuranceCount]);


var apiService = function($http,$cookies)
{
	return {
		adminApi :function(apiurl, obj)
		{
			var default_obj = 
			{
			
			};
			var object = $.extend(default_obj, obj);
			return $http.post(apiurl , object,  {headers: {'Content-Type': 'application/json'}});
		}
    };
}
pokerInsuranceApp.factory('apiService', ['$http','$cookies', apiService]);
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
	};
	
	$scope.init = function()
	{
		if($scope.ajaxload == true)
		{
			var obj =
			{
				'message' :'系统忙禄中/system busy',
			};
			dialog(obj);
			return false;
		}
		$scope.ajaxload = true;
		$scope.input.odds = $scope.odds[$scope.input.outs];		
		var obj = {};
		var promise = apiService.Api('/Api/HdPokerInsurance/getOdds', obj);
		promise.then
		(
			function(r) 
			{
				
				$scope.ajaxload = false;
				if(r.data.status =="200")
				{
					$scope.step=1;
					$scope.odds = r.data.body.odds;
					window.scrollTo(0,0);
				
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
	
	$scope.$watch('input.pot', function(newValue, oldValue) {
		if(typeof newValue !="undefined")
		{
			$scope.input.i_maximum =Math.floor(newValue/$scope.odds[$scope.input.outs]*10)/10;
			$scope.input.percentage50 =  Math.floor(newValue/2/$scope.odds[$scope.input.outs]*10)/10;
			$scope.input.amount = $scope.input.i_maximum;
		}
		
	});
	// $scope.step=2;
	
	$scope.check_user_code = function()
	{
		if(typeof $scope.input.ucode.length=="undefined" && $scope.input.ucode.length != 6)
		{
			return false;
		}
		
		if(typeof $scope.input.ucode =="undefined" || $scope.input.ucode =="")
		{
			return false;
		}
		if($scope.ajaxload == true)
		{
			var obj =
			{
				'message' :'系统忙禄中/system busy',
			};
			dialog(obj);
			return false;
		}
		$scope.ajaxload = true;		
		var obj = $scope.input;
		var promise = apiService.Api('/Api/HdPokerInsurance/chenkUserCode', obj);
		promise.then
		(
			function(r) 
			{
				$scope.ajaxload = false;
				if(r.data.status =="200")
				{
					$scope.checkvcode =r.data.body.check;
				
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
	
	$scope.$watch('input.outs', function(newValue, oldValue)
	{
		
		if(newValue >20)
		{
			$scope.input.outs = oldValue;
			return false;
		}
		
		
		if(typeof newValue !="undefined" && typeof $scope.input.pot !="undefined")
		{
			
			$scope.input.i_maximum =  Math.floor($scope.input.pot/$scope.odds[$scope.input.outs]*10)/10;
			$scope.input.percentage50 =  Math.floor($scope.input.pot/2/$scope.odds[$scope.input.outs]*10)/10;
			$scope.input.amount = $scope.input.i_maximum;
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
				$scope.input.payamount=Math.floor(newValue*$scope.odds[$scope.input.outs]*10)/10;
				if(isNaN($scope.input.payamount))
				{
					$scope.input.payamount =0;
				}
			}
		}

	});
	
	$scope.goTop = function()
	{
		window.scrollTo(0,0);
	}
	
	$scope.update_result = function()
	{
		if($scope.ajaxload == true)
		{
			var obj =
			{
				'message' :'系统忙禄中/system busy',
			};
			dialog(obj);
			return false;
		}
		$scope.ajaxload = true;
		$scope.input.odds = $scope.odds[$scope.input.outs];		
		var obj = $scope.input;
		var promise = apiService.Api('/Api/HdPokerInsurance/uploadResult', obj);
		promise.then
		(
			function(r) 
			{
				$scope.ajaxload = false;
				if(r.data.status =="200")
				{
					$scope.step =1;
					$scope.input ={};
					var obj =
					{
						'message' :'成功/upload ok',
					};
					dialog(obj);
				
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
	
	
	$scope.save = function()
	{	
		if($scope.ajaxload == true)
		{
			var obj =
			{
				'message' :'系统忙禄中/system busy',
			};
			dialog(obj);
			return false;
		}
		$scope.ajaxload = true;
		$scope.input.odds = $scope.odds[$scope.input.outs];		
		var obj = $scope.input;
		var promise = apiService.Api('/Api/HdPokerInsurance/insert', obj);
		promise.then
		(
			function(r) 
			{
				$scope.ajaxload = false;
				if(r.data.status =="200")
				{
					$scope.input.order_id =r.data.body.order_id;
					$scope.step=3;
				
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
	
}
pokerInsuranceApp.controller('InsuranceCount',  ['$scope' ,'$routeParams', 'apiService', InsuranceCount]);

var LoginCtrl = function($scope ,$routeParams, apiService,$cookies)
{

	$scope.login = function (){
		if($scope.ajaxload == true)
		{
			var obj =
			{
				'message' :'系统忙禄中/system busy',
			};
			dialog(obj);
			return false;
		}
		$scope.ajaxload = true;		
		var obj = $scope.input;
		var promise = apiService.Api('/Api/Api/login', obj);
		promise.then
		(
			function(r) 
			{
				$scope.ajaxload = false;
				if(r.data.status =="200")
				{
					$cookies.put('usess', r.data.body.user_sess, { path: '/'});
					location.href="/";
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
}
pokerInsuranceApp.controller('LoginCtrl',  ['$scope' ,'$routeParams', 'apiService' ,'$cookies', LoginCtrl]);



var bodyCtrl = function($scope ,$routeParams, apiService)
{
	$scope.user={};
	$scope.init = function()
	{
		
		if($scope.ajaxload == true)
		{
			var obj =
			{
				'message' :'系统忙禄中/system busy',
			};
			dialog(obj);
			return false;
		}
		$scope.ajaxload = true;		
		var obj = {};
		var promise = apiService.Api('/Api/Api/getUser', obj);
		promise.then
		(
			function(r) 
			{
				$scope.ajaxload = false;
				if(r.data.status =="200")
				{
					$scope.user = r.data.body.user_data;
					
				}else
				{
					
					var obj =
					{
						'message' :r.data.message,
						buttons: 
						[
							{
								text: "close",
								click: function() 
								{
									$( this ).dialog( "close" );
									location.href="/login.html"
								}
							}
						]
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
}
pokerInsuranceApp.controller('bodyCtrl',  ['$scope' ,'$routeParams', 'apiService', bodyCtrl]);

var apiService = function($http,$cookies)
{
	var sess = $cookies.get('usess');
	return {
		Api :function(apiurl, obj)
		{
			var default_obj = 
			{
			
			};
			var object = $.extend(default_obj, obj);
			return $http.post(apiurl+'?sess='+sess , object,  {headers: {'Content-Type': 'application/json'}});
		}
    };
}
pokerInsuranceApp.factory('apiService', ['$http','$cookies', apiService]);
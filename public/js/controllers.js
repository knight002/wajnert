/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

'use strict';

/* Controllers */

var wajnertControllers = angular.module('wajnertControllers', []);
var steps = [
	{
		'name' : 'step1',
		'data' : null
	},
	{
		'name' : 'step2',
		'data' : null
	},
	{
		'name' : 'step3',
		'data' : null
	},
];
var selectedItem = null;

wajnertControllers.controller('Step1Ctrl', ['$scope', '$http',
	function($scope, $http)
	{
		console.log($http);
//		$http.get('phones/phones.json').success(function(data) {
//			$scope.phones = data;
//		});
//
//		$scope.orderProp = 'age';
		console.log('step 1 controller');
	}]);

wajnertControllers.controller('Step2Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
//		$scope.phoneId = $routeParams.phoneId;
		console.log('step 2 controller');
		$scope.prevStep = 'step1';
		$scope.nextStep = 'step3';
		console.log(db.step2);
		$scope.items = db.step2;
		
		$scope.selectItem = function(item)
		{
			//put item in steps
			selectedItem = item;
			$scope.selectedFile = selectedItem.file;
			
			console.log(selectedItem);
			console.log(item);
		}

	}]);

wajnertControllers.controller('Step3Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		console.log('step 3 controller');
		$scope.prevStep = 'step2';
		$scope.nextStep = 'step4';		
		
	}]);

wajnertControllers.controller('Step4Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		console.log('step 4 controller');
		$scope.prevStep = 'step3';
		//$scope.nextStep = 'step5';
		$scope.items = db.textures;
		if(selectedItem)
		{
			console.log(selectedItem);
			$scope.selectedFile2 = selectedItem.file2;
			$scope.fronts = selectedItem.params.fronts;
		}
		
		$scope.selectFront = function(item)
		{
			//console.log(item);
			if(item.selectedClass == 'selected')
				item.selectedClass = null;
			else
				item.selectedClass = 'selected';
			//angular.element(this).toggleClass('selected');
			//$(item).toggleClass('selected');
			
		}
		
		$scope.selectItem = function(item)
		{
			console.log(item);
			console.log(this);
			console.log($scope.fronts);
			var selected = [];
			angular.forEach($scope.fronts, function(front, key) {
				if(front.selectedClass != null && typeof front.selectedClass != 'undefined')
				{
					selected[key] = item;
					console.log(key);
					front.background = "background-image: url('../images/textures/"+item.file+"');" ;
					console.log(front.background);
				}
				front.selectedClass = null;
			});
			console.log(selected);

			
		}
		
		
	}]);

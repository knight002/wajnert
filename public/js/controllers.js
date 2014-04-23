/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

'use strict';

/* Controllers */

var wajnertControllers = angular.module('wajnertControllers', []);
var selectedItem = {
	'structure' : null,
	'item' : null,
	
};

wajnertControllers.controller('Step1Ctrl', ['$scope', '$http',
	function($scope, $http)
	{
//		$http.get('phones/phones.json').success(function(data) {
//			$scope.phones = data;
//		});

	}]);

wajnertControllers.controller('Step2Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		console.log('step 2 controller');
		$scope.prevStep = 'step1';
		$scope.nextStep = 'step3';
		
		$scope.items = Core.Func.getDictinctValues2(db.step2, 'file');
		//load the first element
		selectedItem.structure = $scope.items[0];
		
		$scope.selectItem = function(item)
		{
			//put item in steps
			selectedItem.structure = item;
		}
		$scope.selectedFile = selectedItem;

	}]);

wajnertControllers.controller('Step3Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		console.log('step 3 controller');
		$scope.prevStep = 'step2';
		$scope.nextStep = 'step4';
		
		if(!selectedItem.structure)
			document.location = '#step2';
		
		//display elements for choosen structure
		var filterArr = [
			{'key' : 'file', 'value' : selectedItem.structure}
		];
		$scope.items = Core.Func.filterElementsByKey(db.step2, filterArr);
		selectedItem.item = $scope.items[0];
		
		$scope.selectItem = function(item)	//get items
		{
			//put item in steps
			selectedItem.item = item;
			$scope.selectedFile2 = selectedItem.item.file2;
		}
		$scope.selectedFile2 = selectedItem.item.file2;
		
	}]);

wajnertControllers.controller('Step4Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		console.log('step 4 controller');
		$scope.prevStep = 'step3';
		$scope.nextStep = 'step5';
		$scope.items = db.textures;
		
		if(!selectedItem.structure)
			document.location = '#step2';
		
		if(selectedItem.item)
		{
			console.log(selectedItem);
			$scope.selectedFile2 = selectedItem.item.file2;
			$scope.fronts = selectedItem.item.params.fronts;
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
					front.background = {'background-image' : "url('../images/textures/"+item.file+"')"};// "background-image: url('../images/textures/"+item.file+"');" ;
					console.log(front.background);
				}
				front.selectedClass = null;
			});
			console.log(selected);

			
		}
		
		
	}]);

wajnertControllers.controller('Step5Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		console.log('step 5 controller');
		$scope.prevStep = 'step4';
		$scope.nextStep = 'step6';
		$scope.items = db.textures;
		
		if(!selectedItem.structure)
			document.location = '#step2';
		
		if(selectedItem.item)
		{
			console.log(selectedItem);
			$scope.selectedFile2 = selectedItem.item.file2;
			$scope.fronts = selectedItem.item.params.fronts;
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
					front.background = {'background-image' : "url('../images/textures/"+item.file+"')"};// "background-image: url('../images/textures/"+item.file+"');" ;
					console.log(front.background);
				}
				front.selectedClass = null;
			});
			console.log(selected);

			
		}
		
		
	}]);

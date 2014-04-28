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
	'color' : null,
	'shelve' : null,
	'handle' : null
	
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
		//console.log('step 2 controller');
		$scope.prevStep = 'step1';
		$scope.nextStep = 'step3';

		$scope.colors = Core.Func.getDistinctValues2(db.step2, 'color');
		//console.log($scope.colors);
		selectedItem.color = Core.Func.getFirst($scope.colors);
		//console.log(selectedItem.color);

		$scope.items = Core.Func.getDistinctValues2(db.step2, 'file');
		//load the first element
		selectedItem.structure = Core.Func.getFirst($scope.items);
		
		$scope.selectItem = function(item)
		{
			//put item in steps
			selectedItem.structure = item;
		}
		
		$scope.selectColor = function(item)
		{
			//console.log(item);
			//put item in steps
			selectedItem.color = item;
		}
		
		$scope.selectedFile = selectedItem;

	}]);

wajnertControllers.controller('Step3Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		//console.log('step 3 controller');
		if(!selectedItem.structure)
			document.location = '#step2';
		$scope.prevStep = 'step2';
		$scope.nextStep = 'step4';
		$scope.color = selectedItem.color;

		//display elements for choosen structure
		var filterArr = [
			{'key' : 'file', 'value' : selectedItem.structure},
			{'key' : 'color', 'value' : selectedItem.color}
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
		//console.log('step 4 controller');
		if(!selectedItem.structure)
			document.location = '#step2';

		$scope.prevStep = 'step3';
		if(typeof selectedItem.item.params.shelves != 'undefined')
			$scope.nextStep = 'step5';
		else
			$scope.nextStep = 'step6';
		$scope.color = selectedItem.color;
		$scope.items = db.textures;
		
		if(selectedItem.item)
		{
			//console.log(selectedItem);
			$scope.selectedFile2 = selectedItem.item.file2;
			$scope.fronts = selectedItem.item.params.fronts;
		}
		
		$scope.selectFront = function(item)
		{
			////console.log(item);
			if(item.selectedClass == 'selected')
				item.selectedClass = null;
			else
				item.selectedClass = 'selected';
			//angular.element(this).toggleClass('selected');
			//$(item).toggleClass('selected');
			
		}
		
		$scope.selectItem = function(item)
		{
			//console.log(item);
			//console.log(this);
			//console.log($scope.fronts);
			var selected = [];
			angular.forEach($scope.fronts, function(front, key) {
				if(front.selectedClass != null && typeof front.selectedClass != 'undefined')
				{
					selected[key] = item;
					//console.log(key);
					var horizontal = front.w > front.h ? 'horizontal/' : '';
					front.styles = {
						'background-image' : "url('../images/textures/"+horizontal+item.file+"')"
					};
					//console.log(front.background);
				}
				front.selectedClass = null;
			});
			//console.log(selected);

			
		}
		
		
	}]);

wajnertControllers.controller('Step5Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		//console.log('step 5 controller');
		if(!selectedItem.structure)
			document.location = '#step2';
		$scope.prevStep = 'step4';
		$scope.nextStep = 'step6';

		//console.log(db.shelves);
		$scope.items = db.shelves;
		selectedItem.shelve = Core.Func.getFirst($scope.items);
		//console.log(selectedItem.shelve);
		
		$scope.selectItem = function(item)	//get items
		{
			//put item in steps
			selectedItem.shelve = item;
			$scope.selectedItem = selectedItem.shelve;
		}
		$scope.selectedItem = selectedItem.shelve;
		//console.log($scope.selectedItem);
		
	}]);

wajnertControllers.controller('Step6Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		//console.log('step 6 controller');
		if(!selectedItem.structure)
			document.location = '#step2';
		
		if(typeof selectedItem.item.params.shelves != 'undefined')
			$scope.prevStep = 'step5';
		else
			$scope.prevStep = 'step4';
		$scope.nextStep = 'step7';

		//console.log(db.handles);
		$scope.items = db.handles;
		selectedItem.handle = Core.Func.getFirst($scope.items);
		//console.log(selectedItem.handle);
		
		$scope.selectItem = function(item)	//get items
		{
			//put item in steps
			selectedItem.handle = item;
			$scope.selectedItem = selectedItem.handle;
		}
		$scope.selectedItem = selectedItem.handle;
		//console.log($scope.selectedItem);
		
	}]);

wajnertControllers.controller('Step7Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		//console.log('step 7 controller');
		if(!selectedItem.structure)
			document.location = '#step2';
		
		$scope.prevStep = 'step6';
		//$scope.nextStep = 'step8';
		
		$scope.selectedItem = selectedItem;
		$scope.fronts = selectedItem.item.params.fronts;
		
		$scope.accessories = [];
		angular.forEach(db.accessories[selectedItem.color], function(val, key) {
			$scope.accessories.push(val);
		}); 
		//console.log($scope.accessories);

		$scope.list1 = [];
		angular.forEach($scope.fronts, function(val, key) {
			$scope.list1.push({});
		});
		
		if(typeof selectedItem.item.params.shelves != 'undefined')
		{
			var shelves = selectedItem.item.params.shelves;
			shelves[0].t = selectedItem.shelve.file;
			shelves[0].styles = {
				'background-image' : "url('../images/shelves/front/"+selectedItem.shelve.file+"')"
			};
			$scope.shelves = shelves;
		}
		
		$scope.startCallback = function(event, ui, file) {
			//console.log('You started draggin: ' + file.file);
			$scope.draggedTitle = file.file;
		};
		$scope.stopCallback = function(event, ui) {
			//console.log('Why did you stop draggin me?');
		};
		$scope.dragCallback = function(event, ui) {
			//console.log('hey, look I`m flying');
		};
		$scope.dropCallback = function(event, ui) {
			//console.log('hey, you dumped me :-(' , $scope.draggedTitle);
			//console.log($scope.list1);
			//console.log($scope.accessories);
		};
		$scope.overCallback = function(event, ui) {
			//console.log('Look, I`m over you');
		};
		$scope.outCallback = function(event, ui) {
			//console.log('I`m not, hehe');
		};
		
	}]);

wajnertControllers.controller('DndCtrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
//		$scope.selectedItem = selectedItem;
		$scope.fronts = db.step2[0].params.fronts;
		console.log($scope.fronts);
		
		$scope.accessories = db.accessories;
		console.log($scope.accessories);
		
		var arr1 = [];
		angular.forEach($scope.accessories, function(val, key) {
			arr1.push(val);
		}); 
		$scope.accessories = arr1;
		console.log($scope.accessories);


//  $scope.images = [{'thumb': '1.png'},{'thumb': '2.png'},{'thumb': '3.png'},{'thumb': '4.png'}]
		$scope.list1 = [];
		angular.forEach($scope.fronts, function(val, key) {
			$scope.list1.push({});
		}); 

		console.log($scope.list1);


  $scope.startCallback = function(event, ui, file) {
    console.log('You started draggin: ' + file.file);
//    $scope.draggedTitle = file.file;
  };
  $scope.stopCallback = function(event, ui) {
    console.log('Why did you stop draggin me?');
  };
  $scope.dragCallback = function(event, ui) {
    console.log('hey, look I`m flying');
  };
  $scope.dropCallback = function(event, ui) {
//    console.log('hey, you dumped me :-(' , $scope.draggedTitle);
	console.log($scope.list1);
	console.log($scope.accessories);
  };
  $scope.overCallback = function(event, ui) {
    console.log('Look, I`m over you');
  };
  $scope.outCallback = function(event, ui) {
    console.log('I`m not, hehe');
  }; 

	}]);

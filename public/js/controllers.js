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

wajnertControllers.controller('BodyController', ['$scope', '$route',
	function($scope, $route)
	{
		$scope.headerTemplate = 'partials/header1.html';
//		$scope.headerTemplate = 'partials/header2.html';
		$scope.footerTemplate = 'partials/footer1.html';
	}]);

wajnertControllers.controller('Step1Ctrl', ['$scope', '$http',
	function($scope, $http)
	{

	}]);

wajnertControllers.controller('Step2Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		//console.log('step 2 controller');
		$scope.prevStep = 'step1';
		$scope.nextStep = 'step3';

		var colors = Core.Func.getDistinctValues2(db.step2, 'color');
		$scope.colors = [];
		angular.forEach(colors, function(val, key) {
			$scope.colors.push({'color' : val, 'style' : {'background-color' : '#'+val}});
		});
		//console.log($scope.colors);
		selectedItem.color = Core.Func.getFirst(colors);
		//console.log(selectedItem.color);

		var items2 = Core.Func.getDistinctValues2(db.step2, 'file');
		//load the first element
		selectedItem.structure = Core.Func.getFirst(items2);
		$scope.items = [];
		angular.forEach(items2, function(val, key) {
			$scope.items.push(val);
		});
		
		$scope.selectItem = function(item)
		{
			//put item in steps
			selectedItem.structure = item;
		}
		
		$scope.selectColor = function(item)
		{
			selectedItem.color = item;
		}
		
		$scope.selectedItem = selectedItem;

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
		
		//console.log(selectedItem);

		//display elements for choosen structure
		var filterArr = [
			{'key' : 'file', 'value' : selectedItem.structure},
			{'key' : 'color', 'value' : selectedItem.color}
		];
		var items2 = Core.Func.filterElementsByKey(db.step2, filterArr);
		$scope.items = [];
		angular.forEach(items2, function(val, key) {
			$scope.items.push(val);
		});
//		$scope.items = arr1;
		//console.log($scope.items);
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
		$scope.selectedItem = selectedItem;
		$scope.fronts = selectedItem.item.params.fronts;
		var items = db.textures;
		$scope.items = [];
		angular.forEach(items, function(val, key) {
			$scope.items.push(val);
		});
		
		$scope.selectFront = function(item)
		{
			if(item.selectedClass == 'selected')
				item.selectedClass = null;
			else
				item.selectedClass = 'selected';			
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
					front.selectedBackgroundImage = horizontal+item.file;
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
		//$scope.items = db.shelves;
		var items = db.shelves;
		selectedItem.shelve = Core.Func.getFirst(items);

		$scope.items = [];
		angular.forEach(items, function(val, key) {
			$scope.items.push(val);
		});
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
		$scope.selectedItem = selectedItem;
		
		//FRONTS
		var fronts = selectedItem.item.params.fronts;
		$scope.fronts = [];
		angular.forEach(fronts, function(val, key) {
			var val1 = val;
			val1.styles = {
				'left' : val.x + 'px',
				'top' : val.y + 'px',
				'width' : val.w + 'px',
				'height' : val.h + 'px',
				'background-image' : "url('../images/textures/"+val.selectedBackgroundImage+"')"
			};
			$scope.fronts.push(val1);
		});
		//console.log($scope.fronts);
		
		//HANDLES
		$scope.handles = [];
		angular.forEach(fronts, function(front, key) {
			//console.log(front.handles);
			angular.forEach(front.handles, function(val, key) {
	//			var val2 = val;
				var val2 = {};
				val2.styles = {
					'left' : val.x + 'px',
					'top' : val.y + 'px',
					'width' : val.w + 'px',
					'height' : val.h + 'px',
	//				'background-image' : "url('../images/textures/"+val.selectedBackgroundImage+"')"
				};
				$scope.handles.push(val2);
			});
		});
		//console.log($scope.handles);
		
		//SHELVES
		if(typeof selectedItem.item.params.shelves != 'undefined')
		{
			//console.log(selectedItem.shelve);
			var shelves = selectedItem.item.params.shelves;
			shelves[0].t = selectedItem.shelve.file;
			shelves[0].styles = {
				'left' : shelves[0].x+'px',
				'top' : shelves[0].y+'px',
				'width' : shelves[0].w+'px',
				'height' : shelves[0].h+'px',
				'background-image' : "url('../images/shelves/front/"+selectedItem.shelve.file+"')"
			};
			$scope.shelves = shelves;
			//console.log($scope.shelves);
		}

		//ITEMS
		var items = db.handles;
		$scope.items = [];
		angular.forEach(items, function(val, key) {
			$scope.items.push(val);
		});
		selectedItem.handle = Core.Func.getFirst($scope.items);
		//console.log($scope.items);

		$scope.selectHandle = function(item)
		{
			if(item.selected == true)
				item.selected = null;
			else
				item.selected = true;
		}
		//console.log($scope.selectedItem);
		
		$scope.selectItem = function(item)
		{
			//console.log(item);
			//console.log(this);
			//console.log($scope.handles);
			var selected = [];
			angular.forEach($scope.handles, function(handle, key) {
				if(handle.selected != null && typeof handle.selected != 'undefined')
				{
					selected[key] = item;
					//console.log(key);
					handle.styles['background-image'] = "url('../images/handles/"+item.file+"')";
				}
				handle.selected = null;
			});
			//console.log(selected);

			
		}
		
	}]);

wajnertControllers.controller('Step7Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		//console.log('step 7 controller');
		if(!selectedItem.structure)
			document.location = '#step2';
		
		$scope.prevStep = 'step6';
		$scope.nextStep = 'step8';
		
		$scope.selectedItem = selectedItem;
		$scope.fronts = selectedItem.item.params.fronts;
		
		$scope.accessories = [];
		angular.forEach(db.accessories[selectedItem.color], function(val, key) {
			$scope.accessories.push(val);
		}); 
		//console.log($scope.accessories);
		
		//placeholders
		$scope.placeholders = [];
		angular.forEach(db.accessories[selectedItem.color], function(val1, key1) {
			angular.forEach(val1.mountings, function(val2, key2) {
				var ret = {
					'id' : val1.id,
					'name' : val1.name,
					'file' : val1.file
				};
				ret.styles = {
					'left' : val2.x+'px',
					'top' : val2.y+'px',
					'width' : val2.w+'px',
					'height' : val2.h+'px',
//					'background-image' : "url('../images/shelves/front/"+selectedItem.shelve.file+"')"
				};
				//console.log(ret);
				$scope.placeholders.push(ret);
			}); 
		}); 
		//console.log($scope.placeholders);

		$scope.list1 = [];
		angular.forEach($scope.placeholders, function(val, key) {
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

			$scope.accessories = [];
			angular.forEach(db.accessories[selectedItem.color], function(val, key) {
				$scope.accessories.push(val);
			}); 
			
//			ui.draggable.clone(true);
			//$(this).append(ui.draggable.clone(true));
		};
		$scope.overCallback = function(event, ui) {
			//console.log('Look, I`m over you');
		};
		$scope.outCallback = function(event, ui) {
			//console.log('I`m not, hehe');
		};
		
	}]);

wajnertControllers.controller('Step8Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams)
	{
		//console.log('step 8 controller');
		if(!selectedItem.structure)
			document.location = '#step2';
		
		$scope.prevStep = 'step7';
		//$scope.nextStep = 'step9';
		
		$scope.selectedItem = selectedItem;
		$scope.fronts = selectedItem.item.params.fronts;
		
		$scope.accessories = [];
		angular.forEach(db.accessories[selectedItem.color], function(val, key) {
			$scope.accessories.push(val);
		}); 
		//console.log($scope.accessories);
		
		if(typeof selectedItem.item.params.shelves != 'undefined')
		{
			var shelves = selectedItem.item.params.shelves;
			shelves[0].t = selectedItem.shelve.file;
			shelves[0].styles = {
				'background-image' : "url('../images/shelves/front/"+selectedItem.shelve.file+"')"
			};
			$scope.shelves = shelves;
		}
		
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

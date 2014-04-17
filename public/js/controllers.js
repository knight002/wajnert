/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

'use strict';

/* Controllers */

var wajnertControllers = angular.module('wajnertControllers', []);

wajnertControllers.controller('Step1Ctrl', ['$scope', '$http',
	function($scope, $http) {
//		$http.get('phones/phones.json').success(function(data) {
//			$scope.phones = data;
//		});
//
//		$scope.orderProp = 'age';
		console.log('step 1 controller');
	}]);

wajnertControllers.controller('Step2Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams) {
//		$scope.phoneId = $routeParams.phoneId;
		console.log('step 2 controller');
		$scope.prevStep = 'step1';
		$scope.nextStep = 'step3';
	}]);

wajnertControllers.controller('Step3Ctrl', ['$scope', '$routeParams',
	function($scope, $routeParams) {
//		$scope.phoneId = $routeParams.phoneId;
		console.log('step 3 controller');
		$scope.prevStep = 'step2';
		//$scope.nextstep = 'step4';
	}]);

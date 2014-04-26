/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
	//$('div').css('background-color', 'red');
});

'use strict';

/* App Module */

var wajnertApp = angular.module('wajnertApp', [
  'ngRoute',
  'wajnertControllers',
  'ngDragDrop'
]);

wajnertApp.config(['$routeProvider',
	function($routeProvider) {
		$routeProvider.
			when('/step1', {
				templateUrl: 'partials/step1.html',
				controller: 'Step1Ctrl'
			}).
			when('/step2', {
				templateUrl: 'partials/step2.html',
				controller: 'Step2Ctrl'
			}).
			when('/step3', {
				templateUrl: 'partials/step3.html',
				controller: 'Step3Ctrl'
			}).
			when('/step4', {
				templateUrl: 'partials/step4.html',
				controller: 'Step4Ctrl'
			}).
			when('/step5', {
				templateUrl: 'partials/step5.html',
				controller: 'Step5Ctrl'
			}).
			when('/step6', {
				templateUrl: 'partials/step6.html',
				controller: 'Step6Ctrl'
			}).
			when('/step7', {
				templateUrl: 'partials/step7.html',
				controller: 'Step7Ctrl'
			}).
			otherwise({
				redirectTo: '/step1'
			});
	}]);

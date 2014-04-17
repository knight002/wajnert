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
  'wajnertControllers'
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
			otherwise({
				redirectTo: '/step1'
			});
	}]);

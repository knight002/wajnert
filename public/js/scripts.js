/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(typeof Core === "undefined")
	var Core = {};

Core.Scripts = {
	init : function() {
		$('body').on('mouseenter', '.js-expandable-menu .js-main', Core.Scripts.expand);
		$('body').on('mouseleave', '.js-expandable-menu ul', Core.Scripts.collapse);
	},

	expand : function(event) {
		event.preventDefault();
		$(this).next('ul').show('fast');
	},

	collapse : function(event) {
		event.preventDefault();
		$(this).hide('fast');
	}
};

Core.Scripts.init();


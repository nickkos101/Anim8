$(document).ready(function() {

	//Reference Selectors

	var slider = $('.slider');
	var slide = $('.slide');

	//Slider Events

	$(function () {
		(slider).find('ul li:first').before((slider).find('ul li:last'));
		setInterval(
			function () {
				(slider).find('ul').find('li:last').animate({
					"left":  "999px"
				}, 700, function () {
					(slider).find('ul li:first').before((slider).find('ul li:last'));
					(slider).find('ul li:first').css({
						'left': '0px'
					});          
				});
			},3000
			);
	});

});
$(document).ready( function() {
	var $submenu = $('.submenu');
	var $mainmenu = $('.mainmenu');
	$submenu.hide();
	$submenu.first().delay(400).slideDown(700);
	$submenu.on('click','li', function() {
		$submenu.siblings().find('li').removeClass('chosen');//siblings查找每个submuenu 元素的所有同胞元素
		$(this).addClass('chosen');//增加下拉框插件
	});
	$mainmenu.on('click', 'li', function() {
		$(this).next('.submenu').slideToggle().siblings('.submenu').slideUp();//slideToggle()方法通过使用滑动效果(高度变化)来切换元素的可见状态
		//以滑动方式藏 元素
	});
	//$mainmenu.children('li:last-child').on('click', function() {
	//	$mainmenu.fadeOut().delay(500).fadeIn();
	//});//fadeout()使用淡出效果来隐藏被选元素
	//使用淡入效果显示所有 <p> 元素褪色效果）
});
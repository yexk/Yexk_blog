;"use strict";

(function(){
	/**
	 * 菜单栏高亮
	 * @date [通过url来判断当前选中的]
	 */
	$current = $('#main-menu [href="'+location.pathname+'"]');
	$current.parent('li').parent('ul').parent('li').addClass('expanded active');
	$current.parent('li').parent('ul').attr('style','display:block');
	$current.parent('li').addClass('active');
})();
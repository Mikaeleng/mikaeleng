/*
 * prettyPhoto configuration
 */
 
$(document).ready(function(){
	$("a[rel^='prettyPhoto']").prettyPhoto({
		animationSpeed:		'normal',
		opacity:			0.80,
		allowresize:		false,
		showTitle:			false,
		theme:				'light_square',
		hideflash:			'true',
		flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}" id="x10mini" ><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" name="x10mini" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>'		
	});
});


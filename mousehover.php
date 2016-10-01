<?php

/*
Plugin Name: Mousehover
Plugin URI: http://www.treenity-web.fr
Description: Plugin rajoutant le shortcode [imghover]<img image><img image hover>[/imghover]
Version: 1.0
Author: Treenity
Author URI: http://www.treenity-web.fr
License: GPL2
*/

namespace treenity;

/**
 * Class onMouseHover
 *
 * @package treenity
 */
class onMouseHover {
	/**
	 * onMouseHover constructor.
	 */
	public function __construct() {
		add_shortcode( 'imghover', array( $this, 'shortcodeCallback' ) );
	}

	/**
	 * @param $atts
	 * @param $content
	 */
	public function shortcodeCallback( $atts, $content ) {

		if ( preg_match( '#(?:<img|(?<!^)\G)\h*(\w+)="([^"]+)"(?=.*?\/>)#im', $content, $images ) ) {
			echo '<img src="' . $images[1][2] . '" data-src="' . $images[3][2] . '" class="' . $images[2][2] . '"/>';
			echo <<<'HTML'
<script>
    $("img[data-src]").hover(function () {
        var oldImg = $(this).attr("src");
        $(this).attr("src", $(this).data("src"));
    }, function () {
        $(this).attr("src", oldImg)
    });
</script>
HTML;
		}
	}
}
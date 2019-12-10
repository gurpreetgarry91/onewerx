<?php if (!defined('FW')) die('Forbidden');
/**
 * @var WP_Post $item
 * @var string $title
 * @var array $attributes
 * @var object $args
 * @var int $depth
 */

if ( fw()->extensions->get('megamenu')->show_icon() && ($icon = fw_ext_mega_menu_get_meta($item, 'icon')) ){
	$title = fw_html_tag( 'i', array( 'class' => 'menu-item-icon ' . $icon ), true ) . $title;
}
echo ($args->before);
/*If empty link in item - we will print title item instead link*/
if ( empty( $attributes['href'] ) || $attributes['href'] === 'http://' || $attributes['href'] === 'http://#' || $attributes['href'] === 'https://' || $attributes['href'] === 'https://#' ) {

	echo '<div class="megamenu-item-info">';
	if ($depth > 0 && true !== fw_ext_mega_menu_get_meta($item, 'title-off')) {
		echo fw_html_tag( 'h5', array( 'class' => 'megamenu-item-info-title' ), $title );
	}
	if ( ! empty( $item->description ) ) {
		echo fw_html_tag( 'div', array( 'class' => 'megamenu-item-info-text' ),  do_shortcode( $item->description ) );
	}
	echo '</div>';
} else {
	if ($depth !== 0){
		$title .= fw_html_tag( 'i', array( 'class' => 'seoicon-right-arrow' ), true );
	}
	if ($depth > 0 && false !== fw_ext_mega_menu_get_meta($item, 'title-off')) {
		echo fw_html_tag('a', $attributes, $args->link_before . $title . $args->link_after);
		if ( ! empty( $item->description ) ) {
			echo fw_html_tag( 'div', array( 'class' => 'megamenu-item-info-text' ), do_shortcode( $item->description ) );
		}
	} else {
		echo fw_html_tag('a', $attributes, $args->link_before . $title . $args->link_after);
	}
}
echo ($args->after);
<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array  $args
 * @var string $title
 * @var string $number
 * @var string $font_size
 * @var string $cat_sel
 * @var array  $query
 */

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );

echo( $before_widget );

if ( $title ) {
	echo( $before_title . esc_html( $title ) . $after_title );
} ?>
	<div class="tags-wrap">
		<?php
		$args = array(
			'taxonomy' => $cat_sel,
			'number'   => $number,
			'smallest' => $font_size,
			'largest'  => $font_size,
			'unit'     => 'px',
		);
		wp_tag_cloud( $args );
		?>
	</div>
<?php
echo( $after_widget );

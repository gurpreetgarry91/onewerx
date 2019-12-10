<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */

get_header();
$layout = seosight_sidebar_conf();
$main_class = 'full' !== $layout['position'] ? 'site-main content-main-sidebar' : 'site-main content-main-full';
$container_width = 'container';
$padding_class = 'medium-padding120';?>
	<div id="primary" class="<?php echo esc_attr( $container_width ) ?>">
		<div class="row <?php echo esc_attr( $padding_class ) ?>">
			<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
				<main id="main" class="<?php echo esc_attr( $main_class ) ?>" >

					<?php
					$form_options = get_post_meta( get_the_ID(), 'fw_options', true );
					if ( ! empty( $form_options ) ) {

						$form_html = fw()->extensions->get( 'forms' )->render_form( $form_id, $form_options['form'], 'contact-forms', '' );

						$form_html = str_replace( '<div class="header title">', '<div class="module-heading">', $form_html );

						if ( 'dark' === $color_form ) {
							$form_html = str_replace( 'form-builder-item', 'form-builder-item input-dark', $form_html );
						} else {
							$form_html = str_replace( 'form-builder-item', 'form-builder-item input-standard-grey', $form_html );
						}


						preg_match_all( '/<input[^>]+>/i', $form_html, $result );
						$result = array_shift( $result );
						foreach ( $result as $input ) {
							preg_match_all( '/(class|value|type)=("[^"]*")/i', $input, $form_tags[ $input ] );
						}
						$submit_input = array_slice( $result, - 1, 1, true );
						$submit_input = array_shift( $submit_input );

						foreach ( $form_tags as $tag ) {
							if ( '"submit"' === $tag[2][0] ) {
								$submit_atts = $tag[2];
							}
						}
						if ( isset( $submit_atts[1] ) ) {
							$button_text = str_replace( '"', '', $submit_atts[1] );
						}
						if ( isset( $submit_atts[2] ) ) {
							$button_class = $submit_atts[2];
						}


						$button_html = '<div class="col-xs-12 submit-wrap"><button type="submit" class="btn-hover-shadow btn btn-medium btn--' . esc_attr( $color_btn . ' ' . $button_class ) . '"><span class="text">' . esc_html( $form_options['submit_button_text'] ) . '</span><span class="semicircle"></span></button></div></form>';
						$form_html   = str_replace( '</form>', $button_html, $form_html );

						echo( $form_html );
					} else {
						esc_html_e( 'Please create new and select contact form.', 'seosight' );
					}
					?>

				</main><!-- #main -->
			</div>
			<?php if ( 'full' !== $layout['position'] ) { ?>
				<div class="<?php echo esc_attr( $layout['sidebar-classes'] ) ?>">
					<?php get_sidebar(); ?>
				</div>
			<?php } ?>
		</div><!-- #row -->
	</div><!-- #primary -->
<?php
get_footer();

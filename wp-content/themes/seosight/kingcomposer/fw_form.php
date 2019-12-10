<?php
/**
 * Unyson Forms shortcode
 **/

$form_id   = $custom_class = $color_form = $color_btn = $button_class = '';
$form_tags = $submit_atts = array();

/** @var array $atts */
extract( $atts );

//Kingcomposer wrapper class for each element
$wrap_class = apply_filters( 'kc-el-class', $atts );
//custom class element
$wrap_class[] = 'crumina-module';
$wrap_class[] = 'contact-form';
$wrap_class[] = $custom_class;

if ( isset( $form_id ) && $form_id > 0 ) { ?>
    <div class="<?php echo implode( ' ', $wrap_class ); ?>">

		<?php
		$form_options = get_post_meta( $form_id, 'fw_options', true );
		if ( ! empty( $form_options ) ) {

			$form_html = fw()->extensions->get( 'forms' )->render_form( $form_id, $form_options['form'], 'contact-forms', '' );

			if ( 'dark' === $color_form ) {
				$form_html = str_replace( 'form-builder-item-recaptcha"', 'form-builder-item-recaptcha" data-theme="dark"', $form_html );
				$form_html = str_replace( 'form-builder-item"', 'form-builder-item input-dark"', $form_html );
				$form_html = str_replace( 'form-builder-item ', 'form-builder-item input-dark ', $form_html );
			} else {
				$form_html = str_replace( 'form-builder-item"', 'form-builder-item input-standard-grey"', $form_html );
				$form_html = str_replace( 'form-builder-item ', 'form-builder-item input-standard-grey ', $form_html );
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
    </div>
<?php } else { ?>
	<?php esc_html_e( 'Please create new and select contact form.', 'seosight' ); ?>
<?php } ?>
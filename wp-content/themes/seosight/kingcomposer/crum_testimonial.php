<?php
/** @var array $atts */
$data_author = $data_img = $data_desc = $name = $position = $desc = $image = '';
$layout      = 'arrow';
$wrap_class  = apply_filters( 'kc-el-class', $atts );

extract( $atts );

$wrap_class[] = 'crumina-module';
$wrap_class[] = 'crumina-testimonial-item testimonial-item-' . $layout;
if ( ! empty( $custom_class ) ) {
    $wrap_class[] = $custom_class;
}

if ( $image > 0 ) {

    $img_link = wp_get_attachment_image_src( $image, 'thumbnail' );
    $img_link = $img_link[0];
    if ( 'author-centered-round' === $layout ) {
        $img_size = '85';
    } else {
        $img_size = '65';
    }
    //$img_link = fw_resize( $img_link, $img_size, $img_size, false );
    $data_img .= '<div class="testimonial-img-author">';
    $data_img .= '<img src="' . $img_link . '" alt="' . esc_html( $name ) . '">';
    $data_img .= '</div>';
}
if ( ! empty( $name ) || ! empty( $position ) ) {
    $data_author .= '<div class="author-info">';
    if ( ! empty( $name ) ) {
        $data_author .= '<h6 class="author-name">' . esc_html( $name ) . '</h6>';
    }
    if ( ! empty( $position ) ) {
        $data_author .= '<div class="author-company">' . esc_html( $position ) . '</div>';
    }
    $data_author .= '</div>';
}
if ( ! empty( $desc ) ) {

	$data_desc .= '<h5 class="testimonial-text">';
	$data_desc .= esc_html( $desc );
	$data_desc .= '</h5>';

} ?>

<div class="<?php echo implode( ' ', $wrap_class ); ?>">
    <?php switch ( $layout ) {
        case 'arrow':
            echo do_shortcode( $data_desc );
            echo '<div class="author-info-wrap">';
            echo( $data_img );
            echo( $data_author );
            echo '</div>';
            echo '<div class="quote"><i class="seoicon-quotes"></i></div>';
            break;
        case 'author-top':
            echo( $data_img );
            echo do_shortcode( $data_desc );
            echo( $data_author );
            break;
        case 'author-centered':
            echo do_shortcode( $data_desc );
            echo '<div class="author-info-wrap display-flex content-center">';
            echo( $data_img );
            echo( $data_author );
            echo '</div>';
            break;
        case 'author-centered-round':
            echo do_shortcode( $data_desc );
            echo '<div class="author-info-wrap">';
            echo( $data_img );
            echo( $data_author );
            echo '</div>';
            break;
        case 'quote-left':
            echo do_shortcode( $data_desc );
            echo '<div class="author-info-wrap">';
            echo( $data_author );
            echo '</div>';
            echo '<div class="quote"><i class="seoicon-quotes"></i></div>';
            break;
        case 'modern':
            echo '<div class="testimonial-content">';
            echo do_shortcode( $data_desc );
	        echo '<div class="author-info-wrap">';
            echo( $data_author );
	        echo '</div>';
            echo '</div>';
            echo( $data_img );
            echo '<div class="quote"><i class="seoicon-quotes"></i></div>';

            break;
        default:
            echo do_shortcode( $data_desc );
            echo '<div class="author-info-wrap">';
            echo( $data_img );
            echo( $data_author );
            echo '</div>';
            break;
    } ?>
</div>
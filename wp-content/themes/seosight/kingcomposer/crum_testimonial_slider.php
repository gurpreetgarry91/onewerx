<?php
/** @var array $atts */
$layout   = $wrap_class = $custom_class = $dots_class = $current_class = $pointdate = '';
$options  = $slider_class = $slider_attr = array();
$i        = 0;
extract( $atts );

//Kingcomposer wrapper class for each element
$wrap_class = apply_filters( 'kc-el-class', $atts );
//custom class element
$wrap_class[] = 'crumina-module';

$wrap_class[] = $custom_class;

$slider_attr[] = 'data-show-items="' . esc_attr( $number_of_items ) . '"';
$slider_attr[] = 'data-scroll-items="' . esc_attr( $number_of_items ) . '"';

if ( 'yes' === $autoscroll ) {
    $slider_attr[] = 'data-autoplay="' . esc_attr( intval( $time ) * 1000 ) . '"';
}
if ( 'arrow' === $layout ) {
    $slider_class[] = 'testimonial-slider-arrow';
} elseif ( 'modern' === $layout ) {
    $slider_class[] = 'testimonial__thumb overflow-visible';
    $slider_attr[]  = 'data-effect="fade"';
    $slider_attr[]  = 'data-parallax="true"';
} else {
    $slider_class[] = 'testimonial-slider-standard';
}
if ( 'yes' === $dots ) {
    $slider_class[] = 'pagination-bottom';
}
if ( 'arrow' === $layout ) {
    $dots_class = 'swiper-pagination grey bottom-left';
} elseif('modern' === $layout){
    $dots_class= 'swiper-pagination dark right-bottom';
} else {
    $dots_class = 'swiper-pagination';
}


?>
<div class="<?php echo implode( ' ', $wrap_class ); ?>">
    <?php if ( ! empty( $options ) ) { ?>
    <div class="swiper-container <?php echo implode( ' ', $slider_class ); ?>" <?php echo implode( ' ', $slider_attr ); ?>>
        <div class="swiper-wrapper">
            <?php foreach ( $options as $option ) { ?>
            <div class="swiper-slide">
                <div class="crumina-testimonial-item testimonial-item-<?php echo esc_attr( $layout ); ?>">
                <?php
                $data_img = $data_author = $data_desc = '';
                $image    = $option->image;
                $name     = $option->name;
                $position = $option->position;
                $desc     = $option->desc;
                if ( $image > 0 ) {
                    $img_link = wp_get_attachment_image_src( $image, 'thumbnail' );
                    $img_link = $img_link[0];
                    $data_img .= '<div class="testimonial-img-author"';
                    if('modern' === $layout ) {
                        $data_img .= ' data-swiper-parallax-x="-50"';
                    }
                    $data_img .= '>';
                    $data_img .= '<img src="' . $img_link . '" alt="' . esc_html( $name ) . '">';
                    $data_img .= '</div>';
                }
                if ( ! empty( $name ) || ! empty( $position ) ) {
                    $data_author .= '<div class="author-info"';
                    if('modern' === $layout ) {
                        $data_author .= ' data-swiper-parallax-x="-150"';
                    }
                    $data_author .= '>';
                    if ( ! empty( $name ) ) {
                        $data_author .= '<h6 class="author-name">' . esc_html( $name ) . '</h6>';
                    }
                    if ( ! empty( $position ) ) {
                        $data_author .= '<div class="author-company">' . esc_html( $position ) . '</div>';
                    }
                    $data_author .= '</div>';
                }
                if ( ! empty( $desc ) ) {
	                $data_desc .= '<h5 class="testimonial-text"';
                    if('modern' === $layout ) {
                        $data_desc .= ' data-swiper-parallax-x="-200" ';
                    }
                    $data_desc .='>';
                    $data_desc .= $desc;
	                $data_desc .= '</h5>';
                }
                // Slide item template
                switch ( $layout ) {
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
	                    echo '<div class="author-info-wrap">';
                        echo( $data_author );
	                    echo '</div>';
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
                    case 'modern':
                        echo '<div class="testimonial-content">';
                        echo do_shortcode( $data_desc );
	                    echo '<div class="author-info-wrap">';
                        echo ($data_author);
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
            </div>
            <?php } ?>
        </div>

            <?php }
            if ( 'yes' === $arrows && 'arrow' !== $layout && 'modern' !== $layout ) {
                ?>
                <!--Prev Next Arrows-->
                <svg class="btn-next">
                    <use xlink:href="#arrow-right"></use>
                </svg>
                <svg class="btn-prev">
                    <use xlink:href="#arrow-left"></use>
                </svg>
            <?php } if ( 'yes' === $dots ) { ?>
                <!-- Slider pagination -->
                <div class="<?php echo esc_attr($dots_class) ?>"></div>
            <?php } ?>
    </div>
</div>
<?php kc_js_callback( 'CRUMINA.initSwiper' ); ?>
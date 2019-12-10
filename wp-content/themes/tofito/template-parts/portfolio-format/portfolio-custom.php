
<div class="detail-item">
    <p><?php echo pixtheme_limit_words(get_the_excerpt(), 20) ?></p>
    <?php echo get_post_meta( get_the_ID(), 'post_custom', true ); ?>    
</div>
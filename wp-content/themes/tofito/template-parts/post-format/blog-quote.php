<?php
	// get meta options/values
	$pixtheme_content = rwmb_meta('post_quote_content');
	$pixtheme_source = rwmb_meta('post_quote_source');
?>

<div class="entry-media">
	<div class="entry-content">
		<div class="blockquote">
			<i class="icomoon-quote-left"></i>
			<p><?php echo $pixtheme_content; ?></p>
			<span><?php echo $pixtheme_source; ?></span>
		</div>
	</div>
</div>
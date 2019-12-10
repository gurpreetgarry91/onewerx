
	<form action="<?php echo esc_url(site_url()) ?>" method="get" id="search-global-form">  
    
     
                <input type="text" placeholder="<?php _e('Type and hit enter', 'PixTheme');?>" name="s" id="search" value="<?php esc_attr(the_search_query()); ?>" />
                <input type="submit" value="" name="search"  id="searchsubmit">
	</form>
    
    
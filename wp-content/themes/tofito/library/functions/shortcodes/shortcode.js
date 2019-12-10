(function() {

	tinymce.create('tinymce.plugins.Addshortcodes', {
		init : function(ed, url) {
		
			//Add Panel
			ed.addButton('AddPanel', {
				title : 'Add Panel',
				cmd : 'pix_panel',
				image : url + '/images/panel.png'
			});
			ed.addCommand('pix_panel', function() {
				ed.windowManager.open({file : url + '/ui.php?page=panel',width : 600 ,	height : 450 ,	inline : 1});
			});	
			
			//FeatServ
			/*ed.addButton('FeatServ', {
				title : 'Featured Services',
				cmd : 'pix_featserv',
				image : url + '/images/featured.png'
			});
			ed.addCommand('pix_featserv', function() {
				ed.windowManager.open({file : url + '/ui.php?page=featserv',width : 600 ,	height : 375 ,	inline : 1});
			});	
			*/
			//DealPan
			ed.addButton('DealPanel', {
				title : 'Deal Panel',
				cmd : 'pix_dealpan',
				image : url + '/images/deal.png'
			});
			ed.addCommand('pix_dealpan', function() {
				ed.windowManager.open({file : url + '/ui.php?page=dealpan',width : 600 ,	height : 300 ,	inline : 1});
			});	
			
			//Animated
			ed.addButton('Animated', {
				title : 'Animate',
				cmd : 'pix_animated',
				image : url + '/images/animated.png'
			});
			ed.addCommand('pix_animated', function() {
				ed.windowManager.open({file : url + '/ui.php?page=animated',width : 600 ,	height : 300 ,	inline : 1});
			});
		  
                        //Add Progress bar
			ed.addButton('Progress', {
				title : 'Add Progress bar',
				cmd : 'pix_progress',
				image : url + '/images/progress.png'
			});
			ed.addCommand('pix_progress', function() {
				ed.windowManager.open({file : url + '/ui.php?page=progress',width : 600 ,	height : 375 ,	inline : 1});
			});
                        
                        //Add Dropdown Buttons
			ed.addButton('Dropdown', {
				title : 'Add Dropdown Button',
				cmd : 'pix_dropdown',
				image : url + '/images/dropdown.png'
			});
			ed.addCommand('pix_dropdown', function() {
				ed.windowManager.open({file : url + '/ui.php?page=dropdown',width : 600 ,	height : 375 ,	inline : 1});
			});
			
			//AddButtons
			ed.addButton('AddButton', {
				title : 'Add Button',
				cmd : 'pix_button',
				image : url + '/images/button.png'
			});
			ed.addCommand('pix_button', function() {
				ed.windowManager.open({file : url + '/ui.php?page=button',width : 600 ,	height : 450 ,	inline : 1});
			});
			
			
                        //Add Tabs
                        ed.addButton('Tabs', {
                            title:' Add Tabs',
                            image:url+'/images/tabs.png',
                            cmd:'pix_tabs'
                        });
                        ed.addCommand('pix_tabs', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=tabs', width:600, height:350, inline:1});
                        });
						
						//Add fTabs
                        ed.addButton('fTabs', {
                            title:' Add FTabs',
                            image:url+'/images/ftabs.png',
                            cmd:'pix_ftabs'
                        });
                        ed.addCommand('pix_ftabs', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=ftabs', width:600, height:430, inline:1});
                        });
						
						//Add fTabs
          /*              ed.addButton('AboutTabs', {
                            title:' Add About Tabs',
                            image:url+'/images/atabs.png',
                            cmd:'pix_atabs'
                        });
                        ed.addCommand('pix_atabs', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=atabs', width:600, height:350, inline:1});
                        });*/
                        
                                               
			//Add Accordion
			ed.addButton('Accordion', {
				title : 'Add Accordion Block',
				cmd : 'pix_accordion',
				image : url + '/images/accordion.png'
			});
			ed.addCommand('pix_accordion', function() {
				ed.windowManager.open({file : url + '/ui.php?page=accordion',width : 600 ,	height : 375 ,	inline : 1});
			});
                     
                        
            //Add alert box
			ed.addButton('Alert', {
				title : 'Add alert box',
				cmd : 'pix_alert',
				image : url + '/images/alert.png'
			});
			ed.addCommand('pix_alert', function() {
				ed.windowManager.open({file : url + '/ui.php?page=alert',width : 600 ,	height : 400 ,	inline : 1});
			});
			
			
			       //Add banner box
			ed.addButton('Banner', {
				title : 'Add banner box',
				cmd : 'pix_banner',
				image : url + '/images/banner.png' 
			});
			ed.addCommand('pix_banner', function() {
				ed.windowManager.open({file : url + '/ui.php?page=banner',width : 600 ,	height : 400 ,	inline : 1});
			});
			
			

			//Add Video
			ed.addButton('Video', {
				title : 'Add video',
				cmd : 'pix_video',
				image : url + '/images/video.png'
			});
			ed.addCommand('pix_video', function() {
				ed.windowManager.open({file : url + '/ui.php?page=video',width : 600 ,	height : 260 ,	inline : 1});
			});

			//Add Audio
			ed.addButton('Audio', {
				title : 'Add self-hosted audio',
				cmd : 'pix_audio',
				image : url + '/images/audio.png'
			});
			ed.addCommand('pix_audio', function() {
				ed.windowManager.open({file : url + '/ui.php?page=audio',width : 600 ,	height : 260 ,	inline : 1});
			});
                        
                        //Add Self Hosted Video
			ed.addButton('Shvideo', {
				title : 'Add self-hosted video',
				cmd : 'pix_shvideo',
				image : url + '/images/shvideo.png'
			});
			ed.addCommand('pix_shvideo', function() {
				ed.windowManager.open({file : url + '/ui.php?page=shvideo',width : 600 ,	height : 260 ,	inline : 1});
			});
                        
                        
			//Carousel
			/*ed.addButton('Carousel', {
				title : 'Add carousel content slider',
				cmd : 'pix_carousel',
				image : url + '/images/carousel.png'
			});
			ed.addCommand('pix_carousel', function() {
				ed.windowManager.open({file : url + '/ui.php?page=carousel',width : 600 ,	height : 350 ,	inline : 1});
			});*/
                        
                        //Add Contact info
			ed.addButton('Contact', {
				title : 'Add Team info',
				cmd : 'pix_contacts',
				image : url + '/images/contact.png'
			});
			ed.addCommand('pix_contacts', function() {
				ed.windowManager.open({file : url + '/ui.php?page=contacts',width : 600 ,	height : 450 ,	inline : 1});
			});
                        
                        //Featured block
                        
                        ed.addButton('Fblock',{
                                title:'Add Featured connected',
                                image: url+'/images/fblock.png',
                                cmd: 'pix_fblock'
                        });
                        ed.addCommand('pix_fblock',function(){
                            ed.windowManager.open({file:url+'/ui.php?page=fblock', width:600, height:350, inline:1});
                        });
                        
                        //add Title block
                        ed.addButton('Tblock', {
                            title: 'Title block',
                            image:url+'/images/title.png',
                            cmd: 'pix_tblock'
                        });
                        ed.addCommand('pix_tblock', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=tblock', width:600, height:400, inline:1});
                        });
						
						//add Title block simple
                        ed.addButton('Offerblock', {
                            title: 'Title block White color',
                            image:url+'/images/title2.png',
                            cmd: 'pix_oblock'
                        });
                        ed.addCommand('pix_oblock', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=oblock', width:600, height:400, inline:1});
                        });
						
						//add Brand block
                        ed.addButton('BrandBlock', {
                            title: 'Brand and Clients',
                            image:url+'/images/brand.png',
                            cmd: 'pix_brandblock'
                        });
                        ed.addCommand('pix_brandblock', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=brandblock', width:600, height:175, inline:1});
                        });
                        
                        //Add Reveal box
                        ed.addButton('Reveal', {
                            title: 'Add Reveal',
                            image: url+'/images/bubble.png',
                            cmd:'pix_reveal'
                        });
                        ed.addCommand('pix_reveal', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=reveal', width:600, height:400, inline:1});
                        });
						
						
						      //Add Popover
                        ed.addButton('Popover', {
                            title: 'Add Popover',
                            image: url+'/images/bubble2.png',
                            cmd:'pix_popover'
                        });
                        ed.addCommand('pix_popover', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=popover', width:600, height:400, inline:1});
                        });
						
						
                        
                        //Add Tooltip
                        ed.addButton('Tooltip', {
                            title:' Add Tooltip',
                            image:url+'/images/tooltip.png',
                            cmd:'pix_tooltip'
                        });
                        ed.addCommand('pix_tooltip', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=tooltip', width:600, height:400, inline:1});
                        });
                        
                        //Portfolio Listing
                       
                         ed.addButton('Portlisting', {
                            title:' Add Portfolio Listing',
                            image:url+'/images/portlist.png',
                            cmd:'pix_portlisting'
                        });
                        ed.addCommand('pix_portlisting', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=portlisting', width:600, height:400, inline:1});
                        });
                        
                        //Blog Listing
			ed.addButton('Bloglisting', {
				title : 'Add blog posts listing',
				cmd : 'pix_blog',
				image : url + '/images/blog.png'
			});
			ed.addCommand('pix_blog', function() {
				ed.windowManager.open({file : url + '/ui.php?page=bloglisting',width : 600 ,	height : 350 ,	inline : 1});
			});
			
                    
						
						
                         //Social Buttons
                         ed.addButton('SocialButton', {
                            title:' Add Social Button',
                            image:url+'/images/social.png',
                            cmd:'pix_social'
                        });
                        ed.addCommand('pix_social', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=social', width:600, height:350, inline:1});
                        });
                        
                        //Add Side Navigation
                      
                        ed.addButton('Sidenav', {
                            title:'Add Side Navigation',
                            image:url+'/images/sidenav.png',
                            cmd:'pix_sidenav'
                        });
                        ed.addCommand('pix_sidenav', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=sidenav', width:600, height:350, inline:1});
                        });
                        
                        //Add Joyride
                        ed.addButton('Joyride', {
                            title:'Add Joyride',
                            image:url+'/images/joyride.png',
                            cmd:'pix_joyride'
                        });
                        ed.addCommand('pix_joyride', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=joyride', width:600, height:350, inline:1});
                        });
                         
                        	
		},
		getInfo : function() {
			return {
				longname : "Pix Theme",
				author : '"Pix Theme',
				authorurl : '"Pix Theme.com',
				infourl : '"Pix Theme.com',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('PixThemeShortcodes', tinymce.plugins.Addshortcodes);	
	
})();


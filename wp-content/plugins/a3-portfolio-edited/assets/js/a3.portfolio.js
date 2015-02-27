// Register a Force event for auto load lazy image
jQuery.lazyLoadXT.forceEvent += ' a3_portfolio_lazyautoload';

///////////////////////////
// GET THE URL PARAMETER //
///////////////////////////
function a3_portfolio_getUrlVars(hashdivider) {
	try { var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf(hashdivider) + 1).split('_');
		for(var i = 0; i < hashes.length; i++) {
			hashes[i] = hashes[i].replace('%3D',"=");
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	} catch(e) {
	}
}

//////////////////////////
// SET THE URL PARAMETER //
///////////////////////////
function a3_portfolio_updateURLParameter(paramVal){
	var yScroll=document.body.scrollTop;
	var baseurl = window.location.pathname.split("#")[0];
    var url = baseurl.split("#")[0];
    if ( typeof paramVal === 'undefined' ) paramVal="";
	if (paramVal.length==0)
	    par="#"
   	else
		  	par='#'+paramVal;
	if(history.pushState) {
		history.pushState(null, null, par);
	} else {
		location.hash = par;
	}
}

// CHECK IPHONE Return boolean TRUE/FALSE
function a3_portfolio_isiPhone(){
	return ( (navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPod") != -1) || (navigator.platform.indexOf("iPad") != -1) );
}

function a3_portfolio_is_iOS_8() {
		if ("600.1.4" == jQuery.browser.version || ~navigator.userAgent.indexOf('OS 8_') ){
		return true;
		}
		return false;
}

function a3_portfolio_detectMobile() {
	if( navigator.userAgent.match(/Android/i)
	 || navigator.userAgent.match(/webOS/i)
	 || navigator.userAgent.match(/iPhone/i)
	 || navigator.userAgent.match(/iPad/i)
	 || navigator.userAgent.match(/iPod/i)
	 || navigator.userAgent.match(/BlackBerry/i)
	 || navigator.userAgent.match(/Windows Phone/i)
	){
	    return true;
	}
	else {
	   return false;
	}
}

jQuery(document).ready(function () {
	// Disable auto Init of lazyloadxt
	jQuery.lazyLoadXT.autoInit=false;

	var $win = jQuery(window);
	var __container = jQuery('.a3-portfolio-box-content');
	var number_columns = a3_portfolio_script_params.number_columns;
	var screen_width = jQuery('html').width();
	var relayout;
	var load_deeplink = false;

	//Wordepress Adminbar
	var wpadminbar_height = 0;
	var wpadminbar = jQuery('#wpadminbar');
	if( wpadminbar.length > 0) wpadminbar_height = wpadminbar.outerHeight();


	var speed = 600;
	var header_offset = wpadminbar_height;
	var scrollspeed = 600;
	var force_scrolltotop = true;
	var deeplink = a3_portfolio_getUrlVars("#");
	var ie = !jQuery.support.opacity;
	var ie9 = (document.documentMode == 9);
	var isRTL = false;
	if ( a3_portfolio_script_params.rtl == 1 ) {
		isRTL = true;
	}

	if( (screen_width <= 767) && (screen_width >= 379) ){
		number_columns = 2;
	}

	jQuery('.a3-portfolio-menus-container').find('ul.filter li').each(function() {
		var filter_class = jQuery(this).children('a').attr('data-filter');
		if ( filter_class == '.a3-portfolio-item' || __container.find('.a3-portfolio-item' + filter_class).length > 0 ) {
			jQuery(this).show();
		}
	});

	if ( ! a3_portfolio_script_params.have_filters_script ) {
		__container.masonry({
			isRTL: isRTL,
			itemSelector: '.a3-portfolio-item',
			columnWidth: __container.parent().width()/number_columns,
			gutterWidth: (__container.width()-__container.parent().width())/number_columns,
			transitionDuration: 0
		});

		__container.masonry( 'on', 'layoutComplete', function( msrInstance, laidOutItems ){
			var selector = jQuery('.a3-portfolio-menus-container').find('li a.active').attr('data-filter');
			__container.find('.a3-portfolio-item').removeClass('a3-portfolio-item-first a3-portfolio-item-last');

			var all_items_selector = __container.find(selector);
			all_items_selector.each( function(index, value ){
				if( index == 0 ) {
					jQuery(this).addClass('a3-portfolio-item-first');
				}
				if( index == all_items_selector.length-1 ){
					jQuery(this).addClass('a3-portfolio-item-last');
				}
			});

			if (deeplink[0].split('item-').length>1) {
				if ( load_deeplink == false ) {
					load_deeplink = true;
					var current_item = parseInt(deeplink[0].split('item-')[1],0)+1;

					if( a3_portfolio_is_iOS_8() ){
						var active_larg_img = jQuery('.a3-portfolio-item:nth-of-type('+current_item+')').find('.active.item img');
					}else{
						var active_larg_img = jQuery('.a3-portfolio-item:nth-child('+current_item+')').find('.active.item img');
					}


					active_larg_img.attr("src", active_larg_img.attr("data-original"));
					active_larg_img.removeAttr("data-original");
					active_larg_img.removeClass("a3-portfolio-large-lazy");
					active_larg_img.imagesLoaded(function() {
						//console.log('Deep Link Image is loaded');
						setTimeout( function() {
					        if( a3_portfolio_is_iOS_8() ){
								jQuery('.a3-portfolio-item:nth-of-type('+current_item+')').trigger("click");
							}else{
								jQuery('.a3-portfolio-item:nth-child('+current_item+')').trigger("click");
							}
						}, 1000 );

				    });
				}
			}
		});
	}

	// Load all main thumb images after 1 seconds page is loaded
	$win.bind("load", function() {
		setTimeout( function() {
			jQuery("div.a3-portfolio-box-content img.a3-portfolio-thumb-lazy").on('lazyload', function() {
				//console.log('Loaded image ' + jQuery(this).attr("src"));
				jQuery(this).removeClass("a3-portfolio-thumb-lazy");
			}).lazyLoadXT({
				srcAttr: 'data-original',
				visibleOnly: false
			});
			jQuery(window).trigger('a3_portfolio_lazyautoload');
		}, 1000 );
	});

	// Load all large images after 10 seconds page is loaded
	$win.bind("load", function() {
		setTimeout( function() {
			jQuery("div.a3-portfolio-box-content img.a3-portfolio-large-lazy").on('lazyload', function() {
				//console.log('Loaded large image ' + jQuery(this).attr("src"));
				jQuery(this).removeClass("a3-portfolio-large-lazy");
			}).lazyLoadXT({
				srcAttr: 'data-original',
				visibleOnly: false
			});
			jQuery(window).trigger('a3_portfolio_lazyautoload');
		}, 10000 );
	});

	// Load all gallery thumb images after 15 seconds page is loaded
	$win.bind("load", function() {
		setTimeout( function() {
			jQuery("div.a3-portfolio-box-content div.a3-portfolio-gallery-thumb-lazy").on('lazyload', function() {
				//console.log('Loaded gallery thumb image ' + jQuery(this).css('background-image'));
				jQuery(this).removeClass("a3-portfolio-gallery-thumb-lazy");
			}).lazyLoadXT({
				srcAttr: 'data-original',
				visibleOnly: false
			});
			jQuery(window).trigger('a3_portfolio_lazyautoload');
		}, 15000 );
	});

	if ( ! a3_portfolio_script_params.have_filters_script ) {
		$win.bind("load", function() {
			var checkLoadAllImages = setInterval( function() {
				//console.log('Checking is loaded all images');
				if ( jQuery("img.a3-portfolio-thumb-lazy").length < 1 ) {
					//console.log('Clear interval check load all images');
					clearInterval(checkLoadAllImages);
					//console.log('Reload the layout again');
					__container.masonry();
				}
			}, 1000 );
		});
	}

	jQuery(document).on( 'click', '.pg_grid_content',function(){
		var active_larg_img_container = jQuery(this).parents('.a3-portfolio-inner-wrap').find( '.a3-portfolio-item-image-container');
		active_larg_img_container.find('img').attr('src',jQuery(this).attr('data-originalfull'));

		active_larg_img_container.find('.a3-portfolio-loading').fadeIn();
		active_larg_img_container.find('img').imagesLoaded(function() {
			active_larg_img_container.find('.a3-portfolio-loading').fadeOut();
		});
		jQuery(this).parent(".pg_grid").siblings(".pg_grid").removeClass('current_img');
		jQuery(this).parent(".pg_grid ").addClass('current_img');
		var caption_text = '';
		if( jQuery(this).attr('data-caption') != '' ){
			caption_text = '<div class="portfolio_caption_text">'+jQuery(this).attr('data-caption')+'</div>';
		}
		active_larg_img_container.find('.caption_text_container').html(caption_text);

		var pdv = jQuery('body').find('.a3-portfolio-expander-popup');
		var pdcc = pdv.find('.a3-portfolio-inner-wrap');
		var pdvpad = parseInt(pdcc.css('paddingBottom'),0) + parseInt(pdcc.css('paddingTop'),0);
		var offset = pdcc.height()+pdvpad + parseInt(pdv.css('marginBottom'),0);
		pdv.height(jQuery(".a3-portfolio-inner-wrap").outerHeight());
		if (pdv.height.length) {
			if ( a3_portfolio_script_params.have_filters_script ) {
				a3_portfolio_moveThumbs(__container,pdv.data('itemstomove'),offset);
			}
		}
		if(pdcc.width() <= 586 ){
			var thumb_active = __container.find('.a3-portfolio-item.active');
			var pdvScrollTop = thumb_active.offset().top-(header_offset+20)+(thumb_active.height()+20);
			jQuery('body,html').animate({
				scrollTop: pdvScrollTop
			}, {
				duration: speed,
				queue: false,
			});
		}
	});

	//Click Filter
	jQuery(document).on("click tap", ".a3-portfolio-navigation-mobile .a3-portfolio-icon-close", function(){
		jQuery( ".a3-portfolio-menus-container" ).slideUp( "fast", function() {
			jQuery( '.a3-portfolio-navigation-mobile-icon' ).removeClass('a3-portfolio-icon-close').addClass('a3-portfolio-icon-list');
		});
	});
	jQuery(document).on("click tap", ".a3-portfolio-navigation-mobile .a3-portfolio-icon-list", function(){
		jQuery( ".a3-portfolio-menus-container" ).slideDown( "fast", function() {
			jQuery( '.a3-portfolio-navigation-mobile-icon' ).removeClass('a3-portfolio-icon-list').addClass('a3-portfolio-icon-close');
		});
	});

	jQuery(document).on("click", ".a3-portfolio-menus-container li a", function(){
		var active_item = jQuery('.a3-portfolio-box-content').find('.a3-portfolio-item.active');

		a3_portfolio_updateURLParameter("");

		if( active_item.length > 0 ){
			jQuery('body').find('.a3-portfolio-activate-up-arrow').remove();
			var pdv = jQuery('body').find('.a3-portfolio-expander-popup');
			setTimeout(function() {
				if (pdv.length) {
					a3_portfolio_removeActiveThumbs(__container);
					clearInterval(pdv.data('interval'));
					pdv.animate({'height':'0px','opacity':'0'},{duration:speed, complete:function() { jQuery(this).remove();}});
					if ( a3_portfolio_script_params.have_filters_script ) {
						a3_portfolio_moveThumbs(__container,pdv.data('itemstomove'),0);
					}
				}
				setTimeout(function() {
					__container.data('height',__container.height());
				},speed);
				if (!ie && !ie9) a3_portfolio_updateURLParameter("");
			},150);
		}

		jQuery('.a3-portfolio-menus-container li a').removeClass('active');
		jQuery(this).addClass('active');

		if ( ! a3_portfolio_script_params.have_filters_script ) {
			var selector = jQuery(this).attr('data-filter');
			__container.find('.a3-portfolio-item').not(selector).hide();
			__container.find('.a3-portfolio-item'+selector).show();
			__container.masonry();
		}
		return false;
	});

	//Items Event
	jQuery(document).on("mouseenter touchstart", ".a3-portfolio-item", function(){
		jQuery(this).find('a.a3-portfolio-item-block').find('div.a3-portfolio-card-overlay').fadeIn(300);
	});
	jQuery(document).on("mouseleave", ".a3-portfolio-item", function(){
		if (!jQuery(this).hasClass("active")) jQuery(this).find('a.a3-portfolio-item-block').find('div.a3-portfolio-card-overlay').fadeOut(200);
	});

	jQuery(document).on("click tap", "div.a3-portfolio-item", function(){
		// The CLicked Thumb
		jQuery('body').find('.a3-portfolio-activate-up-arrow').remove();
		var thumb = jQuery(this);

		// IF THE CLICKED THUMB IS ALREADY SELECTED, WE NEED TO CLOSE THE WINDOWS SIMPLE
		if (thumb.hasClass("active")) {
			thumb.removeClass("active");
			a3_portfolio_closeDetailView(__container);
			// OTHER WAY WE CLOSE THE WINDOW (IF NECESsARY, OPEN AGAIN, AND DESELET / SELECT THE RIGHT THUMBS
		}  else {
			// load gallery thumb images for portfolio item when expand
			thumb.find('.a3-portfolio-loading').fadeIn();
			thumb.find("div.a3-portfolio-gallery-thumb-lazy").each(function(){
				if ( typeof jQuery(this).attr('data-bg') !== 'undefined' ) {
					jQuery(this).css('background-image', 'url('+jQuery(this).attr('data-bg')+')')
					jQuery(this).removeClass('a3-portfolio-gallery-thumb-lazy');
				}
			});

		 	a3_portfolio_updateURLParameter("item-"+thumb.index());
		 	thumb.addClass("latest-active");
		 	a3_portfolio_removeActiveThumbs(__container);
		 	thumb.removeClass("latest-active");
		 	thumb.addClass("active");

		 	var active_larg_img = thumb.find('.a3-portfolio-item-expander-content .active.item img');
		 	var activate_larg_original = active_larg_img.attr('data-original');
		 	if ( typeof activate_larg_original !== 'undefined' && activate_larg_original !== false ) {
				active_larg_img.attr("src", activate_larg_original );
				active_larg_img.removeAttr("data-original");
				active_larg_img.removeClass("a3-portfolio-large-lazy");
			}
			active_larg_img.imagesLoaded(function() {
				//console.log('Large Image is loaded');
			 	// CHECK IF WE ALREADY HAVE THE DETAIL WINDOW OPEN
				var pdv = jQuery('body').find('.a3-portfolio-expander-popup');
				if (pdv.length) {
					var fade=false;
					clearInterval(pdv.data('interval'));
					pdv.animate({'height':'0px','opacity':'0'},{duration:speed, complete:function() { jQuery(this).remove();}});
					var delay=speed+50;
					if ( a3_portfolio_script_params.have_filters_script ) {
						a3_portfolio_moveThumbs(__container,pdv.data('itemstomove'),0);
					}
					setTimeout(function() {
						if(jQuery('body').width() <= 767 ){
							var pdvScrollTop = thumb.offset().top-(header_offset+20)+(thumb.height()+20);
						}else{
							var pdvScrollTop = thumb.offset().top-(header_offset+20);
						}
					 	jQuery('body,html').animate({
	                    	scrollTop: pdvScrollTop
						}, {
							duration: scrollspeed,
							queue: false
						});
						if (force_scrolltotop) {
							a3_portfolio_openDetailView(__container,thumb,fade);
						} else {
							setTimeout(function () {
								a3_portfolio_openDetailView(__container,thumb,fade);
							},scrollspeed)
						}

					},delay)
				} else {
					if(jQuery('body').width() <= 767 ){
						var pdvScrollTop = thumb.offset().top-(header_offset+20)+(thumb.height()+20);
					}else{
						var pdvScrollTop = thumb.offset().top-(header_offset+20);
					}
					jQuery('body,html').animate({
						scrollTop: pdvScrollTop
					}, {
						duration: scrollspeed,
						queue: false
					});
					if (force_scrolltotop) {
						a3_portfolio_openDetailView(__container,thumb);
					} else {
						setTimeout(function () {
							a3_portfolio_openDetailView(__container,thumb);
						},scrollspeed)
					}
				}
			});
		}
		return false;
	}) // END OF CLICK ON PORTFOLIO ITEM

	jQuery( window ).on( "orientationchange", function( event ) {
		var number_columns = a3_portfolio_script_params.number_columns;
		var screen_width = jQuery('html').width();

		if(screen_width <= 767 && screen_width >= 379 ){
			number_columns = 2;
		}
		a3_portfolio_closeDetailView(__container);
		a3_portfolio_centerpdv(__container);
		if ( ! a3_portfolio_script_params.have_filters_script ) {
			setTimeout(function () {
				__container.masonry({
					isRTL: isRTL,
					itemSelector: '.a3-portfolio-item',
					columnWidth: __container.parent().width()/number_columns,
					gutterWidth: (__container.width()-__container.parent().width())/number_columns
				});
			},500);
		}
	});

	// ON RESIZE REMOVE THE DETAIL VIEW CONTAINER
	if( !a3_portfolio_detectMobile() ){
		var number_columns = a3_portfolio_script_params.number_columns;
		var screen_width = jQuery('html').width();

		if(screen_width <= 767 && screen_width >= 379 ){
			number_columns = 2;
		}
		if (!ie) {
			jQuery(window).bind('resize',function()  {
				if (!a3_portfolio_isiPhone()) {
					a3_portfolio_closeDetailView(__container);
					a3_portfolio_centerpdv(__container);
					if ( ! a3_portfolio_script_params.have_filters_script ) {
						__container.masonry({
							isRTL: isRTL,
							itemSelector: '.a3-portfolio-item',
							columnWidth: __container.parent().width()/number_columns,
							gutterWidth: (__container.width()-__container.parent().width())/number_columns
						});
					}
				}

			 });
		} else {
			if ( ! a3_portfolio_script_params.have_filters_script ) {
				__container.masonry({
					isRTL: isRTL,
					itemSelector: '.a3-portfolio-item',
					columnWidth: __container.parent().width()/number_columns,
					gutterWidth: (__container.width()-__container.parent().width())/number_columns
				});
			}
		}
	}

	// REMOVE ACTIVE THUMB EFFECTS
	function a3_portfolio_removeActiveThumbs(__container) {
		__container.find('.a3-portfolio-item').each(function() {
			jQuery(this).removeClass('active');
			if (!jQuery(this).hasClass('latest-active')) jQuery(this).find('div.a3-portfolio-card-overlay').fadeOut(200);
		});
	}

	// CLOSE DETAILVIEW
	function a3_portfolio_closeDetailView(__container) {
		jQuery('body').find('.a3-portfolio-activate-up-arrow').remove();
		jQuery('.a3-portfolio-container').removeClass('a3-portfolio-fixed-scroll');
		var pdv = jQuery('body').find('.a3-portfolio-expander-popup');
		setTimeout(function() {
			if (pdv.length) {
				a3_portfolio_removeActiveThumbs(__container);
				clearInterval(pdv.data('interval'));
				pdv.animate({'height':'0px','opacity':'0'},{duration:speed, complete:function() { jQuery(this).remove();}});
				if ( a3_portfolio_script_params.have_filters_script ) {
					a3_portfolio_moveThumbs(__container,pdv.data('itemstomove'),0);
				}
			}
			setTimeout(function() {
				__container.data('height',__container.height());
				setTimeout(function() {
					//__container.data('height',__container.height());
				},speed);  //500 old value
			},speed);
			if (!ie && !ie9) a3_portfolio_updateURLParameter("");
		},150)
	}

	function a3_portfolio_centerpdv(__container) {
		try {
			var pdv = jQuery('body').find('.a3-portfolio-expander-popup');
			var pleft=jQuery('body').width()/2 - pdv.width()/2;
			pdv.css({'left':pleft+"px"});
		} catch(e) {
		}
	}

	function add_arrow_active_thumb(thumb){
		//var pdv = jQuery('body').find('.a3-portfolio-expander-popup');
		var thumb = jQuery('body').find('.a3-portfolio-item.active');
		jQuery('body').find('.a3-portfolio-activate-up-arrow').remove();
		jQuery('body').append('<div class="a3-portfolio-activate-up-arrow" style="opacity: 0;"></div>');
		var arrow = jQuery('.a3-portfolio-activate-up-arrow');
		var thumb_pos_left = thumb.offset().left+((thumb.width()/2)-10);
		/*if(pdv.length){
			thumb_pos_top = pdv.offset().top-10;
		}else{
			thumb_pos_top = thumb.offset().top+thumb.height()+parseInt(thumb.css('marginBottom'),0)-10;
		}*/
		thumb_pos_top = thumb.offset().top+thumb.height()+parseInt(thumb.css('marginBottom'),0)-12;
		arrow.css({top:thumb_pos_top,left:thumb_pos_left,display:'block',opacity:1});
	}

	// OPEN THE DETAILVEW AND CATCH THE THUMBS BEHIND THE CURRENT THUMB
	function a3_portfolio_openDetailView(__container,thumb,fadeit) {
		jQuery('body').find('.a3-portfolio-activate-up-arrow').css({opacity:1});
		// The Top Position of the Current Item.
		currentTop= thumb.position().top;
		thumbOffsetTop= thumb.offset().top;
		// ALL ITEM WE NEED TO MOVE SOMEWHERE
		var itemstomove =[];
		__container.find('.a3-portfolio-item').each(function() {
			var curitem = jQuery(this);
			if (curitem.position().top>currentTop) itemstomove.push(curitem);
		});

		// Reset CurrentPositions
		jQuery.each(itemstomove,function() {
			var thumb = jQuery(this);
			thumb.data('oldPos',thumb.position().top);
		});

		// We Save the Height Of the current Container here.
		if ( typeof __container.data('height') !== 'undefined' ) {
			//if (__container.height()<__container.data('height')) 	__container.data('height',__container.height());
			__container.data('height',__container.height());
		} else {
			__container.data('height',__container.height());
		}

		// ADD THE NEW CONTENT IN THE DETAIL VIEW WINDOW.
		jQuery('body').append( a3_portfolio_script_params.expander_template ).find('.a3-portfolio-inner-wrap').append( thumb.children('.a3-portfolio-item-expander-content').html() );

		// CATCH THE DETAIL VIEW AND CONTENT CONTAINER
		var pdv = jQuery('body').find('.a3-portfolio-expander-popup');
		pdv.css({maxWidth:(jQuery('body').innerWidth())});
		var closeb = pdv.find('.closebutton');
		var pdcc = pdv.find('.a3-portfolio-inner-wrap');
		var pdvpad = parseInt(pdcc.css('paddingBottom'),0) + parseInt(pdcc.css('paddingTop'),0);

		var pvctrl = 0;
		if(pdcc.width() <= 586 ){
			pdv.addClass("a3-portfolio-expander-popup-mobile");
			var pvctrl = 50;
		}else{
			pdv.removeClass("a3-portfolio-expander-popup-mobile");
			var pvctrl = 0;
		}

		var offset = pdcc.height()+pvctrl+pdvpad + parseInt(pdv.css('marginBottom'),0);
		closeb.click(function() {
			a3_portfolio_closeDetailView(__container);
		});

		// ANIMATE THE OPENING OF THE CONTENT CONTAINER
		pdv.animate({'height':(pdcc.outerHeight(true)+pdvpad)+"px"},{duration:speed,queue:false});
		// SAVE THE ITEMS TO MOVE IN THE PDV
		pdv.data('itemstomove',itemstomove);
		//PUT THE CONTAINER IN THE RIGHT POSITION
		pdv.css({'top':(thumbOffsetTop+thumb.height()+parseInt(thumb.css('marginBottom'),0)-2)+"px"});
		add_arrow_active_thumb(thumb);

		a3_portfolio_centerpdv(__container);
		// FIRE THE CALLBACK HERE
		try{
			var callback = new Function(thumb.data('callback'));
			callback();
		} catch(e) {
		}

		jQuery.each(itemstomove,function() {
			var thumb = jQuery(this);
			if (ie ||ie9)
				thumb.data('top',parseInt(thumb.position().top,0));
			else
				//thumb.data('top',0);
				thumb.data('top',parseInt(thumb.position().top,0));
		});

		// MOVE THE REST OF THE THUMBNAILS
		if ( a3_portfolio_script_params.have_filters_script ) { 
			a3_portfolio_moveThumbs(__container,itemstomove,offset);
		}
		pdv.animate({'height':Math.round(pdcc.height()+pdvpad)+"px"},{
			duration:speed,
			queue:false,
			complete:function(){
				pdv.find('.a3-portfolio-loading').fadeOut();
			}
		});

		var portfolioId = pdv.find('.a3-portfolio-item-image-container').attr('data-portfolioId');

		var data = {
			action: 'a3_portfolio_set_cookie',
			portfolio_id: portfolioId,
			lang: a3_portfolio_script_params.lang
		};
		jQuery.post( a3_portfolio_script_params.ajax_url, data, function(response) {
			if( response == true || response == 'true'){
				//console.log('Cookie saved');
			}else{
				//console.log('Cookie not save!');
			}
		});
	}

	// MOVE THE THUMBS
	function a3_portfolio_moveThumbs(__container,itemstomove,offset) {
		jQuery.each(itemstomove,function() {
			var thumb = jQuery(this);
			thumb.stop(true);
			thumb.animate({'top':(thumb.data('top')+offset)+"px"},{duration:speed,queue:false});
		});

		if (ie || ie9) {
			__container.stop(true);
			__container.animate({'height':(__container.data('height')+offset)+"px"}, {duration:speed,queue:false});
		} else {
			__container.css({'height':Math.round(__container.data('height')+offset)+"px"});
		}
	}

});

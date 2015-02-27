jQuery( function( $ ){

	// Show & Hide Custom Meta Link
	$(document).on( 'change', '.a3-portfolio-meta-tag-link', function(){
		if ( $(this).val() != '0' ) {
			$(this).parents('tr').siblings('tr').find('.portfolio_meta_link_url_row').slideUp();
		} else {
			$(this).parents('tr').siblings('tr').find('.portfolio_meta_link_url_row').slideDown();
		}
	});

	// Product gallery file uploads
	var portfolio_gallery_frame;
	var $image_gallery_ids = $('#portfolio_image_gallery');
	var $portfolio_images = $('#portfolio_images_container ul.portfolio_images');

	$('.add_portfolio_images').on( 'click', 'a', function( event ) {
		var $el = $(this);
		var attachment_ids = $image_gallery_ids.val();

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( portfolio_gallery_frame ) {
			portfolio_gallery_frame.open();
			return;
		}

		// Create the media frame.
		portfolio_gallery_frame = wp.media.frames.portfolio_gallery = wp.media({
			// Set the title of the modal.
			title: $el.data('choose'),
			button: {
				text: $el.data('update'),
			},
			states : [
				new wp.media.controller.Library({
					title: $el.data('choose'),
					filterable :	'all',
					multiple: true,
				})
			]
		});

		// When an image is selected, run a callback.
		portfolio_gallery_frame.on( 'select', function() {

			var selection = portfolio_gallery_frame.state().get('selection');

			selection.map( function( attachment ) {

				attachment = attachment.toJSON();

				if ( attachment.id ) {
				attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

				$portfolio_images.append('\
					<li class="image" data-attachment_id="' + attachment.id + '">\
						<img src="' + attachment.url + '" />\
						<ul class="actions">\
							<li><a href="#" class="delete" title="' + $el.data('delete') + '">' + $el.data('text') + '</a></li>\
						</ul>\
					</li>');
				}

			});

			$image_gallery_ids.val( attachment_ids );
		});

		// Finally, open the modal.
		portfolio_gallery_frame.open();
	});

	// Image ordering
	$portfolio_images.sortable({
		items: 'li.image',
		cursor: 'move',
		scrollSensitivity:40,
		forcePlaceholderSize: true,
		forceHelperSize: false,
		helper: 'clone',
		opacity: 0.65,
		placeholder: 'metabox-sortable-placeholder',
		start:function(event,ui){
			ui.item.css('background-color','#f6f6f6');
		},
		stop:function(event,ui){
			ui.item.removeAttr('style');
		},
		update: function(event, ui) {
			var attachment_ids = '';

			$('#portfolio_images_container ul li.image').css('cursor','default').each(function() {
				var attachment_id = $(this).attr( 'data-attachment_id' );
				attachment_ids = attachment_ids + attachment_id + ',';
			});

			$image_gallery_ids.val( attachment_ids );
		}
	});

	// Remove images
	$('#portfolio_images_container').on( 'click', 'a.delete', function() {
		$(this).closest('li.image').remove();

		var attachment_ids = '';

		$('#portfolio_images_container ul li.image').css('cursor','default').each(function() {
			var attachment_id = $(this).attr( 'data-attachment_id' );
			attachment_ids = attachment_ids + attachment_id + ',';
		});

		$image_gallery_ids.val( attachment_ids );

		//runTipTip();

		return false;
	});
});

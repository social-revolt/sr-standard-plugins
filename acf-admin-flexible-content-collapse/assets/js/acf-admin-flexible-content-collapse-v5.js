(function($){

	var $el;

	if ( typeof acf.add_action !== 'undefined' ) {
		acf.add_action('ready append', function( $el ){

			var acf_settings_flex = acf.model.extend({
		 		
		 		actions: {
		 			'open_field':			'render',
		 			'change_field_type':	'render'
		 		},
		 				
		 		render: function( $el ){
		 			
		 			// bail early if not correct field type
		 			if( $el.attr('data-type') != 'flexible_content' ) {
		 				
		 				return;
		 				
		 			}

		 			if ($('.collapse-button-row').length == 0 ) {
		 				$('.acf-field-object-flexible-content .settings .acf-table tbody .acf-field-setting-required').after('<tr class="acf-field collapse-button-row"><td class="acf-label"><button type="button" role="button" class="button button-primary button-large flexible-setting-toggle"><span>'+acf_flex_collapse.collapseAll+'</span></button></td><td class="acf-input"></td></tr>');
		 			}
		 		 			
		 			prepareFlexibleFields();
		 			
		 		}
		 		
		 	});
			
		});
	}	

	$('a[data-name="acf-fc-collapse"]').live('click', function() {
		$el = $(this).closest('.acf-field[data-name="fc_layout"]');
		$el.toggleClass('-collapsed');
		$el.find('.acf-field-list-wrap').slideToggle();
		$el.find('.acf-fc-meta-name, .acf-fc-meta-display, .acf-fc-meta-min, .acf-fc-meta-max').slideToggle();
	});

	$('.flexible-setting-toggle').live('click', function(e) {
		
		button = $(this);
		$el = button.closest('.collapse-button-row');

		if ( button.hasClass('-collapsed') ) {
			button.removeClass('-collapsed');
			button.find('span').text(acf_flex_collapse.collapseAll);
			$el.siblings('.acf-field-setting-fc_layout').each(function() {
				$(this).find('.acf-field-list-wrap').slideDown();
				$(this).find('.acf-fc-meta-name, .acf-fc-meta-display, .acf-fc-meta-min, .acf-fc-meta-max').slideToggle();
			});
		} else {
			button.addClass('-collapsed');
			button.find('span').text(acf_flex_collapse.expandAll);
			$el.siblings('.acf-field-setting-fc_layout').each(function() {
					$(this).find('.acf-field-list-wrap').slideUp();
					$(this).find('.acf-fc-meta-name, .acf-fc-meta-display, .acf-fc-meta-min, .acf-fc-meta-max').slideUp();
			});
		}

	});

	$('.acf-field-setting-type .field-type').live('change', function( e ){
		if ( $(this).val() == 'flexible_content') {
			setTimeout(function(){
				prepareFlexibleFields();
			}, 500);
			
		} else {
			$('.collapse-button-row').remove();
		}
		
	});

	function prepareFlexibleFields() {

		var $acf_fl_actions = '<a class="acf-icon -arrow-combo flex" data-name="acf-fc-reorder" title="'+(acf_flex_collapse.reorder)+'"></a><a class="acf-icon -minus flex" data-name="acf-fc-delete" title="'+(acf_flex_collapse.delete)+'" href="#"></a><a class="acf-icon -duplicate flex" data-name="acf-fc-duplicate" title="'+(acf_flex_collapse.duplicate)+'" href="#"></a><a class="acf-icon -plus flex" data-name="acf-fc-add" title="'+(acf_flex_collapse.addnew)+'" href="#"></a><a class="acf-icon -collapse flex" data-name="acf-fc-collapse" title="'+(acf_flex_collapse.toggle)+'" href="#"></a>';

		$('.description.acf-fl-actions').html($acf_fl_actions);
		
	}

})(jQuery);
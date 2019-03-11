(function($){

	var $el;

	prepareFlexibleFields();

	$('a[data-name="acf-fc-collapse"]').live('click', function(e) {
		e.preventDefault();
		$el = $(this).closest('.field_option.field_option_flexible_content');
		$el.toggleClass('-collapsed').next('.acf-input').toggleClass('-collapsed');
		$el.find('.repeater').slideToggle();
		$el.find('.acf-fc-meta-name, .acf-fc-meta-display, .acf-fc-meta-min, .acf-fc-meta-max').parent().slideToggle().toggleClass('transparent-meta');
	});

	$('.flexible-setting-toggle').live('click', function(e) {
		
		button = $(this);
		$el = button.closest('.collapse-button-row');

		if ( button.hasClass('-collapsed') ) {
			button.removeClass('-collapsed');
			button.find('span').text(acf_flex_collapse.collapseAll);
			$el.siblings().each(function() {
				if ( $(this).is('[data-id]') ) {
					$(this).find('.repeater').slideDown();
					$(this).find('.acf-fc-meta-name, .acf-fc-meta-display, .acf-fc-meta-min, .acf-fc-meta-max').parent().slideDown().removeClass('transparent-meta');
				}
			});
		} else {
			button.addClass('-collapsed');
			button.find('span').text(acf_flex_collapse.expandAll);
			$el.siblings().each(function() {
				if ( $(this).is('[data-id]') ) {
					$(this).find('.repeater').slideUp();
					$(this).find('.acf-fc-meta-name, .acf-fc-meta-display, .acf-fc-meta-min, .acf-fc-meta-max').parent().slideUp().addClass('transparent-meta');
				}
			});
		}

	});

	$('.field_type .select').live('change', function( e ){
		if ( $(this).val() == 'flexible_content') {
			setTimeout(function(){
				prepareFlexibleFields();
			}, 500);
			
		} else {
			$('.collapse-button-row').remove();
		}
		
	});

	function prepareFlexibleFields() {

		var $acf_fl_actions = '<a class="acf-fc-reorder acf-icon -arrow-combo flex ui-sortable-handle" title="'+(acf_flex_collapse.reorder)+'" href="javascript:;"></a><a class="acf-fc-delete acf-icon -minus flex" title="'+(acf_flex_collapse.delete)+'" href="javascript:;"></a><a class="acf-fc-duplicate acf-icon -duplicate flex" title="'+(acf_flex_collapse.duplicate)+'" href="javascript:;"></a><a class="acf-fc-add acf-icon -plus flex" title="'+(acf_flex_collapse.addnew)+'" href="javascript:;"></a><a class="acf-icon -collapse flex" data-name="acf-fc-collapse" title="'+(acf_flex_collapse.toggle)+'" href="#"></a>';

		$('.field_option_flexible_content .desription').html($acf_fl_actions);

		$('.field_type-flexible_content .acf_field_form_table tr.required').after('<tr class="collapse-button-row"><td class="label min-padding"><button type="button" role="button" class="acf-button flexible-setting-toggle"><span>'+acf_flex_collapse.collapseAll+'</span></button></td><td></td></tr>');
	}

})(jQuery);
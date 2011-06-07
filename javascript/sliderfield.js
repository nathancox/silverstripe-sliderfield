(function($) {

$('.field.slider').livequery(function(){
	var slider = $('.sliderContainer', this);
	var field = $('.text', this);
	var valueField = $('.sliderContainerValue', this);
	var fieldEl = $(field).get(0);
	
	slider.data('valueField', valueField);
	slider.data('field', field);
	
	var prefix = fieldEl.getAttribute('-data-prefix');
	slider.data('prefix', prefix);
	
	var suffix = fieldEl.getAttribute('-data-suffix');
	slider.data('suffix', suffix);
	
	$(field).css('display', 'none');
	
	var minVal = 10;
	var minVal = fieldEl.getAttribute('-data-min') * 1;
	

	$(slider).slider({
		min: fieldEl.getAttribute('-data-min') * 1,
		max: fieldEl.getAttribute('-data-max') * 1,
		step: fieldEl.getAttribute('-data-step') * 1,
		value: $(field).val() * 1,
		slide: function( event, ui ) {
			$(this).data('field').val(ui.value);
			var valueString = ui.value;
			if ($(this).data('prefix')) {
				valueString = $(this).data('prefix') + valueString; 
			}
			if ($(this).data('suffix')) {
				valueString = valueString + $(this).data('suffix'); 
			}
			$(this).data('valueField').html(valueString);
		}
	});

});


})(jQuery);
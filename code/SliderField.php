<?php

class SliderField extends NumericField {
	/**
	 * Slider's minimum value
	 * @var integer
	 */
	var $min = 0;
	
	/**
	 * Slider's maximum value
	 * @var integer
	 */
	var $max = 100;
	
	/**
	 * Slider's step/increment
	 * @var integer
	 */
	var $step = 0;
	
	/**
	 * String prefixed to value for display only
	 * @var string
	 */
	var $prefix = null;
	
	/**
	 * String appended to value for display only
	 * @var string
	 */
	var $suffix = null;
	
	/**
	 * String representation of CSS width
	 * @var string
	 */
	var $width = "50%";
	
	/**
	 * Create a new field.
	 * @param string $name The internal field name, passed to forms.
	 * @param string $title The field label.
	 * @param string $value The value of the field.
	 * @param integer $min The minimum allowed value
	 * @param integer $max The maximum allowed value
	 * @param integer $step The increments to increase bye
	 * @param string $prefix Prefixed to the value for display purposes
	 * @param string $suffix Appended to the value for display purposes
	 * @param string $width CSS width for sizing the slider itself (default is "50%")
	 * @param Form $form Reference to the container form
	 * @param string $rightTitle
	 */
	function __construct($name, $title = null, $value = null, 
											$min = 0, $max = 100, $step = 1, $prefix = null, $suffix = null, $width = "50%",
											$form = null, $rightTitle = null) {
		
		$this->name = $name;
		$this->title = ($title === null) ? $name : $title;
		$this->setMinimum($min);
		$this->setMaximum($max);
		$this->setStep($step);
		$this->setPrefix($prefix);
		$this->setSuffix($suffix);
		$this->setWidth($width);

		if($value !== NULL) $this->setValue($value);
		if($form) $this->setForm($form);

		parent::__construct($name, $title, $value, $form, $rightTitle);
	}
	
	/**
	 * Define the minimum allowed value (default is 0)
	 * @param integer $min The slider's minimum value
	 */
	function setMinimum($min) {
		$this->min = $min;
	}
	
	/**
	 * Return the minimum value
	 * @return integer
	 */
	function getMinimum() {
		return $this->min;
	}
	
	
	/**
	 * Define the maximum allowed value (default is 100)
	 * @param integer $max The slider's maximum  value
	 */
	function setMaximum($max) {
		$this->max = $max;
	}
	
	/**
	 * Return the maximum value
	 * @return integer
	 */
	function getMaximum() {
		return $this->max;
	}
	
	
	/**
	 * Define the "step", ie the size of the units/increments for the slider (default is 1)
	 * @param integer $step The size of the steps/increments
	 */
	function setStep($step) {
		$this->step = $step;
	}
	
	/**
	 * Return the step
	 * @return integer
	 */
	function getStep() {
		return $this->step;
	}
	
	
	/**
	 * Define a prefix that is used for display on the field (note that this doesn't affect the actual value submitted)
	 * @param string $prefix The string prefixed to the value for display (eg, "$") 
	 */
	function setPrefix($prefix) {
		$this->prefix = $prefix;
	}
	
	/**
	 * Return the prefix
	 * @return string
	 */
	function getPrefix() {
		return $this->prefix;
	}
	
	
	/**
	 * Define a suffix that is used for display on the field (note that this doesn't affect the actual value submitted)
	 * @param string $suffix The string appended to the value for display (eg, "%") 
	 */
	function setSuffix($suffix) {
		$this->suffix = $suffix;
	}
	
	/**
	 * Return the suffix
	 * @return string
	 */
	function getSuffix() {
		return $this->suffix;
	}
	
	
	/**
	 * Define the CSS width for sizing the slider itself (default is "50%")
	 * @param string $width Any CSS width value (eg "75%", "200px") 
	 */
	function setWidth($width) {
		$this->width = $width;
	}
	
	/**
	 * Return the suffix
	 * @return string
	 */
	function getWidth() {
		return $this->width;
	}
	
	
	
	
	/**
	 * Return the value formatted with the prefix and suffix
	 * @return string
	 */
	function getFormattedValue() {
		return $this->getPrefix().$this->Value().$this->getSuffix();
	}
	
	
	function Field() {
		Requirements::javascript(THIRDPARTY_DIR.'/jquery/jquery.js');
		Requirements::javascript(THIRDPARTY_DIR.'/jquery-livequery/jquery.livequery.js');
		Requirements::javascript(THIRDPARTY_DIR.'/jquery-ui/minified/jquery.ui.core.min.js');
		Requirements::javascript(THIRDPARTY_DIR.'/jquery-ui/minified/jquery.ui.widget.min.js');
		Requirements::javascript(THIRDPARTY_DIR.'/jquery-ui/minified/jquery.ui.mouse.min.js');
		Requirements::javascript(THIRDPARTY_DIR.'/jquery-ui/minified/jquery.ui.slider.min.js');
		
		Requirements::css(THIRDPARTY_DIR.'/jquery-ui-themes/base/jquery.ui.theme.css');
		Requirements::css(THIRDPARTY_DIR.'/jquery-ui-themes/base/jquery.ui.slider.css');
		
		Requirements::javascript('sliderfield/javascript/sliderfield.js');
		
		
		$attributes = array(
			'type' => 'text',
			'class' => 'text' . ($this->extraClass() ? $this->extraClass() : ''),
			'id' => $this->id(),
			'name' => $this->Name(),
			'value' => $this->Value(),
			'tabindex' => $this->getTabIndex(),
			'maxlength' => ($this->maxLength) ? $this->maxLength : null,
			'size' => ($this->maxLength) ? min( $this->maxLength, 30 ) : null,
			
			'-data-min' => $this->min,
			'-data-max' => $this->max,
			'-data-step' => $this->step
		);
		
		if($this->disabled) {
			$attributes['disabled'] = 'disabled';
		}
		if($this->prefix) {
			$attributes['-data-prefix'] = $this->prefix;
		}
		if($this->suffix) {
			$attributes['-data-suffix'] = $this->suffix;
		}
		
		
		
		
		$html = $this->createTag('input', $attributes);
		$html .= '<div class="sliderContainer" id="'.$this->Name().'SliderContainer" style="width:'.$this->getWidth().';margin:3px;">
			<div class="sliderContainerValue" id="'.$this->Name().'SliderContainerValue" style="font-weight:bold;position:relative;left:100%;top:-3px;padding-left:4px;">'.$this->getFormattedValue().'</div>
		</div>';
		$html .= '';
		return $html;
	}
	
	function jsValidation() {
		
	}
	
}
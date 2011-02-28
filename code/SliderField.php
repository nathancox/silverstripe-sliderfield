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
	var $max = 0;
	
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
	 * Create a new field.
	 * @param string $name The internal field name, passed to forms.
	 * @param string $title The field label.
	 * @param string $value The value of the field.
	 * @param integer $min The minimum allowed value
	 * @param integer $max The maximum allowed value
	 * @param integer $step The increments to increase bye
	 * @param string $prefix Prefixed to the value for display purposes
	 * @param string $suffix Appended to the value for display purposes
	 * @param Form $form Reference to the container form
	 * @param string $rightTitle
	 */
	function __construct($name, $title = null, $value = null, 
											$min = 0, $max = 100, $step = 1, $prefix = null, $suffix = null,
											$form = null, $rightTitle = null) {
		
		$this->name = $name;
		$this->title = ($title === null) ? $name : $title;
		$this->setMinimum($min);
		$this->setMaximum($max);
		$this->setStep($step);
		$this->setPrefix($prefix);
		$this->setSuffix($suffix);

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
	 * Return the value formatted with the prefix and suffix
	 * @return string
	 */
	function getFormattedValue() {
		return $this->getPrefix().$this->Value().$this->getSuffix();
	}
	
	
	function Field() {
		Requirements::javascript(THIRDPARTY_DIR.'/jquery/jquery.js');
		Requirements::javascript(THIRDPARTY_DIR.'/jquery-livequery/jquery.livequery.js');
		Requirements::javascript(THIRDPARTY_DIR.'/jquery/jquery.ui.slider.js');
		
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
		$html .= '<div class="sliderContainer" id="'.$this->Name().'SliderContainer" style="width:50%;margin:3px;">
			<div class="sliderContainerValue" id="'.$this->Name().'SliderContainerValue" style="font-weight:bold;position:relative;left:100%;top:-3px;padding-left:4px;">'.$this->getFormattedValue().'</div>
		</div>';
		$html .= '';
		return $html;
	}
	
	function jsValidation() {
		
	}
	
}
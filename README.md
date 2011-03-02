SilverStripe jQuery UI Slider Field
===================================

Maintainer Contacts
-------------------
*  Nathan Cox (<nathan@flyingmonkey.co.nz>)

Requirements
------------
* SilverStripe 2.4+

Documentation
-------------
[GitHub Wiki](https://github.com/nathancox/silverstripe-sliderfield)

Installation Instructions
-------------------------

1. Place the files in a directory called sliderfield in the root of your SilverStripe installation
2. Visit yoursite.com/dev/build to rebuild the database

Usage Overview
--------------

		$fields->addFieldToTab('Root.Content.Discount', $slider = new SliderField('Discount'));
		
		// minimum allowed value (default is 0)
		$slider->setMinimum(1);
		
		// maximum allowed value (default is 100)
		$slider->setMaximum(25);
		
		// increments that the slider steps up in (default is 1)
		$slider->setStep(1);
		
		// prefixed to value when displayed on the field (default is empty);
		$slider->setPrefix('');
		
		// appended to value when displayed on the field (default is empty);
		$slider->setSuffix('%');
		
		// width of the slider (default is 50%)
		$slider->setWidth('50%');




Known Issues
------------
[Issue Tracker](https://github.com/nathancox/silverstripe-sliderfield/issues)
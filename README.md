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

1. Place this directory in the root of your SilverStripe installation
2. Visit yoursite.com/dev/build to rebuild the database

Usage Overview
--------------

		$fields->addFieldToTab('Root.Content.Main', $slider = new SliderField('SomePriceField', 'Pick a price between $1 and $100'));
		$slider->setMinimum(1);
		$slider->setMaximum(100);
		$slider->setStep(1);
		$slider->setPrefix('$');
		$slider->setSuffix('.00');

Known Issues
------------
[Issue Tracker](https://github.com/nathancox/silverstripe-sliderfield/issues)
<?php

/**
 * @package     {yourpackage}
 * @author      {yourname}
 * @copyright   {yourcopyright}
 * @license     {yourlicense}
 *
 */
defined('_JEXEC') or die;

//Load JTH base
require_once 'jth.php';

define('JDEV_DEBUG', 1); //1 DEBUG. Comment this line on production

/**
 * This is one example of class that extends JTH base class. Use this as
 * as a example and call this one, and not JTH directly.
 * @example
 * @code
 * //This code on your index.php template
 * require_once '/subfoldername/templatehelper.php';
 * $jth = new JTemplateHelper($this);
 * //print_r($jth);
 * @endcode
 */
final class JTemplateHelper extends JTH {

	function __construct($that = NULL) {
		parent::__construct($that);
		//...
	}
}
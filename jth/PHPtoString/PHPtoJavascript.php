<?php

/*
 * @package         PHPtoText
 * @author          Emerson Rocha Luiz - emerson at webdesign.eng.br - http://fititnt.org
 * @copyright       Copyright (C) 2011 Webdesign Assessoria em Tecnilogia da Informacao. All rights reserved.
 * @license         GNU General Public License version 3. See license-gpl3.txt
 * @license         Massachusetts Institute of Technology. See license-mit.txt
 * @version         0.1alpha
 * 
 */

require_once 'PHPtoString.php';

class PHPtoJavascript extends PHPtoString {
	
	protected $mimify;

	/**
	 *
	 */
	function __construct() {
		
	}

	public function getContent($option = array()) {
		$result = parent::getContent($option);
		if(!empty($this->mimify)){
			$result = $this->_mimify($result);
		}
		return $result;
	}

	/**
	 *
	 * @param type $options 
	 */
	public function mimify($options = array()) {
		$this->mimify = TRUE;
		return $this;
		//...
	}

	/**
	 * Mimimy Javascript
	 * 
	 * @see JSMin
	 * 
	 * @param string $content 
	 * @return string $minified
	 */
	protected function _mimify($content) {
//		$jsmin = $this->getHelper('jsmin');
		require_once '3rd/jsmin.php';
		$minified = JSMin::minify($content);
		return $minified;
	}

}

<?php

/**
 * @package     JTH
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2012 Webdesign Assessoria em Tecnilogia da Informacao. All rights reserved.
 * @license     GNU General Public License version 3. See license.txt
 */
defined('_JEXEC') or die;


/**
 * @todo  refractor this code for otimize when not called inside of JPlatform:
 *        - must be able to print base URL of site and from template
 *        - must be able to print base path
 *  
 */
abstract class JTH {

	/**
	 * URL base do template
	 *
	 * @var string 
	 */
	public $base;

	/**
	 * Generic Object to contain anything about envoriment
	 *
	 * @var object 
	 */
	public $env = NULL;

	/**
	 * Layout that must be loaded
	 *
	 * @var string 
	 */
	public $layout;

	/**
	 *
	 * @var array 
	 */
	protected $helpers = array();

	/**
	 *
	 * @var object 
	 */
	protected $templateThis;

	/**
	 *
	 * @var arrays 
	 */
	protected $positions;

	/**
	 * Array com conteudo para ser carregado ao final da pagina
	 * @see lastLoad()
	 * 
	 * @var arrays 
	 */
	protected $lastload = array();

	/**
	 * Alias to current JFactory::getApplication()
	 * For load this object, use function j()
	 * 
	 * @see j()
	 * @see JFactory::getApplication()
	 * 
	 * @var object JBrowser Object 
	 */
	protected $japplication = NULL;

	/**
	 * Alias to current JFactory::getBrowser()
	 * For load this object, use function j()
	 * 
	 * @see j()
	 * @see JBrowser::getInstance();
	 * 
	 * @var object JBrowser Object 
	 */
	protected $jbrowser = NULL;

	/**
	 * Alias to current JFactory::getDatabase()
	 * For load this object, use function j() 
	 * 
	 * @see j()
	 * @see JFactory::getDatabase()
	 * 
	 * @var object JDatabase Object 
	 */
	protected $jdatabase = NULL;

	/**
	 * Alias to current JFactory::getDocument()
	 * For load this object, use function j() 
	 * 
	 * @see j()
	 * @see JFactory::getDocument()
	 * 
	 * @var object JDocument Object 
	 */
	protected $jdocument = NULL;

	/**
	 * Alias to current JFactory::getLanguage()
	 * For load this object, use function j() 
	 * 
	 * @see j()
	 * @see JFactory::getLanguage()
	 * 
	 * @var object JDocument Object 
	 */
	protected $jlanguage = NULL;

	/**
	 * Alias to current JFactory::getSession()
	 * For load this object, use function j()
	 * 
	 * @see j()
	 * @see JFactory::getSession();
	 * 
	 * @var object JSession Object 
	 * 
	 */
	protected $jsession = NULL;

	/**
	 * Alias to current JFactory::getUser()
	 * For load this object, use function j()
	 * 
	 * @see j()
	 * @see JFactory::getUser();
	 * 
	 * @var object JUser Object 
	 */
	protected $juser = NULL;

	/**
	 * Template params
	 * 
	 * @var object 
	 */
	protected $params = NULL;

	/**
	 * Initialize values
	 * $that will nornaly be NULL if you accessing this variable from another
	 * plate that is not Joomla, like for use on JS and CSS file builders
	 * 
	 */
	function __construct($that = NULL) {
		if ($that !== NULL) {
			$this->templateThis = $that;
			$this->base = $that->baseurl . '/templates/' . $that->template;
			$this->layout = 'default';
			$this->set('positions', array('lr' => array('left', 'rigth')));
		}
	}

	/**
	 *
	 * @todo terminar ...
	 * 
	 * @param string $group
	 * @return int 
	 */
	public function col($group) {
		if (!$this->positions) {
			return -2; //Nao foi inicializado
		} else if (!isset($this->positions[$group])) {
			return -1; //Grupo nao encontrado
		} else {
			return count($this->positions[$group]);
		}
	}

	/**
	 * Gera string contendo o CSS necessario para ser impresso em um
	 * arquivo especifico, e evitar javascript inline
	 * 
	 * @return string 
	 */
	public function CSS() {
		return 'teste';
	}

	/**
	 * Delete (set to NULL) generic variable
	 * 
	 * @param String $name: name of var do delete
	 * @return Object $this
	 */
	public function del($name) {
		if (isset($this->$name)) {
			$this->$name = NULL;
		}
		return $this;
	}

	/**
	 * Joomla JInput
	 * 
	 * @see http://docs.joomla.org/JInput_Background_for_Joomla_Platform
	 * 
	 * @example
	 * @code
	 * require_once '/helpers/templatehelper.php';//JTemplateHelper extends JTH
	 * $jth = new JTemplateHelper($this);
	 * echo $jth->i('option');//con
	 * @endcode
	 * 
	 * @param string $name
	 * @param string $filter Filter to use. Options: INT, INTEGER, UINT, FLOAT,
	 *               DOUBLE, BOOL, BOOLEAN, WORD, ALNUM, CMD, BASE64, STRING,
	 *               HTML, ARRAY, PATH, USERNAME
	 * @return object 
	 */
	public function i($name, $filter = NULL) {
		$jinput = JFactory::getApplication()->input;
		return $jinput->get($name, '', $filter);
	}

	/**
	 * Return generic variable
	 * 
	 * @param String $name: name of var to return
	 * @return Mixed this->$name: value of var
	 */
	public function get($name) {
		return $this->$name;
	}

	/**
	 * Get actual context
	 * 
	 * @code
	 * require_once '/helpers/templatehelper.php';//JTemplateHelper extends JTH
	 * $jth = new JTemplateHelper($this);
	 * echo $jth->getContext();//com_content-article
	 * @endcode
	 * 
	 * @return string 
	 */
	public function getContext() {
		$context = $this->i('option');
		$context .= '-' . $this->i('view');
		if ($this->i('layout')) {
			$context .= '-' . $this->i('layout');
		}
		if ($this->i('format')) {
			$context .= '-' . $this->i('format');
		}
		return $context;
	}

	/**
	 * Retunr instance of one predefined helper, creating if does not exist
	 * Options:
	 *  - phptostring: PHPtoString lib under folder PHPtoString
	 *  - phptojavascript: PHPtoString lib under folder PHPtoString
	 * 
	 * 
	 * @see JTHFile
	 * 
	 * @param string $name Name of the helper to load
	 * @return object 
	 */
	public function getHelper($name) {
		$name = strtolower($name);
		switch ($name) {
//			case 'file':
//				if (!isset($this->helpers['file'])) {
//					require_once 'file.php';
//					$this->helpers['file'] = new JTHFile;
//				}
//				return $this->helpers['file'];
//				break;
//			case 'jsmin':
//				if (!isset($this->helpers['jsmin'])) {
//					require_once 'jsmin.php';
//					$this->helpers['jsmin'] = new JSMin;
//				}
//				return $this->helpers['phptostring'];
//				break;
			case 'phptostring':
				if (!isset($this->helpers['phptostring'])) {
					require_once 'PHPtoString/PHPtoString.php';
					$this->helpers['phptostring'] = new PHPtoString;
				}
				return $this->helpers['phptostring'];
				break;
			case 'phptojavascript':
				if (!isset($this->helpers['phptojavascript'])) {
					require_once 'PHPtoString/PHPtoJavascript.php';
					$this->helpers['phptojavascript'] = new PHPtoJavascript;
				}
				return $this->helpers['phptojavascript'];
				break;
			default:
				//Error. $name do not match. Revise your code
				return FALSE;
				break;
		}
	}

	/**
	 * Pega variavel da sessao. Retorna NULL caso nao esteja definida
	 * 
	 * @todo fititnt: terminar...
	 * 
	 * @param String $name: name of var to return
	 * @return Mixed this->$name: value of var
	 */
	public function getSessionData($name) {
		//...
		return $this->$name;
	}

	/**
	 * Pega variavel de cookies. Retorna NULL caso nao esteja definida
	 * 
	 * @todo fititnt: terminar...
	 * 
	 * @param String $name: name of var to return
	 * @return Mixed this->$name: value of var
	 */
	public function getCookieData($name) {
		//...
		return $this->$name;
	}

	/**
	 * Retorna um link comum convertido para mobile. Basta deixar nao nulo ou o 
	 * parametro $prefixoMobile ou $variavelMobile
	 * 
	 * @var string $prefixoMobile
	 * @param string $variavelMobile
	 * @param string $url
	 * @return string $url
	 */
	public function mobileUrl($prefixoMobile = NULL, $variavelMobile = NULL, $url = NULL) {

		if ($url === NULL) {
			$u = &JURI::getInstance();
			$url = $u->toString();
		}

		if ($prefixoMobile !== NULL) {
			$url = str_replace('http://www', $prefixoMobile, $url); //Tenta remover tambem www
			$url = str_replace('http://', $prefixoMobile, $url); //Se a anterior falhar, usa apenas o http://        
		} elseif ($variavelMobile !== NULL) {
			$u = &JURI::getInstance($url);
			$u->setVar($variavelMobile, 1);
			$url = $u->toString();
		} else {
			return FALSE; //Erro: ambos os parametros foram omitidos
		}
		return $url;
	}

	/**
	 * Converte um link mobile para um nao mobile. Se nao for especificado, usa 
	 * a URL atual
	 *
	 * @param type $prefixoMobile
	 * @param type $variavelMobile
	 * @param type $url
	 * @return type 
	 */
	public function desktopUrl($prefixoMobile, $variavelMobile, $url = NULL) {

		if ($url === NULL) {
			$u = &JURI::getInstance();
			$url = $u->toString();
		}
		$url = str_replace($prefixoMobile, 'http://', $url); //Remove prefixo, se existir
		$u = &JURI::getInstance($url);
		$u->delVar($variavelMobile);
		$resultado = $u->toString();

		return $resultado;
	}

	/**
	 * Return some Joomla common instances
	 * Options:
	 *          - document
	 *          - session
	 *          - user
	 * 
	 * @example
	 * @code
	 * //Conditional for Internet Explorer < 9
	 * require_once '/helpers/templatehelper.php';//JTemplateHelper extends JTH
	 * $jth = new JTemplateHelper($this);
	 * if($jth->j('browser')->getBrowser() == 'msie' && $jth->j('browser')->getMajor() < 9){
	 *     <link rel="stylesheet" href="ie.css" type="text/css" />
	 * }
	 * 
	 * @endcode
	 * 
	 * 
	 * @param type $name
	 * @return object 
	 */
	public function j($name) {
		switch ($name) {
			case 'app':
			case 'application':
				if ($this->japplication === NULL) {
					$this->japplication = JFactory::getApplication();
				}
				return $this->japplication;
				break;
			case 'browser':
				if ($this->jbrowser === NULL) {
					jimport('joomla.environment.browser');
					$this->jbrowser = JBrowser::getInstance();
				}
				return $this->jbrowser;
				break;
			case 'db':
			case 'dba':
			case 'database':
				if ($this->jdatabase === NULL) {
					$this->jdatabase = JFactory::getDbo();
				}
				return $this->jdatabase;
				break;
			case 'doc':
			case 'document':
				if ($this->jdocument === NULL) {
					$this->jdocument = JFactory::getDocument();
				}
				return $this->jdocument;
				break;
			case 'lang':
			case 'language':
				if ($this->jlanguage === NULL) {
					$this->jlanguage = JFactory::getLanguage();
				}
				return $this->jlanguage;
				break;
			case 'session':
				if ($this->jsession === NULL) {
					$this->jsession = JFactory::getSession();
				}
				return $this->jdocument;
				break;
			case 'user':
				if ($this->juser === NULL) {
					$this->juser = JFactory::getUser();
				}
				return $this->juser;
				break;
			default:
				//Error. $name do not match. Revise your code
				return FALSE;
				break;
		}
	}

	/**
	 * Gera string contendo o javascript necessario para ser impresso em um
	 * arquivo especifico, e evitar javascript inline
	 * 
	 * @return string 
	 */
	public function JS($options = array()) {
//		if(isset($options['libraries'])){
//			require_once $options['libraries'] . '/import.php';
//		} else {
//			require_once '/../../../libraries/import.php';
//		}
		return 'Extend me please';
	}

	/**
	 * Method to load JPlatform if already not loaded. Useful when not trying
	 * to access from inside of framework Joomla 
	 * 
	 * @todo Add way to overide constants
	 */
	public function loadJPlatform($path = NULL) {

		//If JFactory exist, exit
		if(class_exists('JFactory')){
			return NULL;
		}
		

		defined('JPATH_BASE') or define('JPATH_BASE', "D:/dev/apache/htdocs/fititnt.dev/bancada42" );//@todo resolver essa parte harcoded
		define('JPATH_SITE', JPATH_BASE );
		define('JPATH_ADMINISTRATOR', JPATH_BASE . '/administrator' );
		define('JPATH_INSTALLATION', JPATH_BASE . '/installation' );
		define('JPATH_CACHE', JPATH_BASE . '/cache' );
		define('JPATH_THEMES', JPATH_BASE . '/templates' );
		define('JPATH_CONFIGURATION', JPATH_BASE);
		
		//Importa a biblioteca Joomla
		if ($path !== NULL) {
			require_once $path . '/import.php';
		} else {
			require_once '/../../../libraries/import.php';
		}
	}

	/**
	 * Array with content to be load at the end of page
	 * 
	 * @param array $override
	 */
	public function loadLast($override = NULL) {
		if (!$override) {
			$html = $this->lastload;
		}
		$html = implode(PHP_EOL, $result);
		echo $html;
	}

//	public function loadJBrowser() {
//		if ($this->jbrowser === NULL) {
//			jimport('joomla.environment.browser');
//			$this->jbrowser = JBrowser::getInstance();
//		}
//		return $this;
//	}

	/**
	 * 
	 */
	public function injectScript($path = NULL, $content = NULL) {
		if ($path === NULL && $content === NULL) {
			$this->lastload[] = 'injectScript: $path & $content are null!';
			return $this;
		}
		if (!is_null($path)) {
			$this->lastload[] = '<script src="' . $path . '"/>';
		}
		if (!is_null($content)) {
			$this->lastload[] = '<script>"' . $content . '</script>';
		}
		return $this;
	}

	/**
	 * Return if is frontpage or not of the site
	 * 
	 * @see http://docs.joomla.org/How_to_determine_if_the_user_is_viewing_the_front_page
	 * 
	 * @param string $languageTag Specify witch lanaugage must be checked if is
	 *                            the frontpage, for example 'pt-BR'. Default
	 *                            is NULL, for check frontpage of any current
	 *                            language
	 * @return boolean $frontpage
	 */
	public function isFrontpage($languageTag = NULL) {
		$menu = $this->j('app')->getMenu();
		$lang = $this->j('lang');
		$languageTag = $languageTag ? $languageTag : $lang->getTag();
		if ($menu->getActive() == $menu->getDefault($languageTag)) {
			$frontpage = true;
		} else {
			$frontpage = false;
		}
		return $frontpage;
	}

	/**
	 * Set one generic variable the desired value
	 * 
	 * @param String $name: name of var to set value
	 * @param Mixed $value: value to set to desired variable
	 * @return Object $this
	 */
	public function set($name, $value) {
		$this->$name = $value;
		return $this;
	}

	/**
	 * Seta variavel na sessao
	 * 
	 * @todo fititnt: terminar...
	 * 
	 * @param String $name: name of var to return
	 * @return Mixed this->$name: value of var
	 */
	public function setSessionData($name) {
		//...
		return $this->$name;
	}

	/**
	 * Set $this->env variable. By default is not called, but you cand extend on
	 * your class and use as generic place for put anyting that does not deserve
	 * one entire variable 
	 */
	protected function setEnv() {
		if ($this->env === NULL) {
			$this->env = new stdClass;
		}
	}

	/**
	 * Seta variavel nos cookies
	 * 
	 * @todo fititnt: terminar...
	 * 
	 * @param String $name: name of var to return
	 * @return Mixed this->$name: value of var
	 */
	public function setCookieData($name) {
		//...
		return $this->$name;
	}

	/**
	 * @deprecated
	 * 
	 * @param type $id
	 * @return type 
	 */
	public function user($id = NULL) {
		$user = JFactory::getUser($id);
		$this->user = $user;
		return $this;
	}

}

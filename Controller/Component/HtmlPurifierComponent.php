<?php
App::import('Vendor', 'HtmlPurifier.HTMLPurifier', array('file' => 'HtmlPurifier'.DS.'library'.DS.'HTMLPurifier.standalone.php'));
//App::uses('HTMLPurifier.standalone', 'Vendor/HtmlPurifier');

class HtmlPurifierComponent extends Component {

	var $config = array(
		'Core.Encoding' => 'utf-8',
		'HTML.DefinitionID' => 'CakePHP',
		'HTML.DefinitionRev' => 1,
		'HTML.TidyLevel' => 'light',
		'HTML.Doctype' => 'XHTML 1.0 Transitional',
		'Output.TidyFormat' => false,
	);

	var $Purifier;

	var $PurifierConfig;

	function initialize(&$controller, $settings = array()) {
		$this->config = array_diff($this->config, $settings);
		foreach ($settings as $setting => $value) {
			$this->config[$setting] = $value;
		}
	}

	function startup(&$controller) {
		$this->PurifierConfig = HTMLPurifier_Config::createDefault();
		foreach ($this->config as $k => $v) {
			$this->PurifierConfig->set($k, $v);
		}
		$this->Purifier =& new HTMLPurifier($this->PurifierConfig);
	}

	function beforeRender(&$controller) {
	}

	function shutdown(&$controller) {
	}

	function purify($data) {
		return $this->Purifier->purify($data);
	}

}
?>

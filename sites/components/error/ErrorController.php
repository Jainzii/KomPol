<?php

class ErrorController {

	private $errorList;
	private $errorTemplate;

	function __construct() {
		$this->errorList = [];
		$this->errorTemplate = "../../components/error/error.php";
	}

	function addErrorMessage($id, $error) {
		$this->errorList[$id] = $error;
	}

	function resetErrors() {
		$this->errorList = [];
	}

	function hasErrors() {
		return !empty($this->errorList);
	}

	function showErrorBox() {
		ob_start();
		include $this->errorTemplate;
		$errorBox = ob_get_contents();
		ob_end_clean();

		return $errorBox;
	}

}
<?php

class View {

	private $template = 'sites/home.php';
	private $data = [];
	private $stylesheets = ["sites/main.css"];
	private $errors;
	private $info;

	public function assign($key, $value) {
		$this->data[$key] = $value;
	}

	public function addStylesheet($value) {
		$this->stylesheets[] = $value;
	}

	public function setTemplate($template = 'sites/home.php') {
		$this->template = $template;
	}

	public function loadTemplate() {
		if (file_exists($this->template)) {
			$this->errors = isset($_SESSION["errors"]) ? $_SESSION["errors"] : null;
			$this->info = isset($_SESSION["info"]) ? $_SESSION["info"] : null;
			ob_start();

			include_once "sites/components/header/header.php";
			if (isset($this->errors)) {
				include_once "sites/components/error/error.php";
			}
			if (isset($this->info)) {
				include_once "sites/components/info/info.php";
			}
			include_once $this->template;
			include_once "sites/components/footer/footer.php";

			$output = ob_get_contents();
			ob_end_clean();

			return $output;
		} else {
			return "FEHLER";
		}
	}
}
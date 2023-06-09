<?php

class View {

	private $template = 'sites/home.php';
	private $data = [];

	public function assign($key, $value) {
		$this->data[$key] = $value;
	}

	public function setTemplate($template = 'sites/home.php') {
		$this->template = $template;
	}

	public function loadTemplate() {
		if (file_exists($this->template)) {
			ob_start();
			include_once $this->template;
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		} else {
			return "FEHLER";
		}
	}
}
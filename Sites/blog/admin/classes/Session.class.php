<?php

class Session{
	public $template = '<div class="%s alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>%s</h4><p>%s</p></div>';


	public function flash(){
		if(isset($_SESSION['Flash'])){
			extract($_SESSION['Flash']);
			unset($_SESSION['Flash']);

			return vsprintf($this->template, ['alert alert-' . $alert, $type, $message]);
			// return '<div class="alert alert-'.$type.'">'.$message.'</div>';
		}
	}

	public function setFlash($message, $alert, $type){
		$_SESSION['Flash']['message'] = $message;
		$_SESSION['Flash']['alert'] = $alert;
		$_SESSION['Flash']['type'] = $type;

		return $this;
	}

	public function redirect($where) {
		header('Location: ' . $where);
		die();
	}
}

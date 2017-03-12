<?php
class form{

	private $data = array();
	public $errors;

	function set(array $datas) {
		foreach($datas as $key => $value) {
			$this->data[$key] = $value;
		}
	}

	function input($type, $field, $label=null, $attributs = array()){
		$r = '';

		if($label!=null){
			$r = '<label for="form'.$field.'">'.$label.'</label>';
		}
		$r .= '<input type="'.$type.'" name="'.$field.'" id="form'.$field.'"';
		if(isset($this->data[$field])){
			$r .= ' value="'.$this->data[$field].'"';
		}
		foreach($attributs as $k=>$v){
			$r .= ' '.$k.'="'.$v.'"';
		}
		$r .= '/>';

		return $r;
	}

	function text($field, $label=null,$attributs = array() ){
		$value = isset($_POST[$id]) ? $_POST[$id] : '';
		$r = '';
		if($label!=null){
			$r = '<label for="form'.$field.'">'.$label.'</label>';
		}
		$r .='<textarea name="'.$field.'" id="form'.$field.'"';
		 foreach($attributs as $k=>$v){
			$r .= ' '.$k.'="'.$v.'"';
		}
		$r .= '></textarea>';
		return $r;
	}

	function submit($type, $value){
		$r = '<input type="'.$type.'" value="'.$value.'">';
		return $r;
	}
}
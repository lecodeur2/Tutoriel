<?php

class form{

	function input($id=null, $type,$field,$label=null, $attributs = array() ){
		$value = isset($_POST[$id]) ? $_POST[$id] : '';
		$r = '';
		if($label!=null){
			$r = '<label for="form'.$field.'">'.$label.'<label>';
		}
		$r .= '<input type="'.$type.'" name="'.$field.'" value="'.$id.'" id="form'.$field;
		foreach($attributs as $k=>$v){
			$r .= ' '.$k.'="'.$v.'"';
		}
		$r .= '"/>';
		return $r;
	}
}
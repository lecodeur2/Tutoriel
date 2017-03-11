<?php

class form{

	function input($type,$field,$label=null, $attributs = array() , $id=null){
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

	function text($field, $label=null,$attributs = array() , $id=null){
		$value = isset($_POST[$id]) ? $_POST[$id] : '';
		$r = '';
		if($label!=null){
			$r = '<label for="form'.$field.'">'.$label.'<label>';
		}
		$r .='<textarea name="'.$field.'" value="'.$id.'" id="form'.$field;
		 foreach($attributs as $k=>$v){
			$r .= ' '.$k.'="'.$v.'"';
		}
		$r .= '>'.$value.'</textarea>';
		return $r;
	}

	function submit($type, $value){
		$r = '<input type="'.$type.'" value="'.$value.'">';
		return $r;
	}
}
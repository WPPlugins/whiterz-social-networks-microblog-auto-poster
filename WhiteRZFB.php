<?php
	class WhiterzForm {
		var $form_variable = array();
			var $output; function build(){
				$output='';
			$form = $this->form_variable;
				global $form_size;
			if(array_key_exists('element_size', $form)){
				$size='span'.$form['element_size'];
					}else{
				$size='';
			}
		$form_size=$size;
			foreach($form['elements'] as $key => $element): $output .='
			<div class=" row-fluid"> <div class="form-group">
			<label for="Whiterz_'.$key.'">'.$element['title'].'</label>';
	switch ($element['type']){
	case 'radio':  $output .= $this->add_radio($element);
	break;
		case 'text':
			$output .= $this->add_textbox($element,$key);
	break;
		case 'password':
			$output .= $this->add_passwd($element,$key);
	break;
		case 'button':  
			$output .= $this->add_button($element,$key);
	break;
		case 'textarea':
			$output .= $this->add_textarea($element,$key);
	break;
}
	$output .='</div>';
	endforeach;
		$this->output=$output;
}
function add_radio($array){ $output='';
		foreach($array['option'] as $val => $label):
			$check= ($array['default']==$val) ? 'checked="checked"' : '"" ';
				$output .= '<label class="radio">
				<input name="'.$array['name'].'" type="radio" value="'.$val.'" '. $check . ' />'.$label.'</label>';
		endforeach; 
				$output .='</div>'; return $output;
		}
function add_textbox($array,$name){
	global $form_size; $output='';
	$output .='<input name="'.$name.'" type="text" id="Whiterz_'. $name .'" value="'.$array['default'].'" class="form-control" />';

		if(array_key_exists('desc', $array)){ $output .='<div id="bottom">'. $array['desc'] .'</div>'; }

	$output .='</div>';
	return $output;
}
function add_passwd($array,$name){
	global $form_size;
		$output='';
		$output .='<input name="'.$name.'" type="password" id="Whiterz_'. $name .'" value="'.$array['default'].'" class="form-control" />';
			if(array_key_exists('desc', $array)){ $output .='<p class="help-block">'. $array['desc'] .'</p>'; }
		$output .='</div>'; return $output; } function add_textarea($array,$name){ global $form_size; $output='';
		$output .='<textarea name="'.$name.'" id="Whiterz_'. $name .'" cols="'.$array['opt']['cols'].'" rows="'.$array['opt']['rows'].'" class="form-control">'.$array['default'].'</textarea>';
			if(array_key_exists('desc', $array)){ $output .='<p class="help-block">'. $array['desc'] .'</p>'; } $output .='</div>';
		return $output;
}
function add_button($array,$name){
	global $form_size; $output='';
		$output .='<p class="submit">
		<input type="'.$array['action'].'" id="Whiterz_'.$name.'" class="btn btn-primary btn-large" value="'.$array['btnlabel'].'"/></p>';
		$output .='</div>';
			return $output;
	}
function output(){
	echo $this->output;
	}
}
?>
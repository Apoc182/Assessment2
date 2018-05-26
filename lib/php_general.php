<?php

	//Pass this function what you need as a select list and it will generate it.
	function dynamicSelect($list, $name, $placeholder){
		
		
		$html = "<select name='" . $name . "'> <option value='' selected>" . $placeholder . "</option>";
		foreach($list as $item){
			$html .= "<option value='" . $item . "'>" . $item . "</option>";					
		}
		
		$html .= "</select>";
		
		return $html;
		
		
	}

	




?>
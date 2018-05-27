<?php

	//Pass this function what you need as a select list and it will generate it.
	function dynamicSelect($list, $name, $placeholder, $required){
		
		if($required){
			
			$init = "<select required ";
			
		}else{
			
			$init = "<select ";
			
		}
		$html = $init . "name='" . $name . "'> <option value='' selected>" . $placeholder . "</option>";
		foreach($list as $item){
			$html .= "<option value='" . $item . "'>" . $item . "</option>";					
		}
		
		$html .= "</select>";
		
		return $html;
		
		
	}
	
	//This function calculates the distance between the user and a location and returns it.
	function distance($lat1, $lon1, $lat2, $lon2){
	
		$R = 6371e3; // metres
		$φ1 = deg2rad($lat1);
		$φ2 = deg2rad($lat2);
		$Δφ = deg2rad($lat2-$lat1);
		$Δλ = deg2rad($lon2-$lon1);

		$a = sin($Δφ/2) * sin($Δφ/2) +
			 cos($φ1) * cos($φ2) *
			 sin($Δλ/2) * sin($Δλ/2);
		$c = 2 * atan2(sqrt($a), sqrt(1-$a));

		$d = $R * $c;
		
		$distance = $d/1000;
		
		return $distance;

	
	}
	




?>
<?php 
if (is_array($_POST['chkAmenazas'])) {
	if(!empty($_POST['chkAmenazas'])) {
		foreach($_POST['chkAmenazas'] as $check) {
			echo $check . "\n"; 
			print_r($_POST['chkAmenazas']);
		}
	}
}else{
	echo "no es array.";
}
?>


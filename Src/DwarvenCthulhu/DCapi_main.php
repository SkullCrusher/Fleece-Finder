<?php






/*

$array_1 = array( 'Array1' => 'ray1', 'Array1_1' => 'ray1_2');

$array_2 = array('Array2' => 'ray2', 'Array2_2' => 'ray2_2');


$array_objects = array('Faggots' => $array_1, 'ButtPirates' => $array_2);

print_r(json_encode($array_objects));
echo "ss";

*/

//How server settings are packed.

$array_1 = array( 'Wool (unfinished)', 'Wool (finished)', 'Hand knit', 'Spinning Equipment');

$array_2 = array('Categories' => $array_1);


//$array_objects = array('Faggots' => $array_1);

print_r(json_encode($array_2));






//echo json_encode(array(4 => "four", 8 => "eight", 'index' => "eight", 'sdd' => "eight"));

?>

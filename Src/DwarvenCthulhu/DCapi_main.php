<?php

echo "DD";
/*

$jsontest = '
    [
  {
    "longitude": 22.000869,
    "tags": [
      "et",
      "do"
    ]
  },
  {
    "longitude": -6.590635,
    "tags": [
      "cillum",
      "dolore"
    ]
  }
]';

$arrays = json_decode( $jsontest, true);

print_r($arrays[1]);

//print_r($arrays);
*/











$array_1 = array( 'Array1' => 'ray1', 'Array1_1' => 'ray1_2');

$array_2 = array('Array2' => 'ray2', 'Array2_2' => 'ray2_2');

$array_objects = array('Faggots' => $array_1, 'ButtPirates' => $array_2);

print_r(json_encode($array_objects));
echo "ss";

//echo json_encode(array(4 => "four", 8 => "eight", 'index' => "eight", 'sdd' => "eight"));

?>

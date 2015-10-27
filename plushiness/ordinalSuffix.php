<?php
	function addOrdinalNumberSuffix($num) {
		if (!in_array(($num % 100),array(11,12,13))){
			switch ($num % 10) {
				// Handle 1st, 2nd, 3rd
				case 1:  return $num.'<sup> <em>st </em></sup>';
				case 2:  return $num.'<sup> <em>nd </em></sup>';
				case 3:  return $num.'<sup> <em>rd </em></sup>';
			}
		}
		return $num.'<sup><em> th </em></sup>';
	}


// for ($i = 1; $i <= 10000; $i++){
//   echo addOrdinalNumberSuffix($i) . "\t";
//   if ($i % 10 == 0) {
//     echo "\n";
//   }
// }
 
?>
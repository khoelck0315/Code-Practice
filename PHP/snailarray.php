<?php
function snail(array $array) : array {
    $retarray = array();
    while(count($array)>0) {
        //Get the first row
        $curr = $array[0];
        foreach($curr as $num) {
            if($num) array_push($retarray, array_shift($curr));
            else return $retarray;
        }
        array_shift($array);
        //Get the last number of each remaining array
        $max = count($array);
        for($i=0;$i<$max;$i++) {
            if(isset($array[$i])) array_push($retarray, array_pop($array[$i]));
            else return $retarray;
        }
        //In the last array of the series, get the last row counting backwards
        //THIS SECTION IS FUCKED
        $curr = max($array);
        foreach($curr as $num) {
            if($num) array_push($retarray, array_pop($curr));
            else return $retarray;
        }
        array_pop($array);
        //Move upwards towards the beginning again, pop the first element off the remaining, starting with the last array in the series
        $max = array_key_last($array);
        for($i=$max;$i>=0;$i--) {
            if(isset($array[$i])) array_push($retarray, array_shift($array[$i])); 
            else return $retarray;
        }
        if (empty($array)) unset($array[$max]); 
    }
    return $retarray;
}

//Testing area
$test = [
    [1, 2, 3, 1],
    [4, 5, 6, 4],
    [7, 8, 9, 7],
    [7, 8, 9, 7]
];
print_r(snail($test));

/* 1, 2, 3
   4, 5, 6
   7, 8, 9 */
?>

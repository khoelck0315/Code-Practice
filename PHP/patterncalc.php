<?php

$totalPoints = array();

//Number of possible connections from each letter point
function countPatternsFrom($startingPoint, $numPoints) {   
    global $totalPoints;
    //All possible connection points
    $pointMap = array(
        'A' => ['B', 'CB', 'D', 'E', 'F', 'GD', 'H', 'IE'],
        'B' => ['A', 'C', 'D', 'E', 'F', 'G', 'HE', 'I'],
        'C' => ['B', 'AB', 'D', 'E', 'F', 'GE', 'H', 'IF'],
        'D' => ['A', 'B', 'C', 'E', 'FE', 'G', 'H', 'I'],
        'E' => ['A', 'B', 'C', 'D', 'F', 'G', 'H', 'I'],
        'F' => ['A', 'B', 'C', 'DE', 'E', 'G', 'H', 'I'],
        'G' => ['AD', 'B', 'CE', 'D', 'E', 'F', 'H', 'IH'],
        'H' => ['A', 'BE', 'C', 'D', 'E', 'F', 'G', 'I'],
        'I' => ['AE', 'B', 'CF', 'D', 'E', 'F', 'GH', 'H'] 
    );

    //Handle the easy situations first, with quick returns.
    if ($numPoints < 1 || $numPoints > 9) return 0;
    if ($numPoints == 1) return 1;
    //if ($numPoints == 2) return count(array_filter($adjacencies, function($p) { return (strlen($p)>1) ? false : true; }));
    
    //Build an array listing of the primary adjacencies of the starting point
    $adjacencies = $pointMap[$startingPoint];
    
    //If not, we need to recursively count all possible patterns
    $recursion = $numPoints - 2;
    $points[$startingPoint] = array_flip($adjacencies);
    foreach ($points as $point=>$vals) {
        findNextPoints($pointMap, $point, $recursion, array());
    }
    return array_sum($totalPoints);
}

function findNextPoints($map, $adj, $depth, $currPath) {
    global $totalPoints;  
     //Path iterations part of counting function needs work, is incorrect at depths > 3.  So close tho!
    if ($depth > 0) {
        $depth--;
        $nextPoints = $map[substr($adj,0,1)];
        $nextPoints = array_flip($nextPoints);
        array_push($currPath, $adj);
        foreach($nextPoints as $point=>$vals) {
            $dest = substr($point,0,1);
            $through = (strlen($point) > 1) ? substr($point,1,2) : false;
            if (in_array($dest, $currPath) || (($through) && (!in_array($through, $currPath)))) continue;
            findNextPoints($map, $dest, $depth, $currPath);
        }
    }
    else {
        $nextPoints = $map[$adj];
        $path = $currPath;
        array_push($path, $adj);
        $possible = array_diff($nextPoints, $path);
        $crossovers = array_filter($possible, function($p) use ($path) {
             return (strlen($p)>1 && in_array(substr($p,1,2),$path)) ? true : false; 
        });
        $possible = array_filter($possible, function($p) { return (strlen($p)>1) ? false : true; });
        array_push($totalPoints, (count($possible) + count($crossovers)));
    }
}  



echo countPatternsFrom('E', 4);
//E, 4
//Expected: 256
//D, 3
//Expected: 37
/*
$arg = 'A';
print_r($$arg);
//Outputs the array contained in the $A variable.
*/

?>
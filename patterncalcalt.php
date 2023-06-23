/*
KATA NOTES

You might already be familiar with many smartphones that allow you to use a geometric pattern as a security measure. To unlock the device, you need to connect a sequence
of dots/points in a grid by swiping your finger without lifting it as you trace the pattern through the screen.

The image below has an example pattern of 7 dots/points: (A -> B -> I -> E -> D -> G -> C).

lock_example.png

For this kata, your job is to implement a function that returns the number of possible patterns starting from a given first point, that have a given length.

More specifically, for a function countPatternsFrom(firstPoint, length), the parameter firstPoint is a single-character string corresponding to the point in the grid 
(i.e.: 'A') where your patterns start, and the parameter length is an integer indicating the number of points (length) every pattern must have.

For example, countPatternsFrom("C", 2), should return the number of patterns starting from 'C' that have 2 two points. The return value in this case would be 5, because there
are 5 possible patterns:

(C -> B), (C -> D), (C -> E), (C -> F) and (C -> H).

Bear in mind that this kata requires returning the number of patterns, not the patterns themselves, so you only need to count them. Also, the name of the function might be
different depending on the programming language used, but the idea remains the same.

Rules
    In a pattern, the dots/points cannot be repeated: they can only be used once, at most.
    In a pattern, any two subsequent dots/points can only be connected with direct straight lines in either of these ways:
        Horizontally: like (A -> B) in the example pattern image.
        Vertically: like (D -> G) in the example pattern image.
        Diagonally: like (I -> E), as well as (B -> I), in the example pattern image.
        Passing over a point between them that has already been 'used': like (G -> C) passing over E, in the example pattern image. This is the trickiest rule. Normally, you wouldn't be able to connect G to C, because E is between them, however when E has already been used as part the pattern you are tracing, you can connect G to C passing over E, because E is ignored, as it was already used once.

*/
<?php  

//Number of possible connections from each letter point
function countPatternsFrom($startingPoint, $numPoints) {   
    //All possible connection points
    $pointMap = array(
        'A' => ['B','D','E','F','H'],
        'B' => ['A','C','D','E','F','G','I'],
        'C' => ['B','D','E','F','H'],
        'D' => ['A','B','C','E','I','H','G'],
        'E' => ['A','B','C','D','F','G','H','I'],
        'F' => ['A','B','C','E','G','H','I'],
        'G' => ['B','D','E','F','H'],
        'H' => ['A','C','D','E','F','G','I'],
        'I' => ['B','D','E','F','H']
    );


    //If this input returns true, there are 0 possible patterns available so return the result now
    if ($numPoints <= 1) return 0;

    //Build an array listing of the primary adjacencies of the starting point
    $adjacencies = $pointMap[$startingPoint];
    
    ///If this input returns true, we only need to count the immediate adjacencies.  Return the result now.
    if ($numPoints == 2) return count($adjacencies);

    //If not, we need to recursively build upon that array of adjacencies for later calculation of total patterns
    else {
        $recursion = $numPoints - 2;
        $points[$startingPoint] = array_flip($adjacencies);
        foreach ($points as $point=>$vals) {
            $points[$point] = findNextPoints($pointMap, $point, $recursion, array());
        }
        //print_r($points);
        //Do the counting magic here
        return countPatterns($points,0,array());
    }
}
function findNextPoints($map, $adj, $depth, $returnArray) {
    $nextPoints = $map[$adj];
    if ($depth > 0) {
        $depth--;
        $nextPoints = array_flip($nextPoints);
        foreach($nextPoints as $point=>$vals) {
            $returnArray[$point] = findNextPoints($map, $point, $depth, $returnArray);
        }
        return $returnArray;
    }
    else {
        return $map[$adj];
    }
}
//Remember, this needs to be able to know when E has been used so it can re-cross it to form extra patterns!
function countPatterns($input,$patternCount,$currPoints) {
    foreach($input as $key=>$val) {
        if(is_array($val)) {
            array_push($currPoints, $key);
            $patternCount = countPatterns($val, $patternCount, $currPoints);
            array_pop($currPoints);
        }
        else {
            if(in_array($val,$currPoints)) continue;
            /* This counting function works well! however, even in a recursion depth of 3, crossing an already used point needs to be considered.
               This will output 35 for the test case D3, because it doesn't consider D-A-G or D-G-A a valid path, but it is since D can be 
               crossed over again after being used */
            else {
                $patternCount++;
                if ($key == count($input)-1) return $patternCount;
            }
        }
    }
    return $patternCount;  
}       


echo countPatternsFrom('D', 3);
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
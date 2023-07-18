<?php
$input = [0,0,0,0,0];
function removeDuplicates(&$nums) {
    //iterate through array
    $orig_length = count($nums);
    for($i=0;$i<$orig_length;$i++) {    
        $j=$i+1;
        while($nums[$i]===$nums[$j]) {
            unset($nums[$j++]);
        }
        $i=$j-1;
    }
    return count($nums);
}
removeDuplicates($input);

/* The above is a correct answer, but here is the official algorithm from leetcode:

  // Use the TWO POINTER TECHNIQUE to remove the duplicates in-place.
  // The first element shouldn't be touched; it's already in its correct place.
  $writePointer = 1;

  // Go through each element in the Array.
  for ($readPointer = 1; $readPointer < count(nums); $readPointer++) {
      // If the current element we're reading is *different* to the previous element....
      if (nums[readPointer] != nums[readPointer - 1]) {
          
          // Copy it into the next position at the front, tracked by writePointer.
          nums[writePointer] = nums[readPointer];

          // And we need to now increment writePointer, because the next element should be written one space over.
          writePointer++;
      }
  }
  
  // This turns out to be the correct length value.
  return writePointer;
}

*/











?>


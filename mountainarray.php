 <?php
 
   function validMountainArray($arr) {
        $maxkey = count($arr)-1;
        if(count($arr) < 3) return false;
        $peak = array_search(max($arr), $arr);
        if($peak == 0 || $peak == $maxkey) return false;
        for($i=$peak;$i>0;$i--) {
            $j = ($i-1 >= 0) ? $i-1 : 0;
            if($arr[$j] >= $arr[$peak] || $arr[$i] <= $arr[$j]) return false;
        }
        for($i=$peak;$i<$maxkey;$i++) {
            $j = ($i+1 < $maxkey) ? $i+1 : $maxkey;
            if($arr[$j] >= $arr[$peak] || $arr[$i] <= $arr[$j]) return false;
        }
        return true;
    }

    validMountainArray([0,3,2,1]);

?>
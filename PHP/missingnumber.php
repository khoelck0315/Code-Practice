<?php
/*You are helping an archaeologist decipher some runes. He knows that this ancient society used a Base 10 system, and that they never start a number with a leading zero. He's figured out most of the digits as well
as a few operators, but he needs your help to figure out the rest.

The professor will give you a simple math expression, of the form

[number][op][number]=[number]

He has converted all of the runes he knows into digits. The only operators he knows are addition (+),subtraction(-), and multiplication (*), so those are the only ones that will appear. Each number will be in
the range from -1000000 to 1000000, and will consist of only the digits 0-9, possibly a leading -, and maybe a few ?s. If there are ?s in an expression, they represent a digit rune that the professor doesn't
know (never an operator, and never a leading -). All of the ?s in an expression will represent the same digit (0-9), and it won't be one of the other given digits in the expression. No number will begin with 
a 0 unless the number itself is 0, therefore 00 would not be a valid number.

Given an expression, figure out the value of the rune represented by the question mark. If more than one digit works, give the lowest one. If no digit works, well, that's bad news for the professor
 - it means that he's got some of his runes wrong. output -1 in that case.

Complete the method to solve the expression to find the value of the unknown rune. The method takes a string as a paramater repressenting the expression and will return an int value representing the unknown rune or 
-1 if no such rune exists.

Most of the time, the professor will be able to figure out most of the runes himself, but sometimes, there may be exactly 1 rune present in the expression that the professor cannot figure out 
(resulting in all question marks where the digits are in the expression) so be careful ;)
======================================================================================================================================================================================================================*/

function solve_expression(string $expression): int {
    //First, separate by this expression.  Then, use it to find the operator for the calculation.
    echo $expression.'                  ';
    $separator = '/[\+\*\=]|(?<=[0-9?])\-/';
    $search = '/\?/';
    $detectzero = '/(?<!\d)0{1,}(?=\d)/';
    $components = preg_split($separator,$expression);
    preg_match($separator,$expression,$result);
    $operator = array_shift($result);
    foreach(range(0,9) as $sub) {
        if(preg_grep("/[$sub]{1,}/",$components)) continue;
        $trial = preg_replace($search,$sub,$components);
        if(count(preg_grep($detectzero,$trial))>=1) continue;
        switch($operator) {
            case '+':
                if($trial[0]+$trial[1]==$trial[2]) return $sub;
            break;
            case '-':
                if($trial[0]-$trial[1]==$trial[2]) return $sub;
            break;
            case '*':
                if($trial[0]*$trial[1]==$trial[2]) return $sub;
            break;
        }
    }
    //If nothing returned from that loop, then it's bogus.
    return -1;
}

//Test
$str = '-26327-?61986=-?88313';
echo solve_expression($str);

?>
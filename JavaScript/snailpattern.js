/*Given an n x n array, return the array elements arranged from outermost elements to the middle element, traveling clockwise.

array = [[1,2,3],
         [4,5,6],
         [7,8,9]]
snail(array) #=> [1,2,3,6,9,8,7,4,5]

For better understanding, please follow the numbers of the next array consecutively:

array = [[1,2,3],
         [8,9,4],
         [7,6,5]]
snail(array) #=> [1,2,3,4,5,6,7,8,9]*/

snail = function(array) {
    //right max, down max, left max, up max.
    //1 iterate through top array to max
    //2 iterate through every last number in each array
    //3 iterate backwards through last array in args
    //4 iterage through every first number in the args, in reverse order
    // rinse repeat
    let ans = [];
    while(true/*arrays have not been fully dismanteled*/) {
        //perform steps here
    }
}
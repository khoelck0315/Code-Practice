/*A format for expressing an ordered list of integers is to use a comma separated list of either

    -individual integers
    -a range of integers denoted by the starting integer separated from the end integer in the range by a dash, '-'. The range includes all integers in the interval including both endpoints. It is not considered a range unless it spans at least 3 numbers. For example ("12, 13, 15-17")

Complete the solution so that it takes a list of integers in increasing order and returns a correctly formatted string in the range format. 

solution([-6, -3, -2, -1, 0, 1, 3, 4, 5, 7, 8, 9, 10, 11, 14, 15, 17, 18, 19, 20]);
// returns "-6,-3-1,3-5,7-11,14,15,17-20" */

function solution(list) {
  return list.map((val,ind,arr) => {
    if((Math.abs(val - arr[ind+2])) == 2) {
      const low = val;
      while((Math.abs(val++ - arr[ind+1])) == 1) {
        arr.splice(ind,1)
      }
      return `${low}-${arr[ind]}`;
    }
    else {
      return val;
    }
  }).filter((e) => (e!='')).join(',');
}

//Testing
console.log(solution([-6, -3, -2, -1, 0, 1, 3, 4, 5, 7, 8, 9, 10, 11, 14, 15, 17, 18, 19, 20]));  
//Expecting"-6,-3-1,3-5,7-11,14,15,17-20"
/*In this Kata, you will be given a string of numbers in sequence and your task will be to return the missing number. If there is no number missing or there is an error in the sequence, return -1.

For example:

missing("123567") = 4 
missing("899091939495") = 92
missing("9899101102") = 100
missing("599600601602") = -1 -- no number missing
missing("8990919395") = -1 -- error in sequence. Both 92 and 94 missing.

The sequence will always be in ascending order.

More examples in the test cases.

Good luck! */

/*SOLUTION*/
const answer = function(src) {
  const len = src.length;
  let res;
  for(let n = 1; (len - n) >= n; n++) {
      for(let cur = Number(src.substring(0, n)), start = n; start < len;) {
          cur += 1;
          const exist = src.indexOf(cur, start) === start;
          if(exist) {
              start += String(cur).length;
              continue;
          }
          res = res ? null : cur;
          if(!res) break;
      }
      if(res) break;
  }
  return res || -1;
};
console.log(answer("9899101102"));

//Below is what I did, which as it turns out, is worthless

const extract = (s,t) => {
  const separator = new RegExp(`\\d{1,${t}}`, 'g');
  return Array.from(s.match(separator)).map(x => x[0]);
}

const validityCheck = (n) => {
  return n.every((e,i,a) => (i==(a.length -1)||e < a[i+1]));
}

function missing(str) {
  if (str.length < 2) return -1
  let tens = 0;
  do {
    var numset = extract(str, ++tens);
    let rollover = Array(tens).fill('9').reduce((a, v) => a + v);
    if (numset.includes(rollover)&&numset.indexOf(rollover)!=numset.length-1) {
      const junc = numset.lastIndexOf(rollover)+1;
      let restr = numset.slice(junc).reduce((a, c) => a + c);
      numset.splice(junc);
      numset = numset.concat(extract(restr, tens+1))
    }
    var test = new Set(numset);
  } while (!validityCheck(numset));  
  numset = numset.map((v) => Number(v));
  const retval = numset.find((e,i,a) => e+1!=a[i+1] && i!=a.length-1)+1;
  return (retval == undefined) ? -1 : retval;
}




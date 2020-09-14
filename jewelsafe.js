/*
https://www.codewars.com/kata/5b40a38f6be5d82775000003/train/javascript
*/
var actual = ["L00", "L00", "L00"];
var safe = {
    unlock: function(combo) {
        //Write own function to check combo here.
        //Use random number generation, or just put in a static one for testing
        let answer = [];
        for (i=0;i<actual.length;i++) {
          if(combo[i] == actual[i]) {
            answer.push('click');
          }
        }
        return answer.join('-');
    }
};


var crack = function(/*safe*/) {
  const direction = ["L", "R"];
  let combo = ["L00", "L00", "L00"];
  let detect = ['click'];
  while(detect.length < 4) {
    checkloop:for(let num=0;num<100;num++) {
      for (const dir of direction) {
        combo[detect.length-1] = dir+num.toString().padStart(2, 0);
        if(safe.unlock(combo/*.join('-')*/) == detect.join('-') || safe.unlock(combo/*.join('-')*/) == 'click-click-click') {
          detect.push('click');
          break checkloop;
        }  
      }   
    }
  }
  //return safe.open();
  console.log(combo);
}

crack();
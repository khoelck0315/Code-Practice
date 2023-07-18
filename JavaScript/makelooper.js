/*
The makeLooper() function (make_looper in Python) takes a string (of non-zero length) as an argument. It returns a function. The function it returns will return successive characters of the string on successive invocations. It will start back at the beginning of the string once it reaches the end.

For example:

var abc = makeLooper('abc');
abc(); // should return 'a' on this first call
abc(); // should return 'b' on this second call
abc(); // should return 'c' on this third call
abc(); // should return 'a' again on this fourth call
*/

function* gothru (rng) {
    let c = 0;
    let r = rng.split('');
    while(true) {
        if (c<=r.length-1) {
            yield r[c++]
        }
        else {
            c = 0;
            yield r[c++];
        }
    }
}

function makeLooper(rng) {
    const gen = gothru(rng);
    return function() {
        return gen.next().value;
    }
}

var abc = makeLooper('abc');

console.log(abc());
console.log(abc());
console.log(abc());
console.log(abc());

//This also works without making it an array
var foo = 'fuckyou';
console.log(foo[4]);
//Returns 'y'
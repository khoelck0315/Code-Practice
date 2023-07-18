/*Implement a function that receives two IPv4 addresses, and returns the number of addresses between them (including the first one, excluding the last one).

All inputs will be valid IPv4 addresses in the form of strings. The last address will always be greater than the first one.
Examples

ipsBetween("10.0.0.0", "10.0.0.50")  ===   50 
ipsBetween("10.0.0.0", "10.0.1.0")   ===  256 
ipsBetween("20.0.0.10", "20.0.1.0")  ===  246 */

const m = (i) => {
    switch(i) {
        case 3: return 1;
        case 2: return 256;
        case 1: return 65536;
        case 0: return 16777216;
    }
}

function ipsBetween(start, end){
  start = start.split('.').reduceRight((a,c,i) => {
    return a + c*m(i);
  },0);
  end = end.split('.').reduceRight((a,c,i) => {
    return a + c*m(i);
  },0);
  return end-start;
}

console.log(ipsBetween('10.0.1.0','10.0.2.50'));
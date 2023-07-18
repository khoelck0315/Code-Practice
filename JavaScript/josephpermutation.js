function josephus(items,k){
  let pointer = 0;
  let result = [];
  Object.defineProperty(items, 'maxIndex', {
    get() { return items.length-1; }
  });
  k -= 1;
  while (items.length > 0) {
    for(i=k;i>0;i--) {
      pointer = (pointer >= (items.maxIndex)) ? 0 : pointer+1;
    }
    result.push(items[pointer]);
    items.splice(pointer, 1);
    pointer = (pointer > (items.maxIndex)) ? 0 : pointer;
  }
  return result
}

console.log(josephus([1,2,3,4,5,6,7],3));
console.log("Expecting: [3, 6, 2, 7, 5, 1, 4])");

/*I DID NOT FUCKING WRITE THIS */



function advice(agents, n) {
  var result = [];
  
  if (n > 0) {
    var safestValue = n*2; // Furtherest manhattan distance possible is from corner to corner (n x n)
    var map = new Array(n).fill().map(() => new Array(n).fill(safestValue)); // Generate intial map with all spots being equally safe
    var curSafetyValue; 

    agents.forEach((pos, aindex) => {
      if (pos[0] < n && pos[1] < n) { // Agent fits on map
        safestValue = 0; // No longer have the change that the whole map is equally safe
        for(var cx = 0; cx < map.length; cx++) {
          for(var cy = 0; cy < map[cx].length; cy++) {
              curSafetyValue = getDistance(pos, [cx, cy]);
              
              if (map[cx][cy] > curSafetyValue) { // Set cell to the lowest safety level found
                map[cx][cy] = curSafetyValue;
              }
              
              if (map[cx][cy] > safestValue) {  // Store the highest safety value found, so we can look up the safest locations later
                safestValue = map[cx][cy];
              }
          }
        }
        
      }
    });
    result = getSafestLocations(safestValue, map);
  }
  
  return result;
}

function getDistance(posA, posB) {
  return Math.abs(posA[0] - posB[0]) + Math.abs(posA[1] - posB[1]);
}

function getSafestLocations(safestValue, map) {
  var results = [];
  if (safestValue > 0) {
    for(var x = 0; x < map.length; x++) {
      for(var y = 0; y < map[x].length; y++) {
        if (map[x][y] === safestValue) {
          results.push([x, y]);
        }
      }
    }
  }
  return results; 
}

console.log(advice([[1,1], [3,2], [5,5]], 6));
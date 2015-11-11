var WordPOS = require('wordpos'),
    wordpos = new WordPOS();

wordpos.getAdjectives('The angry bear chased the frightened little squirrel.', function(result){
    console.log(result);
});
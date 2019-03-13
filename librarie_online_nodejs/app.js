const http=require('http');
var server=http.createServer(function (req,res){
res.writeHead(200, { 'Content-type': 'text/plain'});
res.end ('Hey, ce faci?');
});
server.listen (4000, '127.0.0.1') ;
console.log ("listening on port 4000");


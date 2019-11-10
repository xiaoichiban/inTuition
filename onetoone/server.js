

/*
//requires
const express = require('express');
const app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http);
const port = process.env.PORT || 3000;
// express routing
app.use(express.static('public'));
*/


var express = require('express');
var app = express();
// your express configuration here

var fs = require('fs');
var https = require('https');


var credentials = {
	key: fs.readFileSync('server.key'),
	cert: fs.readFileSync('server.crt')
};


var httpsServer = https.createServer(credentials, app);
app.use(express.static('public'));
httpsServer.listen(8443);





var io = require('socket.io').listen(httpsServer);





// signaling
io.on('connection', function (socket) {
    console.log('a user connected');

    socket.on('create or join', function (room) {
        console.log('create or join to room ', room);
        
        var myRoom = io.sockets.adapter.rooms[room] || { length: 0 };
        var numClients = myRoom.length;

        console.log(room, ' has ', numClients, ' clients');

        if (numClients == 0) {
            socket.join(room);
            socket.emit('created', room);
        } else if (numClients == 1) {
            socket.join(room);
            socket.emit('joined', room);
        } else {
            socket.emit('full', room);
        }
    });

    socket.on('ready', function (room){
        socket.broadcast.to(room).emit('ready');
    });

    socket.on('candidate', function (event){
        socket.broadcast.to(event.room).emit('candidate', event);
    });

    socket.on('offer', function(event){
        socket.broadcast.to(event.room).emit('offer',event.sdp);
    });

    socket.on('answer', function(event){
        socket.broadcast.to(event.room).emit('answer',event.sdp);
    });

});



/*
// listener
https.listen(port || 8000, function () {
    console.log('listening on', port);
});
*/
var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);

server.listen(8080);
console.log('Listen on Port 8080');
// WARNING: app.listen(80) will NOT work here!

app.get('/', function (req, res) {
    res.sendFile(__dirname + '/index.html');
});

io.on('connection', function (socket) {  
    socket.on('notif', function ($data) {
        io.emit('res_notif', $data);
    });
  
    socket.on('disconnect', function () {
      io.emit('user disconnected');
    });
});
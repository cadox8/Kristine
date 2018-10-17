var mysql = require('mysql');
var config = require('../config/config');

var connection = mysql.createConnection({
    host: config.mySQL.host,
    port: config.mySQL.port,
    user: config.mySQL.username,
    password: config.mySQL.password,
    database: config.mySQL.dbname,
    multipleStatements: true
});

connection.connect(function(err) {
    if (err) {
        console.error('Error connecting: ' + err.stack);
        return;
    }
    console.log('Connected as id ' + connection.threadId);
});

module.exports.connection = connection;

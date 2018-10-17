/**
 * Dependencies
 */
var createError = require('http-errors');
var express = require('express');
var path = require('path');
var session = require('express-session');
var bodyParser = require("body-parser");

var config = require('./config/config');

global.database = require('./database/database').connection;

global.loggedin = false;

global.siteName = config.siteName;

/**
 * Routes
 */

var indexRouter = require('./routes/index');

var helpRouter = require('./routes/help/help');
var tosRouter = require('./routes/help/tos');

var postRouter = require('./routes/post');

var loginRouter = require('./routes/users/login');
var registerRouter = require('./routes/users/register');
var logoutRouter = require('./routes/users/logout');

/**
 * APP
 */

var app = express();

app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'pug');

app.use(bodyParser.urlencoded({ extended: true }));

app.use(express.json());
app.use(session({
    cookie: { maxAge: 60000 },
    secret: '8e13ac1c14ca9906',
    name: 'Kristine',
    saveUninitialized: true,
    resave: true
}));


app.use(function(req,res,next){
    res.locals.session = req.session;
    next();
});

app.use(express.static(path.join(__dirname, '/public')));

var err = '';
//

//

app.use('/', indexRouter);

app.use('/home', postRouter);

app.use('/help', helpRouter);
app.use('/help/tos', tosRouter);

app.use('/login', loginRouter);
app.use('/register', registerRouter);
app.use('/logout', logoutRouter);

app.use(function(req, res, next) {
  next(createError(404));
});

app.use(function(err, req, res, next) {
    res.locals.message = err.message;
    res.locals.error = req.app.get('env') === 'development' ? err : {};

    res.status(err.status || 500);
    res.render('error');
});

module.exports = app;

var express = require('express');
var router = express.Router();

var bcrypt = require('bcryptjs');

router.get('/', function(req, res) {
    res.render('users/login', { title: 'Login - ', err: ''});
});

router.post('/', function(req, res) {
    var post = req.body;
    var email = post.email;
    var pass = post.password;

    if (email === '' || pass === '') {
        res.render('users/login', { title: 'Login - ', err: "Please, fill all fields" });
        return;
    }

    var sql = "SELECT * FROM `users` WHERE `email` = '" + email + "'";

    database.query(sql, function(err, result) {
        if (result && result.length > 0) {
            if (bcrypt.compareSync(pass, result[0].password)) {
                req.session.userId = result[0].id;
                req.session.name = result[0].user;
                global.loggedin = true;
                res.redirect('/home');
            } else {
                res.render('users/login',{ title: 'Login - ', err: "Wrong credentials" });
                return;
            }
        } else {
            res.render('users/login',{ title: 'Login - ', err: "Wrong credentials" });
        }
        if (err) {
            res.render('users/login',{ title: 'Login - ', err: "Wrong credentials" });
        }
    });
});

module.exports = router;
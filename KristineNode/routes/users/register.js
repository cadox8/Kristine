var express = require('express');
var router = express.Router();

var bcrypt = require('bcryptjs');

router.get('/', function(req, res) {
    res.render('users/register', { title: 'Register - ', err: ''});
});

router.post('/', function(req, res) {
    var post = req.body;
    var user = post.user;
    var email = post.email;
    var pass = bcrypt.hashSync(post.password, 10);

    if (user === '' || email === '' || pass === '') {
        res.render('users/register', { title: 'Register - ', err: "Please, fill all fields" });
        return;
    }

    database.query("SELECT * FROM `users` WHERE `email` = '" + email + "'", function(err, result) {
        if (!err) {
            if (result.length > 0) {
                res.render('users/register', {title: 'Register - ', err: "There is an account registered with the same email"});
            }
        }
    });

    database.query("SELECT * FROM `users` WHERE `name` = '" + user + "'", function(err, result) {
        if (!err) {
            if (result.length > 0) {
                res.render('users/register', {title: 'Register - ', err: "There is an account registered with the same username"});
            }
        }
    });

    var sql = "INSERT INTO `users`(`name`,`email`,`pass`) VALUES ('" + user + "','" + email + "','" + pass + "')";

    database.query(sql, function(err, result) {
        if (result) {
            console.log("Register: " + post.password + " " + pass);
            res.render('users/register',{ title: 'Register - ', err: "Successfully! Your account has been created. Now you can Log In the site" });
        }
        if (err) {
            res.render('users/register',{ title: 'Register - ', err: "A problem occurred while creating your account" });
            console.log(err);
        }
    });
});

module.exports = router;
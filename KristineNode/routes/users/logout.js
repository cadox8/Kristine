var express = require('express');
var router = express.Router();

router.get('/', function(req, res, next) {
    req.send(401);
    req.redirect('/home');
});

module.exports = router;
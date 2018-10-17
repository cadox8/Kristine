var express = require('express');
var router = express.Router();

router.get('/', function(req, res, next) {
  if (req.session.name == null) {
      res.redirect('/login');
      return;
  }
  res.render('post', { title: 'Post - ', user: req.session.name});
});

router.post('/', function (req, res, next) {
});

module.exports = router;

const express = require('express');
const mongoose = require('mongoose');
const authRoutes = require('./routes/authRoutes');
const cookieParser = require('cookie-parser');
const favicon = require('serve-favicon');
const { requireAuth, checkUser } = require('./middleware/authMiddleware');
const morgan = require('morgan');
const Topic = require('./models/topic');
const Comment = require('./models/comm');

const { get, result } = require('lodash');
const { render } = require('ejs');
const { create, db } = require('./models/topic');

const User = require('./models/User');
const { post } = require('./routes/authRoutes');

const app = express();

const port = process.env.PORT || 3000

// middleware
app.use(express.static('public'));
app.use(express.urlencoded({extended: true}));
app.use(morgan('dev'));   //middleware
app.use(express.json());
app.use(cookieParser());
app.use(favicon('public/favicon.ico'));  //favicon

// view engine
app.set('view engine', 'ejs');

// database connection
const dbURI = 'mongodb+srv://dbadmin:edctech@cluster0.7m6o4.mongodb.net/discussion?retryWrites=true&w=majority'; //here goes the mongodb link
//const dbURI = 'mongodb+srv://admin_forum:adminforum@cluster0.w7lbe.mongodb.net/discussion?retryWrites=true&w=majority'; //here goes the mongodb link

mongoose.connect(dbURI, { useNewUrlParser: true, useUnifiedTopology: true, useCreateIndex:true })
  .then((result) => {
    app.listen(port)
    console.log('connected to db')
  })
  .catch((err) => console.log(err));

// routes
app.get('*', checkUser);
app.use(authRoutes);

app.get('/', (req, res) => {
    res.redirect('/topics');
});
  
  app.get('/about', (req,res) => {
    res.render('about', {title: 'About'});
});

app.get('/topics', (req,res) => {
    Topic.find().sort({createdAt: -1 })
      .then((result) => {
          res.render('index', {title: "all topics", topics: result })
      })
      .catch((err) => {
          console.log(err);
      });
});

//topic routes
app.get('/topics/create', (req,res) => {
    res.render('create', {title: 'Create a new topic'});
});

app.get('/topics', (req,res) => {
    Topic.find().sort({createdAt: -1 })
      .then((result) => {
          res.render('index', {title: "all topics", topics: result })
      })
      .catch((err) => {
          console.log(err);
      });
});

app.post('/topics',(req,res) => {
    const topic= new Topic(req.body);
    topic.save()
      .then((result) => {
          res.redirect("/topics");
      })
      .catch((err) => {
          console.log(err);
      });
});

app.get('/topics/:id', (req,res) => {
    const id= req.params.id;
    Topic.findById(id)
      .then((result) => {
          res.render('details', {topic: result, title: "Topic Details"});
      })
});

app.delete('/topics/:id', (req, res) => {
  const id = req.params.id;
  Topic.findByIdAndDelete(id)
  .then(result => {
    res.json({ redirect: '/topics' });
  })
  .catch(err => {
    console.log(err);
  });
});

app.post('/:id/comment',(req,res) => {  
  const commId = new Comment(req.body);  
  const id = req.params.id;
  Topic.findById(id)
  .then((result) => {
    topic = result,
    topic.comments.push(commId);
    topic.save()
    .then((result) => {
        res.redirect('back');
    })
    .catch((err) => {
        console.log(err);
    });
  })
});

app.delete('/topic/:id/comments/:id1', (req,res) => {
  Topic.findById(req.params.id)
  .then((result) => {
    let topic = result;
    // console.log(topic);
    topic.comments.id(req.params.id1).remove();
    topic.save()
    .then((result) => {
      console.log(result);
    })
    .catch((err) => {
        console.log(err);
    });
  })
  .catch((err) => {
      console.log(err);
  });
});

//404 page
app.use((req,res) => {
    res.render('404', {title: '404 Page' });
});

// var http = require('http');
// var server = http.createServer(function(req, res) {
//     res.writeHead(200, {'Content-Type': 'text/plain'});
//     var message = 'It works!\n',
//         version = 'NodeJS ' + process.versions.node + '\n',
//         response = [message, version].join('\n');
//     res.end(response);
// });
// server.listen();


const express=require('express');
var app = express()
app.use ('/f', express.static('files'));
app.set('view engine','ejs');

const fs=require('fs');
var books=fs.readFileSync('books.json','utf8' );
var carti=JSON.parse(books);

app.get("/",function(req,res){
res.render('index',{carti: carti});
});

app.get("/produse/:id",function(req,res){
var idprodus=req.params.id;
var date=carti.find(function(c){return c.id==idprodus});
res.render('detalii',{carte: date});
});

app.get("/comanda/:id",function(req,res){
var idprodus=req.params.id;
var date=carti.find(function(c){return c.id==idprodus});
res.render('comanda',{carte: date});
} );

app.get("/sumar/:id", function(req, res){
var formData=req.query;
var idprodus=req.params.id;
var date=carti.find(function(c){return c.id==idprodus});
console.log(formData);
res.render('sumar', {fdata: formData, carte: date})
});

app.get("/confirm", function(req, res){
res.render('confirm')
});
app.get("/contact", function(req, res){
res.render('contact')
});
app.get("/livrare", function(req, res){
res.render('livrare')
});


app.listen(4000)

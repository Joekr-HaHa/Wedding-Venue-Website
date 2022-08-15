<!DOCTYPE html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<title>Our Locations</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/*.carousel{
   height: auto;
   /*position:absolute;
   left:70px;
   /*top:400px;*/
 /*height: 600px;*/
  /*width:1200px;
}
.carousel-item {
  height: 600px;
  width:1200px;
}
.carousel-item img {
    position: absolute;
    top: 0;
    left: 0;
    min-height: 300px;
}*/
.carousel{
    height:700px;
    width:auto;
}
/*.carousel-item{
    height:750px;
    width:1500px;
}*/
img{
    height:750px;
    width:1500px;
}
body {
	font-family: "Apple Chancery", Times, serif;
	/*background-color: #D6D6D6;*/
    background-image: url('flowers.jpeg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
}
.center {
	text-align:center;
}
body,td,th {
	color: #06F; 
}
.larger {
	font-size:larger;
	
}
</style>
</head>
<body>
    <div id="myNavbar">
        <script>
        $.get("myNavbar1.php", function(data) {
        $("#myNavbar").html(data);});
            </script>
    </div>
<div id="carouselCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="wedding0.jpeg" class="d-block w-100" alt="">
        <div class="carousel-caption d-none d-md-block">
          <h5>Stunning Locations</h5>
          <p>Our wedding locations are only the best for your beautiful marriages</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="wedding1.jpeg" class="d-block w-100" alt="">
        <div class="carousel-caption d-none d-md-block">
          <h5>Top-Notch Customer Support</h5>
          <p>We support you on every milestone of your marriage (p.s. contract stipulates you cannot get a restraining order from us \<\3 )</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="wedding10.jpeg" class="d-block w-100" alt="">
        <div class="carousel-caption d-none d-md-block">
          <h5>We are a Real Business</h5>
          <p>We are in fact a real business. Don't look into our financial history. Thanks :)</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
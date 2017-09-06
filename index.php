<?php
include "head.php";
?>
 <link href="css/index.css" rel="stylesheet">
 
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
      <a href="item.php?id=1">
        <img src="banners/iphone7-banner.jpg" alt="Image">
      </a>
        <div class="carousel-caption">
          <h3>iPhone 7</h3>
          <p>This is 7</p>
        </div>      
      </div>

      <div class="item">
      <a href="item.php?id=18">
        <img src="banners/S8_banner.jpg" alt="Image">
      </a>
        
        <div class="carousel-caption">
          <h3>Samsumg Galaxy S8</h3>
          <p>A camera built for every moment</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">    
  <h3>What We Do</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <a href='product.php?cat=Mobiles'>
          <img src="banners/heap.jpg" class="img-responsive" style="width:100%" alt="Image">
      </a>
      <p>Mobiles</p>
    </div>
    <div class="col-sm-4"> 
      <a href='product.php?cat=Accessories'>
        <img src="banners/a.png" class="img-responsive" style="width:100%" alt="Image">
      </a>
      <p>Accessories</p>
    </div>
    
  </div>
</div><br>

<footer class="container-fluid text-center">
  <p>SMARTCELL-WPL-2017</p>
</footer>

</body>
</html>
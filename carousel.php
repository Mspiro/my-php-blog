<!DOCTYPE html>
<?php include_once("includes/config.php"); ?>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <link rel="stylesheet" href="assets/css/main.css">
 <title>Carousel</title>
</head>

<body>
 <div id="myslidshow" class="carousel slide carousel-fade" data-ride="carousel">
  <ol class="carousel-indicators">
   <li class="active" data-target="#myslidshow" data-slide-to="0"></li>
   <li data-target="#myslidshow" data-slide-to="1"></li>
   <li data-target="#myslidshow" data-slide-to="2"></li>
   <li data-target="#myslidshow" data-slide-to="3"></li>
  </ol>

  <div class="carousel-inner">
   <div class="carousel-item active">
    <img src="./assets/img/articleImages/img1.jpg" class="d-block w-100" height="400">
    <div class="carousel-caption d-none d-md-block">
     <h4>Learn web Development</h4>
     <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
    </div>
   </div>
   <div class="carousel-item">
    <img src="./assets/img/articleImages/img2.jpg" class="d-block w-100" height="400">
    <div class="carousel-caption d-none d-md-block">
     <h4>Learn JavaScript Development</h4>
     <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
    </div>
   </div>
   <div class="carousel-item">
    <img src="./assets/img/articleImages/img3.jpg" class="d-block w-100" height="400">
    <div class="carousel-caption d-none d-md-block" >
     <h4>Learn SASS Development</h4>
     <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
    </div>
   </div>
   <div class="carousel-item">
    <img src="./assets/img/articleImages/img4.jpg" class="d-block w-100" height="400">
    <div class="carousel-caption d-none d-md-block">
     <h4>Learn OOPS Development</h4>
     <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
    </div>
   </div>
  </div>
  <a href="#myslidshow" class="carousel-control-prev" role="button" data-slide="prev">
   <span class="carousel-control-prev-icon"></span>
   <span class="sr-only"> Previous</span>
  </a>
  <a href="#myslidshow" class="carousel-control-next" role="button" data-slide="next">
   <span class="carousel-control-next-icon"></span>
   <span class="sr-only"> Next</span>
  </a>

 </div>

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
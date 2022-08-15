<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <div id="myNavbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="home.html" name="logo">Joe's Weddings</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.html" name="home">Home</a>
                  </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="weddingtest.html" name="venue">Find a Venue</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html" name="about">About</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Locations
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="locations.html#centralPlaza">Central Plaza</a></li>
                  <li><a class="dropdown-item" href="locations.html#pacificTowers">Pacific Towers Hotel</a></li>
                  <!--<li><hr class="dropdown-divider"></li>-->
                  <li><a class="dropdown-item" href="locations.html#skyCenter">Sky Center Complex</a></li>
                  <li><a class="dropdown-item" href="locations.html#seaView">Sea View Tavern</a></li>
                  <li><a class="dropdown-item" href="locations.html#ashbyCastle">Ashby Castle</a></li>
                  <li><a class="dropdown-item" href="locations.html#fawltyTowers">Fawlty Towers</a></li>
                  <li><a class="dropdown-item" href="locations.html#hilltopMansion">Hilltop Mansion</a></li>
                  <li><a class="dropdown-item" href="locations.html#haslegraveHotel">Haslegrave Hotel</a></li>
                  <li><a class="dropdown-item" href="locations.html#forestInn">Forest Inn</a></li>
                  <li><a class="dropdown-item" href="locations.html#southwestern">Southwestern Estate</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    
    <?php
    /*
    if (isset($_GET['click'])){
    $click=$_GET['click'];
    if ($click == '1'){
        $("body").load("home.php");
    }
    if ($click == '2'){
        $("body").load("weddingtest.php");
    }
    if ($click == '3'){
        echo"
        <script>
        $.get(\"about.php\", function(data) {
        $(\"#about\").html(data);});
        <script>";
    }
    /*if ($link == '4'){
        include 'page4.php';
    }}*/
//}?>
    </body>
</html>
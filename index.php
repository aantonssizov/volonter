<?php
require 'connect.php';
?>
<!DOCTYPE html>
<html> 
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css"
     integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Home -- Volonter.ua</title>
  </head>
  <body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top"><a class="navbar-brand" href="#">Volonter</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="navbar-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="navbar-item"><a class="nav-link" href="#benefits">Benefits</a></li>
          <li class="navbar-item"><a class="nav-link" href="#how">How</a></li>
          <li class="navbar-item"><a class="nav-link" href="#projects">Projects</a></li>
<?php if ( !isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link" href="#signUp">Sign up</a></li><?php }?>
<?php if ( !isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link" href="signIn.php">Sign in</a></li><?php }?>
<?php if ( isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link" href="createProject.php">Create project</a></li><?php }?>
<?php if ( isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link" href="signOut.php">Sign out</a></li><?php }?>
        </ul>
      </div>
    </nav>
    <header class="header container-fluid d-flex flex-column justify-content-end align-items-end">
      <h2 class="p-2 text-light">We help people with Volonter</h2>
      <p class="p-2 col-lg-4 text-white text-lg-right text-sm-right">Volonter.ua is web service for people which need help and helpers.</p>
    </header>
    <div class="container my-5" id="benefits">
      <h2 class="p-5 text-center">Why do you should to use it</h2>
      <div class="d-flex justify-content-between flex-wrap mt-3">
        <div class="ben col-lg-6 col-12">
          <div class="row"><img class="ben-img col-2" src="assets/img/circle.svg" alt="">
            <div class="ben-text col-8">
              <h3>Easily</h3>
              <p class="text-secondary">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum, veniam!</p>
            </div>
          </div>
        </div>
        <div class="ben col-lg-6 col-12">
          <div class="row"><img class="col-2 ben-img" src="assets/img/circle.svg" alt="">
            <div class="ben-text col-8">
              <h3>Uniquely</h3>
              <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, eius!</p>
            </div>
          </div>
        </div>
        <div class="ben col-lg-6 col-12">
          <div class="row"><img class="col-2 ben-img" src="assets/img/circle.svg" alt="">
            <div class="ben-text col-8">
              <h3>Secure</h3>
              <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, et.</p>
            </div>
          </div>
        </div>
        <div class="ben col-lg-6 col-12">
          <div class="row"><img class="col-2 ben-img" src="assets/img/circle.svg" alt="">
            <div class="ben-text col-8">
              <h3>Free</h3>
              <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, ex.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid bg-success py-5" id="how">
      <div class="container">
        <div class="row">
          <div class="col">
            <h2 class="p-2">How it works?</h2>
            <div class="row">
              <div class="col">
                <h3 class="p-1">For people who need help.</h3>
                <ol>
                  <li><a class="text-light" href="signUp.php">Sign up</a> or <a class="text-light"
                    href="signIn.php">sign in</a>.</li>
                  <li><a class="text-light" href="createProject.php">Create project</a>.</li>
                  <li>And wait helpers.</li>
                </ol>
              </div>
              <div class="col">
                <h3 class="p-1">For helpers.</h3>
                <ol>
                  <li><a class="text-light" href="signUp.php">Sign up</a> or <a class="text-light"
                    href="signIn.php">sign in</a>.</li>
                  <li><a class="text-light" href="projects.php">Find project</a>.</li>
                  <li>And help people.</li>
                </ol>
              </div>
            </div>
          </div>
          <div class="col">
            <img src="assets/img/how.png" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid my-5 d-flex flex-column" id="projects">
      <div class="row d-lg-flex justify-content-between">
        <div class="card col p-0 m-5">
          <div class="card-header">Please, Help dog</div>
          <div class="card-body">
            <h5 class="card-title">Please, Help dog.</h5>
            <p>Description: Dog needs money for operation</p>
            <p>Status: ACTIVE</p>
            <p>date: 2018-07-09</p>
          </div>
        </div>
        <div class="card col p-0 m-5">
          <div class="card-header">Please, Help dog</div>
          <div class="card-body">
            <h5 class="card-title">Please, Help dog.</h5>
            <p>Description: Dog needs money for operation</p>
            <p>Status: ACTIVE</p>
            <p>date: 2018-07-09</p>
          </div>
        </div>
        <div class="card col p-0 m-5">
          <div class="card-header">Please, Help dog</div>
          <div class="card-body">
            <h5 class="card-title">Please, Help dog.</h5>
            <p>Description: Dog needs money for operation</p>
            <p>Status: ACTIVE</p>
            <p>date: 2018-07-09</p>
          </div>
        </div>
      </div>
      <div class="p-3 text-center">
        <a href="projects.php" role="button" class="btn btn-success btn-lg">More Projects...</a>
      </div>
    </div>
    <hr class="container-fluid" style="border: 0; border-top: 1px solid grey;width: 97%;">
    <?php if ( !isset($_COOKIE['user']) ) {?>
    <div class="container flex-grow" id="signUp">
      <div class="row d-flex justify-content-between align-items-center">
        <form action="signUp.php" method="POST" class="col">
          <div class="form-group">
            <h2>Sign up for start </h2>
            <input class="form-control my-1" type="text" placeholder="Name" name="name" required>
            <input class="form-control my-1" type="text" placeholder="Surname" name="surname">
            <input class="form-control my-1" type="email" placeholder="Email" name="email" required>
            <input class="form-control my-1" type="password" placeholder="Password" name="password" required>
            <input class="form-control my-1" type="password" placeholder="Reapete password" name="password1" required>
            <button class="btn btn-success btn-lg btn-block" type="submit">Sign up  </button>
            <p class="text-info my-1">If you have account: </p>
            <a class="btn btn-success btn-lg btn-block" role="button" href="signIn.php">Sign in</a>
          </div>
        </form>
        <div class="col">
          <h2>We are wait you that you will help people...</h2>
        </div>
      </div>
    </div>
    <?php } else {?>
    <div class="container flex-grow m-5">
      <h2>Ok lets start</h2>
      <div class="row">
        <div class="col-lg p-2">
          <h3>Helper</h3>
          <a role="button" href="projects.php" class="btn btn-lg btn-block btn-outline-success">Find Projects</a>
        </div>
        <div class="col-lg p-2">
          <h3>Needy</h3>
          <a role="button" href="createProject.php" class="btn btn-lg btn-block btn-outline-success">Create Project</a>
        </div>
      </div>
    </div>
    <?php }?>
    <footer class="footer bg-success p-3">
      <div class="container"><span class="text-light">2017 &copy; Anton Sizov, Vitalina Sizova and Rostislav Sizov.</span></div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" 
    integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>
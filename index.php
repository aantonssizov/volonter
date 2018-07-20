<!DOCTYPE html>
<html> 
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Home -- Volonter.ua</title>
  </head>
  <body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top"><a class="navbar-brand" href="#">Volonter</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="navbar-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="navbar-item"><a class="nav-link" href="#benefits">Benefits</a></li>
          <li class="navbar-item"><a class="nav-link" href="#how">How</a></li>
          <li class="navbar-item"><a class="nav-link" href="#projects">Projects</a></li>
          <li class="navbar-item"><a class="nav-link" href="#signUp">Sign up</a></li>
          <li class="navbar-item"><a class="nav-link" href="signIn.html">Sign in</a></li>
        </ul>
      </div>
    </nav>
    <header class="header container-fluid d-flex flex-column justify-content-end align-items-end">
      <h2 class="p-2 text-light">We help people with Volonter</h2>
      <p class="p-2 col-lg-4 text-white text-lg-right text-sm-right">Volonter.ua is web service for people which need help and helpers.</p>
    </header>
    <div class="container my-5" id="benefits">
      <h2 class="p-2 text-center">Why do you should to use it</h2>
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
        <h2 class="p-2">How it works?</h2>
        <div class="row">
          <div class="col">
            <h3 class="p-1">For people who need help.</h3>
            <ol>
              <li>Sign up or sign in.</li>
              <li>Create project.</li>
              <li>And wait helpers.</li>
            </ol>
          </div>
          <div class="col">
            <h3 class="p-1">For helpers.</h3>
            <ol>
              <li>Sign up or sign in.</li>
              <li>Find project.</li>
              <li>And help people.</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid my-5 d-lg-flex justify-content-between" id="projects">
      <div class="card col mx-2 p-0">
        <div class="card-header">Please, Help dog</div>
        <div class="card-body">
          <h5 class="card-title">Please, Help dog.</h5>
          <p>Description: Dog needs money for operation</p>
          <p>Status: ACTIVE</p>
          <p>date: 2018-07-09</p>
        </div>
      </div>
      <div class="card col mx-2 p-0">
        <div class="card-header">Please, Help dog</div>
        <div class="card-body">
          <h5 class="card-title">Please, Help dog.</h5>
          <p>Description: Dog needs money for operation</p>
          <p>Status: ACTIVE</p>
          <p>date: 2018-07-09</p>
        </div>
      </div>
      <div class="card col mx-2 p-0">
        <div class="card-header">Please, Help dog</div>
        <div class="card-body">
          <h5 class="card-title">Please, Help dog.</h5>
          <p>Description: Dog needs money for operation</p>
          <p>Status: ACTIVE</p>
          <p>date: 2018-07-09</p>
        </div>
      </div>
    </div>
    <hr class="container" style="border: 0; border-top: 2px solid grey">
    <div class="container w-25 flex-grow" id="signUp">
      <form>
        <div class="form-group">
          <h2>Sign up for start </h2>
          <input class="form-control my-1" type="text" placeholder="Name" required>
          <input class="form-control my-1" type="text" placeholder="Surname">
          <input class="form-control my-1" type="email" placeholder="Email" required>
          <input class="form-control my-1" type="password" placeholder="Password" required>
          <input class="form-control my-1" type="password" placeholder="Reapete password" required>
          <button class="btn btn-primary btn-lg btn-block" type="submit">Sign up  </button>
          <p class="text-info my-1">If you have account:    </p><a class="btn btn-primary btn-lg btn-block" role="button" href="signIn.html">Sign in</a>
        </div>
      </form>
    </div>
    <footer class="footer bg-success p-3">
      <div class="container"><span class="text-light">2017 &copy; Anton Sizov, Vitalina Sizova and Rostislav Sizov.</span></div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>
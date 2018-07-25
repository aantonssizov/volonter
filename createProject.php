<?php

require "connect.php";

$alert = '';
$user = ( isset($_COOKIE['user']) ) ? 
  unserialize($_COOKIE['user']) :
  null;

if( isset($_POST['submit']) )
{
  // Text data
  $title       = test_input($_POST['title']);
  $description = test_input($_POST['description']);
  $text        = test_input($_POST['text']);
  $type        = $_POST['type'];
  $theme       = $_POST['theme'];
  $address     = test_input($_POST['address']);
  $status      = 'active';
  $date        = date('Y-m-d');

  //images
  $folder   = '../volonter_images/';
  // $upl_f    = '/opt/lampp/htdocs/volonter_images';
  $logo_img = $_FILES['logo_img']['name'];
  $img      = array(
    $_FILES['img1']['name'],
    $_FILES['img2']['name'],
    $_FILES['img3']['name']
  );

  // upload project
  // upload images to server
  move_uploaded_file($_FILES['logo_img']['tmp_name'], $folder.$_FILES['logo_img']['name']);
  for( $i = 1; $i < 4; $i++ ) {
    move_uploaded_file($_FILES["img$i"]['tmp_name'], $folder.$_FILES["img$i"]['name']);
  }

  $new_name = "img_".date("YmdHis").".jpg";
  //Переименуем файл на всякий случай что бы не было совпадений                                                  
  rename($folder.$logo_img, $folder.$new_name);
  $logo_img = $new_name;

  sleep(1);
  for( $i = 0; $i < 3; $i++ )
  {
    $new_name = "img_".date("YmdHis").".jpg";
    rename($folder.$img[$i], $folder.$new_name);
    $img[$i] = $new_name;

    sleep(1);
  }

  // upload project
  $project = R::dispense('projects');
  $project->title       = $title;
  $project->description = $description;
  $project->text        = $text;
  $project->type        = $type;
  $project->theme       = $theme;
  $project->address     = $address;
  $project->status      = $status;
  $project->date        = $date; 
  $project->user        = $user;
  
  //upload imagepath
  //upload logo image
  $logo = R::dispense('images');
  $logo->name    = $logo_img;
  $logo->path    = $folder;
  
  
  //upload other images

  $uimgs = array();

  $uimgs[0] = R::dispense('images');
  $uimgs[0]->name = $img[0];
  $uimgs[0]->path = $folder;

  $uimgs[1] = R::dispense('images');
  $uimgs[1]->name = $img[1];
  $uimgs[1]->path = $folder;
 
  $uimgs[2] = R::dispense('images');
  $uimgs[2]->name = $img[2];
  $uimgs[2]->path = $folder;

  $project->ownImagesList[] = $logo;
  for( $i = 0; $i < count($uimgs); $i++ )
  {
    $project->ownImagesList[] = $uimgs[$i];
  }

  R::store( $project );
  $alert = "success";
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Create project -- volonter.ua</title>
  </head>
  <body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success navbar-sticky"><a class="navbar-brand" href="#">Volonter</a>
      <button class="navbar-toggler" type="button" data-toggler="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
      <div class="navbar-collapse collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="navbar-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="navbar-item"><a class="nav-link" href="projects.php">Projects</a></li>
        </ul>
      </div>
    </nav>
    <?php if ($user) {?>
    <form class="mt-5 flex-grow" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <div class="container">
          <h2>Create project</h2>
          <?php if($alert) { echo '<div class="alert alert-success" role="alert">Your project uploaded successfull</div>'; }?>
          <div class="row">
            <div class="col-lg-4 col-6">
              <input class="form-control m-1" type="text" name="title" required placeholder="Title">
              <input class="form-control m-1" type="text" name="description" placeholder="Description">
            </div>
            <div class="col-lg-4 col-6">
              <label class="btn btn-outline-secondary m-1">Main image
                <input type="file" style="display: none;" name="logo_img">
              </label>
            </div>
          </div>
          <div class="row"> 
            <div class="col-lg-8 col-12">
              <textarea class="form-control m-1" placeholder="Text" rows="5" cols="3" name="text"></textarea>
            </div>
            <div class="col-lg-4 col-12">
              <select class="form-control m-1" name="type">
                <option value="type">Type</option>
                <option value="money">Money</option>
                <option value="work">Work</option>
              </select>
              <select class="form-control m-1" name="theme">
                <option value="theme">Theme</option>
                <option value="animals">Animals</option>
                <option value="garden">Garden</option>
                <option value="helth">Helth</option>
                <option value="house">House</option>
                <option value="social">Social</option>
                <option value="other">Other</option>
              </select>
              <input class="form-control m-1" placeholder="Address" name='address'>
            </div>
          </div>
          <div class="row"> 
            <div class="col-lg-8 col-12">
              <div class="row">
                <label class="btn btn-outline-secondary m-1 col">Add image
                  <input type="file" style="display: none;" name="img1">
                </label>
                <label class="btn btn-outline-secondary m-1 col">Add image
                  <input type="file" style="display: none;" name="img2">
                </label>
                <label class="btn btn-outline-secondary m-1 col">Add image
                  <input type="file" style="display: none;" name="img3">
                </label>
              </div>
            </div>
            <div class="col-lg-4 col-12">
              <button class="btn btn-primary btn-block btn-lg m-1" type="submit" name="submit">Create project</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <?php } else { ?>
      <div class="alert alert-danger" role="alert">You should be <a href="signUp.php">signed in</a></div>
    <?php }?>
    <footer class="footer bg-success p-3" style="position:fixed;bottom:0;width:100%;">
      <div class="container"><span class="text-light">2017 &copy; Anton Sizov, Vitalina Sizova and Rostislav Sizov.</span></div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>
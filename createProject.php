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
  $ext         = array(
    '.jpg',
    '.jpeg',
    '.png',
    '.gif'
  );
  $folder   = '../volonter_images/';

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

  //images
  if ( isset($_FILES['logo_img']) ) {
    $logo_img = $_FILES['logo_img']['name'];// Logo
    
    move_uploaded_file($_FILES['logo_img']['tmp_name'], $folder.$_FILES['logo_img']['name']);// Upload file

    $upload_ext = '';// Extension of Logo
    foreach ($ext as $e) {
      if ( strpos($logo_img, $e) != false) {
        $upload_ext = $e;
        
        $new_name = "img_".date("YmdHis").$upload_ext;
        //Переименуем файл на всякий случай что бы не было совпадений                                                  
        rename($folder.$logo_img, $folder.$new_name);
        $logo_img = $new_name;
        sleep(1);
        break;
      }
    }

    //-----------upload logo image-------------------
    $logo = R::dispense('images');
    $logo->name = $logo_img;
    $logo->path = $folder;

    $project->ownImagesList[0] = $logo;
  }
  
  if ( isset($_FILES['img']) ) {
    $img = array(
      'name' => array(),
      'tmp_name' => array()
    );

    //-------------Exporiting img-------------------
    // name
    foreach ($_FILES['img']['name'] as $name) {
      if ( !empty($name) ) {
        $img['name'][] = $name;
      }
    }

    // tmp_name
    foreach ($_FILES['img']['tmp_name'] as $tmp) {
      if ( !empty($tmp) ) {
        $img['tmp_name'][] = $tmp;
      }
    }

    // echo '<pre>';
    // print_r($img);
    // echo '</pre>';

    // upload images to server
    for( $i = 0; $i < count($img['name']); $i++ ) {
      move_uploaded_file($img['tmp_name'][$i], $folder.$img['name'][$i]);
    }
  
    
    for( $i = 0; $i < count($img['name']); $i++ )
    {
      $upload_ext = '';

      foreach ($ext as $e) {
        if ( strpos($img['name'][$i], $e) != false ) {
          $upload_ext = $e;

          $new_name = "img_".date("YmdHis").$upload_ext;
          rename($folder.$img['name'][$i], $folder.$new_name);
          $img['name'][$i] = $new_name;
            
          sleep(1);
          break;
        }
      }
    }

    //upload other images

    $uimgs = array();

    for ($i = 0; $i < count($img['name']); $i++) {
      

      $uimgs[$i] = R::dispense('images');
      $uimgs[$i]->name = $img['name'][$i];
      $uimgs[$i]->path = $folder;
    }

    foreach( $uimgs as $u )
    {
      $project->ownImagesList[] = $u;
    }
  }

  $id = R::store( $project );
  $alert = "success";
  header("Location: project.php?project_id=$id");
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
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Create project -- volonter.ua</title>
  </head>
  <body class="d-flex flex-column justify-content-between">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success navbar-sticky"><a class="navbar-brand" href="#">Volonter</a>
      <button class="navbar-toggler" type="button" data-toggler="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
      <div class="navbar-collapse collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="navbar-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="navbar-item"><a class="nav-link" href="projects.php">Projects</a></li>
          <?php if ( !isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link" href="signUp.php">Sign up</a></li><?php }?>
          <?php if ( !isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link" href="signIn.php">Sign in</a></li><?php }?>
          <?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link" href="createProject.php">Create project</a></li><?php }?>
          <?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link" href="user.php">User</a></li><?php }?>
          <?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link" href="signOut.php">Sign out</a></li><?php }?>
        </ul>
      </div>
    </nav>
    <?php if ($user) {?>
    <form method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <div class="container">
          <h2>Create project</h2>
          <div class="row">
            <div class="col-lg-4 col-6">
              <input class="form-control m-1" type="text" name="title" required placeholder="Title">
              <input class="form-control m-1" type="text" name="description" placeholder="Description">
            </div>
            <div class="col-lg-4 col-6">
              <label class="btn btn-outline-secondary m-1 logo-img">
              Main image
                <input type="file" style="display: none;" name="logo_img">
                <span class="image_path"></span>
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
                <label class="btn btn-outline-secondary m-1 col _img_">Add image
                  <input type="file" style="display: none;" name="img[0]">
                  <span class="image_path"></span>
                </label>
                <label class="btn btn-outline-secondary m-1 col _img_">Add image
                  <input type="file" style="display: none;" name="img[1]">
                  <span class="image_path"></span>
                </label>
                <label class="btn btn-outline-secondary m-1 col _img_">Add image
                  <input type="file" style="display: none;" name="img[2]">
                  <span class="image_path"></span>
                </label>
              </div>
            </div>
            <div class="col-lg-4 col-12">
              <button class="btn btn-success btn-block btn-lg m-1" type="submit" name="submit">Create project</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <?php } else { ?>
      <div class="alert alert-danger" role="alert">You should be <a href="signIn.php">signed in</a></div>
    <?php }?>
    <footer class="footer bg-success p-3">
      <div class="container"><span class="text-light">2017 &copy; Anton Sizov, Vitalina Sizova and Rostislav Sizov.</span></div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script>
      'use strict';
      let logo     = document.querySelector('.logo-img');
      let img      = document.querySelectorAll('._img_');
      let img_form = document.querySelectorAll('._img_ input')
      let put      = document.querySelectorAll('.image_path');

      logo.addEventListener('change', () => {
        if (document.querySelector('.logo-img input').value) {
          put[0].innerHTML = document.querySelector('.logo-img input').value; 
        } else {
          put[0].innerHTML = ''; 
        }
      });

      for (let i = 0; i < img.length; i++) {
        img[i].addEventListener('change', () => {
          if (img_form[i].value) {
            put[i+1].innerHTML = img_form[i].value; 
          } else {
            put[i+1].innerHTML = ''; 
          }
        });
      }
    </script>
  </body>
</html>
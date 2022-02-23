<?php

require "../controllers/myAcount_controller.php";

if (!isset($_SESSION['id'])) {
  header('location: login.php');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="../style/myAccount.css" />
  <script src="https://kit.fontawesome.com/a9441c7460.js" crossorigin="anonymous"></script>
  <title>Home page</title>
</head>

<body>
  <header class="header">
    <div class="cntainer fixed-top">
      <div class="logo">
        <img src="../images/logo3-.png" alt="" />
      </div>
      <div class="navbar">
        <li>
          <ul>
            <a href="#" class="fw-bold">Home</a>
          </ul>
          <ul>
            <a href="">Contact us</a>
          </ul>
        </li>
      </div>
      <div class="login">
        <span class="pe-3">
          <?php
          $setUser = new MyAccount();  ?>
          <a href=""><img class="" src="../images/avatar.webp" alt="images" /><?php echo  $setUser->firstName . ' ' . $setUser->lastName; ?></a>
        </span>
        <span class="pe-3">
          <form action="../controllers/login_controller.php" method="POST">
            <i class="fa-solid fa-right-from-bracket pe-2">
              <input name="logout" type="submit" value="Log out" style="background: transparent; color: white; border: none" /></i>
          </form>
        </span>
      </div>
    </div>
    <div class="header_titre">
      <!-- <div class="alert" >
        <div class="alert alert-<?php //echo $_SESSION['color'] ?>" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          Comment Added
        </div>
      </div> -->
      <div class="left"></div>
      <div class="right">
        <p>
          Hello <span><?php echo  $setUser->firstName; ?></span><br />
          <!-- To Your Account -->
        </p>
      </div>
    </div>
  </header>
  <div class="main">
    <div class="add_post d-flex">
      <img class="" src="../images/avatar.webp" alt="images" />
      <!-- pop up model for add post ################################################################################################################### -->
      <div class="formm">
        <input type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Create Post.." value="Create Post.." />
        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  Create Post
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="../controllers/myAcount_controller.php" method="post">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Title:</label>
                    <input type="text" class="form-control" id="recipient-name" name="title" />
                  </div>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Category:</label>
                    <select class="form-select form-control" aria-label="Default select example" name="category">
                      <option selected>choose category</option>
                      <option value="Movie">Movie</option>
                      <option value="Serie">Serie</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Description:</label>
                    <textarea class="form-control" id="message-text" name="description"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Add picture:</label>
                    <input class="form-control" type="file" id="formFile" name="image" accept=".jpg, .jpeg, .png" />
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Create" name="AddPost">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Close
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- pop up Model for Update post ########################################################################################################## -->
      <!-- affichage des postes ######################################################################################################### -->

      <?php
      $getpost->getpost();
      ?>







      <script src="../js/PopUp.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
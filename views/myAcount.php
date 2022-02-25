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
    <?php include_once '../include/header.php' ?>
    <div class="header_titre">
      <!-- <div class="left"></div>
      <div class="right">
        <p>
          Hello <span><?php //echo  $setUser->firstName; 
                      ?></span><br />
          To Your Account
        </p>
      </div> -->

      <!-- <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../images/3.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../images/2.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../images/1.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div> -->



    </div>
  </header>
  <div class="main" id="main">
    <div class="add_post d-flex" id="addPost">
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
    </div>
  </div>

  <?php include_once '../include/footer.php' ?>





  <script src="../js/PopUp.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
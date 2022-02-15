<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/login.css">
    <title>Log in</title>
</head>

<body>

    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <div class="container" style="margin-left: 20px; height: 50px;">
                <!-- Navbar Brand -->
                <a href="#" class="navbar-brand">
                    <img src="../images/cinemaster.png" alt="logo" width="150">
                </a>
            </div>
        </nav>
    </header>

    <div class="container1">

        <!-- Registeration Form -->
        <div class="form">
            <form action="../controllers/login_controller.php" method="POST">
                <div class="row">
                    <h4>Login to your account</h4>


                    <!-- UserName -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="UserName" type="text" name="userName" placeholder="UserName" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Password -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="password" type="password" name="pwd" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <span class="font-weight-bold"><input class="btn btn-block py-2" type="submit" value="Login" name="submit_login"></span>
                    </div>

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Registere <a href="signUp.php" class="text-primary ml-2">Sign up</a></p>
                    </div>

                </div>
            </form> 
        </div>
        <div class="image-backround">
            <img src="../images/pexels-pavel-danilyuk-7234219.jpg" alt="image">
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/login.js"></script>
</body>

</html>
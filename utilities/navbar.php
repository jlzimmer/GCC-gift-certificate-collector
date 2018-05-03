<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>GCC: Gift Card Collector</title>

        <!-- Boostrap 4.0 CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="utilities/navbar.css">

        <style>
            #wrapper {
                margin-top: 40px;
                align-content: center;
            }

            #login {
                margin-right: 10px;
            }
        </style>
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-sm navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">GCC - Gift Card Collector</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav mr-auto">
                        <?php
                            $loggedIn = empty($_SESSION['user']) ? false : true;

                            if ($loggedIn)
                            {
                                echo '<li id="login"><button class="btn btn-danger navbar-btn" type="button" onclick="location.href=\'utilities/logout.php\'">Log Out</button></li>';
                            }
                            else 
                            {
                                echo '<li id="signup"><button data-toggle="modal" data-target="#signupModal" class="btn btn-info navbar-btn">Sign Up</button></li>';
                                echo '<li id="login"><button data-toggle="modal" data-target="#loginModal" class="btn btn-success navbar-btn">Log In</button></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!--
            Modal Fade login
            sourced from: https://bootsnipp.com/snippets/featured/squarespace-like-modal
        -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="lineModalLabel">GCC - Login</h3>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body">	
                        <form action="utilities/login.php" method="POST">
                            <div class="form-group">
                                <label for="exampleUsername">User ID</label>
                                <input name="username" type="text" class="form-control" id="Username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="examplePassword">Password</label>
                                <input name="password" type="password" class="form-control" id="Password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--
            Modal Fade signup
        -->
        <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="lineModalLabel">GCC - Sign Up</h3>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body">	
                        <form action="utilities/signup.php" method="POST">
                            <div class="form-group">
                                <label for="exampleUsername">User ID</label>
                                <input name="username" type="text" class="form-control" id="newUsername" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="examplePassword">Password</label>
                                <input name="password" type="password" class="form-control" id="newPassword" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
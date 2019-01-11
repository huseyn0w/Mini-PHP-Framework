<?php defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!'); ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HWF - Framework Starter Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo APP_ROOT ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <a class="navbar-brand" href="#">HWF</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="mt-5">HWF mini PHP-MVC Framework starter page</h1>
          <p class="lead">Welcome to  (huseyn0w Framework) starter page. You can edit this text here: (views/starter/index.php)</p>
          <h4>Technologies that used here:</h4>
          <ul class="list">
            <li>PHP (7.2) (OOP)</li>
            <li>PHP Composer (SOON)</li>
            <li>SMPT Mailler (SOON)</li>
            <li>Self error handler class with ability to log errors into a file</li>
            <li>MVC Pattern</li>
            <li>PDO</li>
            <li>MySQL</li>
          </ul>
          <h4>Framework properties:</h4>
          <ul class="list">
            <li>Very simple to start work with.</li>
            <li>Has safe methods to work with databases by using PDO class (CRUD included)</li>
            <li>Easily explained how popular frameworks builds by using MVC pattern.</li>
            <li>Easy to extend and customize</li>
            <li>Ability to change/add template easily</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src=" <?php echo APP_ROOT ?>vendor/jquery/jquery.min.js"></script>
    <script src=" <?php echo APP_ROOT ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>

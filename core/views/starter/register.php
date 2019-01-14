<?php 
  if(is_logged_in()){
    redirect(HOME_DIR);
  }

  defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!'); 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo CORE_ROOT ?>views/<?php echo CURRENT_TEMPLATE ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo CORE_ROOT ?>views/<?php echo CURRENT_TEMPLATE ?>/vendor/style.css" rel="stylesheet">
  </head>
  <style>
    html,
    body {
    height: 100%;
    }

    body {
    display: -ms-flexbox;
    display: -webkit-box;
    display: flex;
    -ms-flex-align: center;
    -ms-flex-pack: center;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
    }

    .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
    }
    .form-signin .checkbox {
    font-weight: 400;
    }
    .form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
    }
    .form-signin .form-control:focus {
    z-index: 2;
    }
    .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    }

  </style>

  <body class="text-center">
    <form name="regForm" class="form-signin" id="form-check" method="POST">
      <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please register</h1>
      <?php if (isset($_SESSION['error'])) : ?>
        <?php
          foreach ($_SESSION['error'] as $key => $value): ?>
          <div class="alert alert-danger" role="alert"><?php echo $value  ?></div>
        <?php 
          endforeach;
          unset($_SESSION['error']);
          endif; 
        ?>
        <div class="form-group">
            <input type="email" autocomplete="off"  required name="email" class="form-control register-input input-ajax" placeholder="E-mail">
            <span class="check-up"></span>
            <div class="alert ajax-result" role="alert"></div>
        </div>
        <div class="form-group">
            <input type="text" autocomplete="off" required name="login" class="form-control register-input input-ajax" placeholder="Login">
            <span class="check-up"></span>
            <div class="alert ajax-result" role="alert"></div>
        </div>
        <div class="form-group">
            <input type="password" required name="password" class="form-control register-input" placeholder="Password">
            <div class="alert ajax-result" role="alert"></div>
        </div>
        <div class="form-group">
            <input type="password" required name="password_confirm" class="form-control register-input" placeholder="Password Confirmation">
            <div class="alert ajax-result" role="alert"></div>
        </div>
        <div class="form-group">
            <input type="text" autocomplete="off" required name="name" class="form-control register-input" placeholder="Name">
        </div>
      <button class="btn btn-lg btn-primary btn-block sendForm" type="submit" name="register_me" disabled>Register</button>
      <p class="mt-5 mb-3 text-muted">HWF &copy; <?php echo date('Y') ?></p>
    </form>
  </body>
</html>
    <script src="<?php echo CORE_ROOT ?>views/<?php echo CURRENT_TEMPLATE ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo CORE_ROOT ?>views/<?php echo CURRENT_TEMPLATE ?>/vendor/main.js"></script>
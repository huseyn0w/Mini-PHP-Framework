<?php 

if (is_logged_in()) {
  redirect(HOME_DIR);
}

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!'); ?>
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

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
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
    <form class="form-signin" method="POST">
      <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <?php if(isset($_SESSION['error_message'])): ?>
      <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error_message'];?> </div>
      <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
        <div class="form-group">
            <input type="email"  required name="email" class="form-control" placeholder="E-mail">
        </div>
        <div class="form-group">
            <input type="password" required name="password" class="form-control" placeholder="Password">
        </div>
      <button class="btn btn-lg btn-primary btn-block" name="login_me" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">HWF &copy; <?php echo date('Y') ?></p>
    </form>
  </body>
</html>

<?php 
  if(is_logged_in()){
    redirect(HOME_DIR);
  }
  defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');
  require_template_file('header');
   
  ?>  
  <style>
    html,
    body {
    height: 100%;
    }

    .reg-container{
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
    <?php require_template_file('nav'); ?>  
    <div class="container">
        <div class="row form-cover align-items-center">
            <div class="col-12">
                <form name="regForm" class="form-signin" id="form-check" method="POST">
                    <h1 class="h3 mb-3 font-weight-normal">Please register</h1>
                    <?php if(isset($_SESSION['error_csrf'])): ?>
                        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error_csrf'];?> </div>
                        <?php unset($_SESSION['error_csrf']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error_message'])) : ?>
                        <?php
                        foreach ($_SESSION['error_message'] as $key => $value): ?>
                            <div class="alert alert-danger" role="alert"><?php echo $value  ?></div>
                        <?php
                        endforeach;
                        unset($_SESSION['error_message']);
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
                    <input type="hidden" name="csrf" value="<?php echo generate_csrf_token() ?>">
                    <button class="btn btn-lg btn-primary btn-block sendForm" type="submit" name="register_me" disabled>Register</button>
                    <p class="mt-5 mb-3 text-muted">HWF &copy; <?php echo date('Y') ?></p>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
<?php require_template_file('footer'); ?>
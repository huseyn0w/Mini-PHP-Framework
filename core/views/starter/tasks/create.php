<?php 

if (!is_logged_in()) {
    redirect(HOME_DIR . '/login/');
}

    defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');
    require_template_file('header');
?>

  <?php require_template_file('nav'); ?>  

  
    <!-- Page Content -->
    <div class="container reg-container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="mt-5">HWF mini PHP-MVC Framework</h1>
          <p class="lead">Task creating interface</p>
          <?php
            if (isset($_SESSION['error'])) :
                foreach ($_SESSION['error'] as $key => $value) : ?>
                    <div class="alert alert-danger" role="alert"><?php echo $value ?></div>
          <?php 
                endforeach;
            unset($_SESSION['error']);
            endif;
          ?>
            <form name="regForm" class="taskContentForm taskAddForm" method="POST">
                <div class="form-group">
                    <input type="text" autocomplete="off" required name="name" class="form-control" placeholder="Heading">
                </div>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Task description" name="desc" required rows="3"></textarea>
                </div>
                <input type="hidden" name="csrf" value="<?php echo generate_csrf_token() ?>">
                <input type="submit" class="btn btn-lg btn-primary btn-block addTask sendForm" name="add_task" value="Add" />
            </form>
        </div>
      </div>
    </div>

<?php require_template_file('footer'); ?>
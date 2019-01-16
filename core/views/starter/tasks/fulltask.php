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
          <p class="lead">Task showing interface</p>
            <h2><?php echo $data['header'] ?></h2>
            <p><?php echo $data['date'] ?></p>
            <div><?php echo $data['text'] ?></div>
            <?php $status = $data['status']; $status == 0 ? $status = 'Pending' : $status = 'Done'; ?>
            <strong><?php echo $status  ?></strong>
        </div>
      </div>
    </div>

<?php require_template_file('footer'); ?>
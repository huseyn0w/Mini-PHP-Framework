<?php defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!'); ?>
<?php require_template_file('header'); ?>

  <body>


  <?php require_template_file('nav'); ?>  

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="mt-5">HWF mini PHP-MVC Framework starter page</h1>
          <p class="lead">Welcome to  (huseyn0w Framework) starter page. You can edit this text here: (core/views/starter/index.php)</p>
          <h4>Technologies that used here:</h4>
           <p>To change constants values change core/config/constants.php file</p>
           <p>To change/add routes change core/config/routes.php file</p>
          <ul class="list">
            <li>PHP 7 + OOP</li>
            <li>Composer</li>
            <li>Self error handler class with ability to log errors into a file</li>
            <li>MVC Pattern</li>
            <li>MySQL + PDO</li>
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

<?php require_template_file('footer'); ?>
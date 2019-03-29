<?php defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!'); ?>
<?php require_template_file('header'); ?>

  <body>
  <div class="page-loader">
    <div class="loader-container">
      <div class="dot dot-1"></div>
      <div class="dot dot-2"></div>
      <div class="dot dot-3"></div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
      <defs>
        <filter id="goo">
          <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -7"/>
        </filter>
      </defs>
    </svg>
  </div>
  <?php require_template_file('nav'); ?>

    <!-- Page Content -->
    <div class="container reg-container">
      <div class="row">
        <div class="col-lg-12">
          <?php if(is_logged_in()): ?>
            <h1 class="mt-5">Welcome <?php echo ucwords($data['userArray'][0]['name']); ?></h1>
          <?php else: ?>
            <h1 class="mt-5">HWF mini PHP-MVC Framework</h1>
          <?php endif; ?>
          <p class="lead">Here is an example of todolist application based on this framework, but you can create everything that you want to with it.</p>
      <?php if(is_logged_in() && is_array($data['tasksArray']) && $data['tasksArray'] !== false && !empty($data['tasksArray'])): ?>
          <div class="table-responsive">
            <div class="orders">
              <div class="ordering">
                <p>Order by:</p>
                <select name="order" id="orderTasks" class="form-control orderTasks">
                  <option value="date">Date</option>
                  <option value="status">Status</option>
                </select>
              </div>
              <div class="ordering ordering2">
                <p>Action with market Items:</p>
                <button class="btn btn-danger deleteMarkedTasks" type="submit">Delete</button>
              </div>
            </div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><input type="checkbox" id="CheckAll" name="check" value="CheckAll"></th>
                  <th scope="col">TaskName</th>
                  <th scope="col">Author</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Current status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $rowCount = 0; foreach($data['tasksArray'] as $key => $value): $rowCount++; ?>
                <tr>
                  <th scope="row"><?php echo $rowCount ?></th>
                  <td><input type="checkbox" name="check" class="taskCheckbox" value="<?php echo $value['task_id'] ?>"></td>
                  <td><a href="<?php echo HOME_DIR ?>/tasks/read/<?php echo $value['task_id'] ?>"><?php echo $value['header']; ?></a></td>
                  <td><?php echo ucwords($value['user_name']); ?></td>
                  <td><?php echo $value['date']; ?></td>
                  <td>
                  <?php
                      $status = $value['status'];
                      $status == 0 ? $status = 'Pending' : $status  = 'Done';
                      echo $status;
                  ?>
                  </td>
                  <td>
                    <a href="<?php echo HOME_DIR ?>/tasks/update/<?php echo $value['task_id'] ?>" target="_blank" class="btn btn-primary">Edit</a>
                    <button class="btn btn-danger deleteTask" data-taskID="<?php echo $value['task_id'] ?>" type="submit">Delete</button>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
            </div>
          <?php else: ?>
          <h2>Tasklist is empty, you can add new task now. Sign in or sign up to do it</h2>
          <?php endif; ?>

          <?php generate_pagination(); ?>
        </div>
      </div>
    </div>

<?php require_template_file('footer'); ?>
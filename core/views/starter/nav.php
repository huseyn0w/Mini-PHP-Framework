<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <a class="navbar-brand" href="<?php echo HOME_DIR ?>">HWF</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo HOME_DIR ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/about-framework">About framework</a>
            </li>
            <?php if (is_logged_in()) : ?>
            <li class="nav-item">
              <a class="nav-link" href="/tasks/create/">Add New Task</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/logout">Exit</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="/register">Registration </a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
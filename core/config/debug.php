<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Error :(</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo APP_ROOT ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
  <style>
    :root {
        --input-padding-x: .75rem;
        --input-padding-y: .75rem;
    }

    html,
    body {
        height: 100%;
    }

    .alert p:last-child{
        margin-bottom:0;
    }

    body {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        flex-wrap:wrap;
        flex-flow:column;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        padding:20px;
        background-color: #f5f5f5;
        justify-content: center;
    }

</style>
    <h2>We have detected an error!</h2>
    <div class="errors">
    <?php foreach ($errorArray as $error): ?>
        <div class="alert alert-danger" role="alert">
            <p><strong>File: </strong><?php echo $error['filename'] ?></p>
            <p><strong>Error: </strong><?php echo $error['message'] ?></p>
        </div>
    <?php endforeach; ?>
    </div>
  </body>
</html>

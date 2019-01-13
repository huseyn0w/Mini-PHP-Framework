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
    <?php foreach ($errorArray as $error): 
        switch ($error['type']) {
            case 'E_WARNING': 
                $errorClassName = "warning";
                break;


            case 'E_PARSE':
                $errorClassName = "info";
                break;


            case 'E_NOTICE':
                $errorClassName = "info";
                break;


            case 'E_CORE_ERROR': 
                $errorClassName = "danger";
                break;


            case 'E_CORE_WARNING': 
                $errorClassName = "warning";
                break;


            case 'E_COMPILE_ERROR':
                $errorClassName = "danger";
                break;


            case 'E_COMPILE_WARNING':
                $errorClassName = "warning";
                break;


            case 'E_USER_ERROR': 
                $errorClassName = "info";
                break;


            case 'E_USER_WARNING':
                $errorClassName = "warning";
                break;


            case 'E_USER_NOTICE':
                $errorClassName = "warning";
                break;


            case 'E_STRICT': 
                $errorClassName = "warning";
                break;


            case 'E_RECOVERABLE_ERROR': 
                $errorClassName = "danger";
                break;


            case 'E_DEPRECATED': 
                $errorClassName = "warning";
                break;


            case 'E_USER_DEPRECATED':
                $errorClassName = "warning";
                break;

            default:
                $errorClassName = "info";
                break;
        }
    ?>
        <div class="alert alert-<?php echo $errorClassName ?>" role="alert">
            <p><strong>Type: </strong><?php echo $error['type'] ?></p>
            <p><strong>Error: </strong><?php echo $error['message'] ?></p>
            <p><strong>File: </strong><?php echo $error['file'] ?></p>
            <p><strong>Line: </strong><?php echo $error['line'] ?></p>
        </div>
    <?php endforeach; ?>
    </div>
  </body>
</html>

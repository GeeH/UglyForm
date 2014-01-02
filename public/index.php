<?php
chdir('../');
require_once('vendor/autoload.php');

$form = new \UglyForm\Form\Form('login');
$form->addElement('username')->setValidator(\Respect\Validation\Validator::create()->email());
$form->addElement('password')->setValidator(\Respect\Validation\Validator::create()->string()->notEmpty()->min(5));
$form->addElement('submit')->setTag('button');
$form->getElement('submit')->setAttributes(array('type' => 'submit'));
$form->getElement('submit')->setValue('Login');

$form->setDefaultElementAttributes(
    array(
        'class' => 'form-control col-xs-6'
    )
);

$renderer = new \UglyForm\Renderer\Element();
$labelRenderer = new \UglyForm\Renderer\Label();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container well well-lg">
    <form name="form" method="post" role="form">
        <div class="form-group col-lg-4">
            <?php echo $labelRenderer->render($form, 'username') .
                $renderer->render($form, 'username'); ?>
        </div>
        <div class="form-group col-lg-4">
            <?php echo $labelRenderer->render($form, 'password') .
                $renderer->render($form, 'password', array('type' => 'password')); ?>
        </div>
        <div class="form-group col-lg-4">
            <?php
                echo $renderer->render($form, 'submit', array('type' => 'password')); ?>
        </div>
    </form>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
chdir('../');
require_once('vendor/autoload.php');

$form = new \UglyForm\Form\Form('login');
$form->addElement('username')->setValidator(\Respect\Validation\Validator::create()->email()->notEmpty());
$form->addElement('password')->setValidator(\Respect\Validation\Validator::create()->string()->notEmpty()->length(5, 256));
$form->addElement('submit')->setTag('button');
$form->getElement('submit')->setAttributes(array('type' => 'submit'));
$form->getElement('submit')->setValue('Login');

$form->setDefaultElementAttributes(
    array(
        'class' => 'form-control col-xs-6'
    )
);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form->setValues($_POST);
}

$renderer = new \UglyForm\Renderer\Row();
$renderer->setWrapperAttributes(
    array(
        'class' => 'form-group'
    )
);
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
    <form class="form-inline" name="form" method="post" role="form">
        <?php echo $renderer->render($form, 'username'); ?>
        <?php echo $renderer->render($form, 'password'); ?>
        <?php $renderer->setRenderLabel(false); ?>
        <?php echo $renderer->render($form, 'submit'); ?>
    </form>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
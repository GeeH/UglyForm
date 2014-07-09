<?php

chdir('../');
require_once('vendor/autoload.php');

$form = new \UglyForm\Form\Form('register');
$form->addElement('username')->setValidator(\Respect\Validation\Validator::create()->email()->notEmpty());
$form->addElement('password')->setValidator(
    \Respect\Validation\Validator::create()->string()->notEmpty()->length(5, 256)
);

$passwordMatch = $form->addElement('password-match');
$passwordMatch->setValidator(
    \Respect\Validation\Validator::create()->string()->notEmpty()->length(5, 256)
);
$passwordMatch->setLabel('Password Match');

$form->addElement('submit')->setTag('button');
$form->getElement('submit')->setAttributes(array('type' => 'submit'));
$form->getElement('submit')->setValue('Register');

$form->setDefaultElementAttributes(
    array(
        'class' => 'form-control'
    )
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form->setValues($_POST);
    $form->getElement('password-match')->setValidator(
        $form->getElement('password-match')->getValidator()->equals($form->getElement('password')->getValue()
    ));
}

$renderer = new \UglyForm\Renderer\Row();
$renderer->setWrapperAttributes(
    array(
        'class' => 'form-group col-md-7'
    )
);

$errorRenderer = new \UglyForm\Renderer\Error();
$errorRenderer->setDefaultAttributes(
    array(
        'class' => 'has-error'
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
    <form class="form" name="form" method="post" role="form">
        <?php echo $renderer->render(
            $form,
            'username',
            array('message' => 'Please enter a valid email address')
        ); ?>
        <?php echo $renderer->render($form, 'password', array('message' => 'Please enter a valid password')); ?>
        <?php echo $renderer->render(
            $form,
            'password-match',
            array('message' => 'Passwords must match')
        ); ?>

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
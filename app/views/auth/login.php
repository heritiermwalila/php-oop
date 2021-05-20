<?php

use Core\Auth\BasicAuth;
use Core\Html\Form\BootstrapForm;
use Core\QueryBuilder\SQLQueryBuilder;

$auth = new BasicAuth(App::getInstance()->getDb(), new SQLQueryBuilder());

if($auth->login($_POST['username'], $_POST['password'])){
    die('Connected');
}

$form = new BootstrapForm($_POST);

$form->submit();


?>

<div class="login__page">
    <h4 class="title">Login</h4>
    <p>Enter your admin credentials</p>
    <form action="" method="post">
        <div class="form-group mb-3">
            <?= $form->input('username', 'Username', ['class'=>'form-control']); ?>
        </div>
        <div class="form-group">
            <?= $form->input('password', 'Password', ['class'=>'form-control', 'type'=>'password']); ?>
        </div>
        
        <div class="mt-5">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>
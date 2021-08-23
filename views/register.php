<h2>REGISTER</h2>

<?php

use app\src\form\Form;
use app\src\form\Input;
use app\src\form\Button;

$form = new Form();

$inputText = new Input( 'text', 'firstname');
$inputText->renderInput();

$inputPass = new Input('password', 'passwd');
$inputPass->renderInput();

Button::send('submit', 'submit', 'Sign in');

$form->startForm('/contact', 'POST');

$form->endForm();
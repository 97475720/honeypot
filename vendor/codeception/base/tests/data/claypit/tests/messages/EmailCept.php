<?php
// @env email
$I = new MessageGuy($scenario);
$I->wantTo('Article emails');
$I->expect('emails are sent');
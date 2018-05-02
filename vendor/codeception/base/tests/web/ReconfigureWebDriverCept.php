<?php
$I = new WebGuy($scenario);
$I->wantTo('Article two different browsers in one Article');
$I->changeBrowser('chrome');
$I->amOnPage('/user-agent');
$I->see('Chrome');
$I->changeBrowser('firefox');
$I->amOnPage('/user-agent');
$I->see('Firefox');

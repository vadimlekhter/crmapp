<?php
/** @var $scenario Codeception\Scenario */
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/');
$I->see('Hi');


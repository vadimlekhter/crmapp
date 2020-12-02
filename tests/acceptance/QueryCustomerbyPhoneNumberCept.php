<?php
/** @var $scenario Codeception\Scenario */
$I = new \Step\Acceptance\CRMOperatorStep($scenario);
$I->wantTo('add two different customers to database and find one of them');

$I->amInAddCustomerUI();
$firstCustomer = $I->imagineCustomer();
$I->fillCustomerDataForm($firstCustomer);
$I->submitCustomerDataForm();
$I->seeIAmInListCustomerUI();

$I->amInAddCustomerUI();
$secondCustomer = $I->imagineCustomer();
$I->fillCustomerDataForm($secondCustomer);
$I->submitCustomerDataForm();
$I->seeIAmInListCustomerUI();


$I = new \Step\Acceptance\CRMUserStep($scenario);
$I->wantTo('get customer by phone number');

$I->amInQueryCustomerUI();
$I->fillPhoneFieldInDataForm($firstCustomer);
$I->clickSearchButton();
$I->seeIAmInListCustomerUI();
$I->seeCustomerInlist($firstCustomer);
$I->dontSeeCustomerInlist($secondCustomer);
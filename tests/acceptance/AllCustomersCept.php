<?php
/** @var $scenario Codeception\Scenario */
$I = new \Step\Acceptance\CRMOperatorStep($scenario);
$I->wantTo('add two different customers to database');

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
$I->wantTo('see customer');

$I->seeCustomerInAllList($firstCustomer);
$I->seeCustomerInAlllist($secondCustomer);
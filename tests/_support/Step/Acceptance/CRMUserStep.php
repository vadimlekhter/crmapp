<?php

namespace Step\Acceptance;

class CRMUserStep extends \AcceptanceTester
{
    public function amInQueryCustomerUI()
    {
        $I = $this;
        $I->amOnPage('/customers/query');
    }

    public function amInAllCustomerUI()
    {
        $I = $this;
        $I->amOnPage('/customers/');
    }

    public function fillPhoneFieldInDataForm($customer_data)
    {
        $I = $this;
        $I->fillField('phone_number', $customer_data['PhoneRecord[number]']);
    }

    public function clickSearchButton()
    {
        $I = $this;
        $I->click('Search');
    }

    public function seeIAmInListCustomerUI()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('/customers/');
    }

    public function seeCustomerInList($customer_data)
    {
        $I = $this;
        $I->see($customer_data['CustomerRecord[name]'], '#search_results');
    }

    public function dontSeeCustomerInList($customer_data)
    {
        $I = $this;
        $I->dontSee($customer_data['CustomerRecord[name]'], '#search_results');
    }

    public function seeCustomerInAllList($customer_data)
    {
        $I = $this;
        $I->see($customer_data['CustomerRecord[name]']);
    }

    public function seeLargeBodyOfText(){
        $I = $this;
        $text = $I->grabTextFrom('p');
        $I->seeContentIsLong($text, 100);
    }
}
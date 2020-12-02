<?php

namespace Step\Acceptance;

use Faker;

class CRMOperatorStep extends \AcceptanceTester
{
    public function amInAddCustomerUI()
    {
        $I = $this;
        $I->amOnPage('/customers/add');
    }

    public function imagineCustomer()
    {
        $faker = Faker\Factory::create();
        return [
            'CustomerRecord[name]' => $faker->name,
            'CustomerRecord[birth_date]' => $faker->date('Y-m-d'),
            'CustomerRecord[notes]' => $faker->sentence(8),
            'PhoneRecord[number]' => $faker->phoneNumber,
            'PhoneRecord[home_number]' => $faker->phoneNumber,
            'PhoneRecord[work_number]' => $faker->phoneNumber
        ];
    }

    public function fillCustomerDataForm($fieldsData)
    {
        $I = $this;
        foreach ($fieldsData as $key => $value) {
            $I->fillField($key, $value);
        }
    }

    public function submitCustomerDataForm()
    {
        $I = $this;
        $I->click('Submit');
    }

    public function seeIAmInListCustomerUI()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('/customers/');
    }

    function amInListCustomersUI()
    {
        $I = $this;
        $I->amOnPage('/customers');
    }
}
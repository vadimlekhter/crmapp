<?php

use app\models\customer\CustomerRecord;
use app\models\customer\PhoneRecord;

/**
 * @var $customer_record CustomerRecord
 * @var $phone_record PhoneRecord
 */

echo $this->render('_form', compact('customer_record', 'phone_record'));
<?php


namespace app\modules\api\models;


class CustomerRecord extends \app\models\customer\CustomerRecord
{
    public function extraFields()
    {
        return ['phoneRecord'];
    }

}
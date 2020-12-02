<?php


namespace app\models\customer;


class Phone
{
    /** var string */
    public $number;

    /** var string */
    public $home_number;

    /** var string */
    public $work_number;

    /**
     * Phone constructor.
     * @param $number
     */
    public function __construct($number, $home_number, $work_number)
    {
        $this->number = $number;
        $this->home_number = $home_number;
        $this->work_number = $work_number;
    }


}
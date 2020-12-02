<?php


namespace app\interfaces;


interface EmailServiceInterface
{
    public function send($to, $subject, $data, $views);
}
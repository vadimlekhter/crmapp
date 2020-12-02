<?php


namespace app\utilities;

use yii\web\ResponseFormatterInterface;
//use thamtech\yaml\helpers\Yaml;
use Symfony\Component\Yaml\Yaml;

class YamlResponseFormatter implements ResponseFormatterInterface
{
    const FORMAT = 'yaml';

    public function format($response)
    {
        $response->headers->set('Content-Type: application/yaml');
//        $response->headers->set('Content·Disposition: inline');
        $response->content = Yaml::dump($response->data);
    }
}
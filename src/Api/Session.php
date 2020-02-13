<?php
/**
 * User: Anderson Vaz - anderson@wdhouse.com.br DEVOPS - WDHOUSE
 * Date: 07/02/20 14:01
 */
namespace Deploycloud\Portainer\Api;

use Exception;

class Session
{
    /**
     * @var array
     */
    public $headers;

    public function __construct()
    {
        $this->headers = [];
    }
}

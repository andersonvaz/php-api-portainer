<?php
/**
 * User: Anderson Vaz - anderson@wdhouse.com.br DEVOPS - WDHOUSE
 * Date: 07/02/20 14:01
 */
namespace Deploycloud\Portainer\Api;

use Exception;

class Containers
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client, string $baseUrl)
    {
        $this->client  = $client;
        $this->baseUrl = $baseUrl;
        $this->request = new Request();
    }

    public function getAll(array $query = array('all'=>'1')): array
    {
        $url = $this->baseUrl.'/json';
        return $this->request->do('GET', $url, $query, $this->client->session()->headers);
    }

    public function getFilterStackName(string $name)
    {
        return $this->getAll(array('all'=>1, 'filters' =>'{"label":["com.docker.compose.project='.$name.'"]}'));
    }
}

<?php
/**
 * User: Anderson Vaz - anderson@wdhouse.com.br DEVOPS - WDHOUSE
 * Date: 07/02/20 14:01
 */
namespace Deploycloud\Portainer\Api;

use Exception;

class Container
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

    private $container;

    public function __construct(Client $client, string $baseUrl, array $container)
    {
        $this->client  = $client;
        $this->baseUrl = $baseUrl;
        $this->request = new Request();
        $this->container = $container;
    }

    public function getName()
    {
        return substr($this->container["Names"][0], 1);
    }

    public function getId()
    {
        return $this->container["Id"];
    }

    public function getStatus()
    {
        return $this->container['Status'];
    }

    public function getState()
    {
        return $this->container['State'];
    }

    public function start()
    {
        $url = $this->baseUrl.'/'.$this->getId().'/start';
        return $this->request->do('POST', $url, array(), $this->client->session()->headers);
    }

    public function stop()
    {
        $url = $this->baseUrl.'/'.$this->getId().'/stop';
        return $this->request->do('POST', $url, array(), $this->client->session()->headers);
    }

    public function restart()
    {
        $url = $this->baseUrl.'/'.$this->getId().'/restart';
        return $this->request->do('POST', $url, array(), $this->client->session()->headers);
    }

    public function getLogs($query = array('since' => 0, 'stderr' => '1', 'stdout' => 1, 'tail' => 100, 'timestamps' => 0))
    {
        $url = $this->baseUrl.'/'.$this->getId().'/logs';
        return $this->request->do('GET', $url, $query, $this->client->session()->headers);
    }
}

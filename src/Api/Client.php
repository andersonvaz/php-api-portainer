<?php
/**
 * User: Anderson Vaz - anderson@wdhouse.com.br DEVOPS - WDHOUSE
 * Date: 07/02/20 13:53
 */
namespace Deploycloud\Portainer\Api;

class Client
{
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var Session
     */
    private $session;

    public function __construct(string $endpoint)
    {
        $this->session  = new Session();
        $this->endpoint = $endpoint;

        if ($this->endpoint[strlen($this->endpoint) - 1] === '/') {
            $this->endpoint = substr($this->endpoint, 0, strlen($this->endpoint) - 1);
        }

        if (strpos($this->endpoint, '/api') === false) {
            $this->endpoint .= '/api';
        }
    }

    public function request(string $method, string $path, array $data = [], array $headers = []): array
    {
        $url = "{$this->endpoint}/$path";
        $this->request = new Request();
        $response = $this->request->do($method, $url, $data, $headers);

        return $response;
    }

    /**
     * @return Session
     */
    public function session()
    {
        return $this->session;
    }

    /**
     * @return Session
     */
    public function createPath($path)
    {
        $path = new Path($this, "{$this->endpoint}/{$path}");
        return $path;
    }
    public function createPathContainers($path)
    {
        $path = new Containers($this, "{$this->endpoint}/{$path}");
        return $path;
    }
    public function createPathContainer($path, $container)
    {
        $path = new Container($this, "{$this->endpoint}/{$path}", $container);
        return $path;
    }
}

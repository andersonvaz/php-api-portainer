<?php
/**
     * User: Anderson Vaz - anderson@wdhouse.com.br DEVOPS - WDHOUSE
     * Date: 07/02/20 13:53
 */
namespace Deploycloud\Portainer\Api;

use Exception;

class Path
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

    /**
     * Returns all items (Method GET)
     * @param array $query
     * @return array
     * @throws Exception
     */
    public function getAll(array $query = []): array
    {
        return $this->request->do('GET', $this->baseUrl, $query, $this->client->session()->headers);
    }

    /**
     * Returns the item by id (Method GET)
     * @param mixed $id
     * @return array
     * @throws Exception
     */
    public function get($id): array
    {
        return $this->request->do('GET', "{$this->baseUrl}/{$id}", [], $this->client->session()->headers);
    }

    /**
     * Append a item to collection (Method POST)
     * @param array $data
     * @return array|null
     * @throws Exception
     */
    public function add(array $data, array $query = [])/*: ?array */
    {
        $url = $this->generateUrl($this->baseUrl, $query);
        return $this->request->do('POST', $url, $data, $this->client->session()->headers);
    }

    /**
     * Update existing item (Method PUT)
     * @param mixed $id
     * @param array $data
     * @return array|null
     * @throws Exception
     */
    public function update($id, array $data, array $query = [])/*: ?array */
    {
        $url = $this->generateUrl("{$this->baseUrl}/{$id}", $query);

        return $this->request->do('PUT', $url, $data, $this->client->session()->headers);
    }

    /**
     * Delete existing item (Method DELETE)
     * @param mixed $id
     * @return array|null
     * @throws Exception
     */
    public function delete($id, array $query = [])/*: ?array */
    {
        $url = $this->generateUrl("{$this->baseUrl}/{$id}", $query);

        return $this->request->do('DELETE', $url, [], $this->client->session()->headers);
    }

    /**
     * Generate URL with querystring
     * @param string $url
     * @param array $query
     * @return string
     */
    private function generateUrl(string $url, array $query): string
    {
        if (count($query)) {
            if (strpos($url, '?') === false) {
                $separator = '?';
            } else {
                $separator = '&';
            }
            $url .= $separator . http_build_query($query);
        }

        return $url;
    }
}

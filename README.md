# php-api-portainer
PHP API client for Portainer

    $portainer = new Deploycloud\Portainer\ApiClient('http://127.0.0.1:9000');
    $portainer->auth('test', 'PASSWORD');
    $endpointsApi = $portainer->endpoints();
    $endpoints = $endpointsApi->getAll();
    $containeres = $portainer->containers($endpoints[0]['Id'])->getAll();
    foreach ($containeres as $key => $value) {
        var_dump($portainer->container($endpoints[0]['Id'], $value)->getName());
        var_dump($portainer->container($endpoints[0]['Id'], $value)->getStatus());
        var_dump($portainer->container($endpoints[0]['Id'], $value)->getState());
        if ($portainer->container($endpoints[0]['Id'], $value)->getState() == 'exited') {
                $portainer->container($endpoints[0]['Id'], $value)->start();
        }
        if ($portainer->container($endpoints[0]['Id'], $value)->getState() == 'running') {
                $portainer->container($endpoints[0]['Id'], $value)->stop();
        }
    }


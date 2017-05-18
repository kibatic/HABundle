<?php


namespace Kibatic\HABundle\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class HACollector extends DataCollector
{
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data = array(
            'host' => gethostname(),
            'headers' => $request->headers->all(),
            'client_ips' => $request->getClientIps(),
            'http_host' => $request->getHttpHost(),
            'trusted_proxies' => $request->getTrustedProxies(),
            'local_ip' => $request->server->get('SERVER_ADDR'),
            'is_secure' => $request->isSecure()
        );
    }

    public function getData()
    {
        return $this->data;
    }

    public function getName()
    {
        return 'kibatic_ha.ha_collector';
    }
}

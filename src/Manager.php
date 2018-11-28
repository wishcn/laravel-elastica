<?php

namespace Xxstop\LaravelElastica;

use Elastica\Client;

class Manager
{
    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $app;

    /**
     * @var \Elastica\Client
     */
    protected $client;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function connection(string $name = null) : Client
    {
        $name = $name ?: $this->getDefaultConnection();

        if (is_null($this->client)) {
            $this->client = new Client([
                "connections" => $this->getHosts($name),
            ]);
        }

        return $this->client;
    }

    public function getHosts(string $name) : array
    {
        return array_get($this->getConfig($name), "hosts");
    }

    public function getConfig(string $name)
    {
        $connections = $this->app["config"]['elastica.connections'];

        if (null === $config = array_get($connections, $name)) {
            throw new \InvalidArgumentException("Elastica connection [$name] not configured.");
        }

        return $config;
    }

    public function getDefaultConnection(): string
    {
        return $this->app['config']['elastica.defaultConnection'];
    }

    public function __call(string $method, array $parameters)
    {
        return call_user_func_array([$this->connection(), $method], $parameters);
    }
}
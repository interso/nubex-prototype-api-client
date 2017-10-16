<?php

namespace Interso\NubexPrototypeAPI;

use GuzzleHttp\Client as HttpClient;

use Interso\NubexPrototypeAPI\Commands\AgentCommands;


class Facade
{

    /**
     * @var string
     */
    protected $apiUrl;
    /**
     * @var string
     */
    protected $apiKey;
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var AgentCommands
     */
    protected $agentCommands;


    /**
     * Facade constructor.
     *
     * @param string $apiUrl
     * @param string $apiKey
     */
    public function __construct($apiUrl, $apiKey)
    {
        $httpClient = new HttpClient();
        $this->client = new Client($apiUrl, $apiKey, $httpClient);
    }


    /**
     * @return AgentCommands
     */
    public function agents()
    {
        if (!$this->agentCommands) {
            $this->agentCommands = new AgentCommands($this->client);
        }

        return $this->agentCommands;
    }
}
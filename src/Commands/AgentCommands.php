<?php

namespace Interso\NubexPrototypeAPI\Commands;


use Interso\NubexPrototypeAPI\Client;
use Interso\NubexPrototypeAPI\DTO\AgentDTO;

class AgentCommands
{

    /**
     * @var Client
     */
    private $client;


    /**
     * AgentCommands constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function getList()
    {
        $data = $this->client->get('agents');
        return !is_array($data) ? [] : array_map(array($this, 'transform'), $data);
    }


    public function create($code)
    {
        $this->client->post('agents', ['']);

    }

    protected function transform($data)
    {
        $agent = new AgentDTO();
        $agent->setId($data['id']);
        $agent->setCode($data['code']);
        $agent->setUrl($data['url']);
        $agent->setApiKey($data['apiKey']);
        return $agent;
    }

}
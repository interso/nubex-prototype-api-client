<?php

use GuzzleHttp\ClientInterface;
use Interso\NubexPrototypeAPI\Client;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\TestCase;


class ClientTest extends TestCase
{

    protected $clientBaseUrl = 'http://default.com/api';
    protected $clientApiKey = 'okfoqkewfpo3j4ijeri';


    public function testCreate()
    {
        $mock = new MockHandler([]);
        $handler = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handler]);

        $client = new Client($this->clientBaseUrl, $this->clientApiKey, $httpClient);

        $this->assertInstanceOf(ClientInterface::class, $httpClient);
        $this->assertInstanceOf(Client::class, $client);
    }


    public function testHttpOptions()
    {
        $mock = new MockHandler([]);
        $handler = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handler]);

        $client = new Client($this->clientBaseUrl, $this->clientApiKey, $httpClient);

        $this->assertEmpty($client->getHttpOptions());

        $optionsSet1 = ['timeout' => 10];
        $optionsSet2 = ['timeout' => 2, 'headers' => ['X-Foo' => 'overwrite']];
        $optionsSet3 = ['timeout' => 20, 'headers' => ['X-Foo' => 'overwrite']];

        $this->assertEmpty($client->getHttpOptions());

        $client->setHttpOptions($optionsSet1);
        $this->assertEquals($optionsSet1, $client->getHttpOptions());

        $client->setHttpOptions($optionsSet2);
        $this->assertEquals($optionsSet2, $client->getHttpOptions());

        $client->setHttpOption('timeout', 20);
        $this->assertEquals($optionsSet3, $client->getHttpOptions());
    }


    public function testPrepareUri()
    {
        $mock = new MockHandler([]);
        $handler = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handler]);

        $client = new Client($this->clientBaseUrl, $this->clientApiKey, $httpClient);

        $this->assertEquals('http://default.com/api/agents' , $client->prepareUri('agents'));

    }

    public function testGetQuery()
    {
        $agent1 = ['id'=>1, 'code'=>1, 'url'=>'http://zboncak.com/api', 'apiKey'=>'ssewjfweofijiow'];
        $agent2 = ['id'=>2, 'code'=>2, 'url'=>'http://zbo3dswk.com/api', 'apiKey'=>'ssewj33992ijiow'];

        $sourceAgents = [];
        $sourceAgents[] = $agent1;
        $sourceAgents[] = $agent2;

        $body = json_encode($sourceAgents);

        $mock = new MockHandler([
            new Response(200, [], $body)
        ]);
        $handler = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handler]);

        $client = new Client($this->clientBaseUrl, $this->clientApiKey, $httpClient);
        $agents = $client->get('agents');

        $this->assertTrue(is_array($agents));
        $this->assertCount(2, $agents);

        $agent = array_shift($agents);

        $this->assertEquals($agent1, $agent);

    }

}

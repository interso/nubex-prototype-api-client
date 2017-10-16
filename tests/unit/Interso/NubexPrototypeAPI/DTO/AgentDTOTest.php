<?php

use PHPUnit\Framework\TestCase;
use Interso\NubexPrototypeAPI\DTO\AgentDTO;


class AgentDTOTest extends TestCase
{
    public function testEmpty()
    {
        $agent = new AgentDTO();
        $this->assertNull($agent->getId());
        $this->assertNull($agent->getCode());
        $this->assertNull($agent->getUrl());
        $this->assertNull($agent->getApiKey());
    }


    public function testChangeTwice()
    {
        $agent = new AgentDTO();

        $agent->setId(1);
        $this->assertEquals(1, $agent->getId());
        $agent->setId(2);
        $this->assertEquals(2, $agent->getId());

        $agent->setCode('Hello code 1');
        $this->assertEquals('Hello code 1', $agent->getCode());
        $agent->setCode('Hello code 2');
        $this->assertEquals('Hello code 2', $agent->getCode());

        $agent->setUrl('Url 1');
        $this->assertEquals('Url 1', $agent->getUrl());
        $agent->setUrl('Url 2');
        $this->assertEquals('Url 2', $agent->getUrl());

        $agent->setApiKey('Key 1');
        $this->assertEquals('Key 1', $agent->getApiKey());
        $agent->setApiKey('Key 2');
        $this->assertEquals('Key 2', $agent->getApiKey());
    }

}
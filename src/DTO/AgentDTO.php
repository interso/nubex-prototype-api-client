<?php

namespace Interso\NubexPrototypeAPI\DTO;


class AgentDTO
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $code;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $apiKey;


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }


    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }


    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }


    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }


    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }


}

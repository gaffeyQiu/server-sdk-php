<?php
namespace HanCloud;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class Request
{
    private $appKey;
    private $appSecret;
    private $baseUrl;
    private $handler;


    public function __construct(HandlerStack $handler = null)
    {
        $this->appKey = HanCloud::$appKey;
        $this->appSecret = HanCloud::$appSecret;
        $this->baseUrl = HanCloud::$baseUrl;
        $this->handler = $handler;
    }


    /**
     * 构造请求 headers
     * @return array
     */
    private function createHeaders(): array
    {
        list($nonce, $timestamp, $signature) = Utils::signature($this->appSecret);
        return [
            'app-key' => $this->appKey,
            'nonce' => $nonce,
            'timestamp' => $timestamp,
            'signature' => $signature,
            'Content-Type' => "application/json"
        ];
    }

    /**
     * 创建 http client 句柄
     * @return Client
     */
    private function client(): Client
    {
        return new Client([
            "base_uri" => $this->baseUrl,
            "headers" => $this->createHeaders(),
            "handler" => $this->handler
        ]);
    }

    public function get($url, $param = [])
    {
        return $this->client()->get($url, $param);
    }


    public function post($url, array $body)
    {
        return $this->client()->post($url, ['json' => $body]);
    }
}
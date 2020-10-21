<?php
namespace HanCloud\User;

use HanCloud\Request;

class User
{
    protected $config = [];


    public function __construct($configFile = "../Config.php")
    {
        $path = __DIR__ . "/". $configFile;
        if (file_exists($path)) {
            $this->config = require "$path";
        }
    }

    public function getUserConfig(): array
    {
        return $this->config;
    }

    public function register(array $user)
    {
        return (new Request())->post($this->config['register'], $user);

    }

    public function update(array $user)
    {
        return (new Request())->get($this->config['refresh'], $user);
    }

    public function delete(string $uid)
    {
        return (new Request())->post($this->config['delete'], ['user_id' => $uid]);
    }

    public function getInfo(string $uid)
    {
        return (new Request())->get($this->config['info'], ['user_id' => $uid]);
    }
}
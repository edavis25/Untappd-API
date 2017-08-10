<?php

use PHPUnit\Framework\TestCase;
include 'app/Untappd.php';

class APITest extends TestCase {

    protected $api;         // API instance used for tests
    protected $config;      // Config array containing 'email' + 'token'

    public function setUp() {
        $this->config = include('config.php');
        $this->api = new Untappd($this->config['email'], $this->config['token']);
    }

    public function testApiConstructor() {
        $this->assertEquals($this->api->email, $this->config['email']);
        $this->assertEquals($this->api->token, $this->config['token']);
    }

    //public function test

}
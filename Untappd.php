<?php

//namespace Untappd;

class Untappd {

    protected $token;
    protected $email;
    public $url = 'https://business.untappd.com/api/v1/';

    public function __construct($email, $token) {
        $this->email = $email;
        $this->token = $token;
    }

    public function getUser() {
        $url = $this->url . 'current_user';
        return $this->get($url);
    }

    public function getLocations() {
        $url = $this->url . 'locations';
        return $this->get($url);
    }

    protected function get($url) {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_CONNECTTIMEOUT => 10,
            // Basic auth = email : api token
            CURLOPT_USERPWD        => $this->email . ':' . $this->token
        );

        $handle = curl_init($url);
        curl_setopt_array($handle, $options);
        $data   = curl_exec($handle);
        $err    = curl_errno($handle);
        $errmsg = curl_error($handle) ;
        curl_close($handle);

        return json_decode($data, true);
    }
}
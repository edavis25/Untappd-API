<?php

require 'Untappd.php';

class UntappdLocation extends Untappd {

    protected $locationName;
    protected $locationId;

    // Note the location's name must match EXACTLY to the Untappd entry
    // You can call the "getLocations" method in the Untappd.php parent
    // class to get a full list of all locations associated w/ API token
    public function __construct($email, $token, $locationName) {
        parent::__construct($email, $token);

        $this->locationName = $locationName;
        $this->locationId  = $this->getLocationId();
    }

    public function getLocationByName() {
        $data = $this->getLocations();
        if (!$data) {
            require 'UntappdException.php';
            throw new UntappdException('No user locations found');
        }
        foreach ($data['locations'] as $location) {
            if ($location['name'] == $this->locationName) {
                return $location;
            }
        }
        // Location not found
        return null;
    }

    public function getLocationId() {
        $data = $this->getLocationByName();
        if ($data) {
            return $data['id'];    
        }
        else {
            require 'UntappdException.php';
            throw new UntappdException('Location: ' . $this->locationName . ' not found');
        }
    }

    public function getMenus() {
        $url = $this->url . 'locations/' . $this->locationId . '/menus';
        return $this->get($url);
    }
}
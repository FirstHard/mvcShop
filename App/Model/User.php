<?php

namespace App\Model;

use Framework\Model;

class User extends Model
{
    protected $id;
    protected $login;
    protected $email;
    protected $password;
    protected $phone_number;
    protected $auth_token;
    protected $first_name;
    protected $last_name;
    protected $middle_name;
    protected $registered_at;
    protected $blocked;
    protected $postcode;
    protected $country;
    protected $state;
    protected $city;
    protected $street;
    protected $house_number;
    protected $apartment_number;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function getAuthToken()
    {
        return $this->auth_token;
    }

    public function setAuthToken($auth_token)
    {
        $this->auth_token = $auth_token;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getMiddleName()
    {
        return $this->middle_name;
    }

    public function setMiddleName($middle_name)
    {
        $this->middle_name = $middle_name;
    }

    public function getRegisteredAt()
    {
        return $this->registered_at;
    }

    public function setRegisteredAt($registered_at)
    {
        $this->registered_at = $registered_at;
    }

    public function getBlocked()
    {
        return $this->blocked;
    }

    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }

    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function getHouseNumber()
    {
        return $this->house_number;
    }

    public function setHouseNumber($house_number)
    {
        $this->house_number = $house_number;
    }

    public function getApartmentNumber()
    {
        return $this->apartment_number;
    }

    public function setApartmentNumber($apartment_number)
    {
        $this->apartment_number = $apartment_number;
    }
}

<?php

namespace App\Model;

use Framework\Model;

class Order extends Model
{
    protected $id;
    protected $order_number;
    protected $user_id;
    protected $total;
    protected $shipping_method_id;
    protected $payment_method_id;
    protected $status;
    protected $created_at;
    protected $modified_at;
    protected $finished;
    protected $track_number;
    protected $client_first_name;
    protected $client_last_name;
    protected $client_middle_name;
    protected $client_phone_number;
    protected $client_email;
    protected $delivery_postcode;
    protected $delivery_country;
    protected $delivery_state;
    protected $delivery_city;
    protected $delivery_street;
    protected $delivery_house_number;
    protected $delivery_apartment_number;
    protected $products;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setOrderNumber($order_number)
    {
        $this->order_number = $order_number;
    }

    public function getOrderNumber()
    {
        return $this->order_number;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setShippingMethodId($shipping_method_id)
    {
        $this->shipping_method_id = $shipping_method_id;
    }

    public function getShippingMethodId()
    {
        return $this->shipping_method_id;
    }

    public function setPaymentMethodId($payment_method_id)
    {
        $this->payment_method_id = $payment_method_id;
    }

    public function getPaymentgMethodId()
    {
        return $this->payment_method_id;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setModifiedAt($modified_at)
    {
        $this->modified_at = $modified_at;
    }

    public function getModifiedAt()
    {
        return $this->modified_at;
    }

    public function setFinished($finished)
    {
        $this->finished = $finished;
    }

    public function getFinished()
    {
        return $this->finished;
    }

    public function setTrackNumber($track_number)
    {
        $this->track_number = $track_number;
    }

    public function getTrackNumber()
    {
        return $this->track_number;
    }

    public function setClientFirstName($client_first_name)
    {
        $this->client_first_name = $client_first_name;
    }

    public function getClientFirstName()
    {
        return $this->client_first_name;
    }

    public function setClientLastName($client_last_name)
    {
        $this->client_last_name = $client_last_name;
    }

    public function getClientLastName()
    {
        return $this->client_last_name;
    }

    public function setClientMiddleName($client_middle_name)
    {
        $this->client_middle_name = $client_middle_name;
    }

    public function getClientMiddleName()
    {
        return $this->client_middle_name;
    }

    public function setClientPhoneNumber($client_phone_number)
    {
        $this->client_phone_number = $client_phone_number;
    }

    public function getClientPhoneNumber()
    {
        return $this->client_phone_number;
    }

    public function setClientEmail($client_email)
    {
        $this->client_email = $client_email;
    }

    public function getClientEmail()
    {
        return $this->client_email;
    }

    public function setDeliveryPostcode($delivery_postcode)
    {
        $this->delivery_postcode = $delivery_postcode;
    }

    public function getDeliveryPostcode()
    {
        return $this->delivery_postcode;
    }

    public function setDeliveryCountry($delivery_country)
    {
        $this->delivery_country = $delivery_country;
    }

    public function getDeliveryCountry()
    {
        return $this->delivery_country;
    }

    public function setDeliveryState($delivery_state)
    {
        $this->delivery_state = $delivery_state;
    }

    public function getDeliveryState()
    {
        return $this->delivery_state;
    }

    public function setDeliveryCity($delivery_city)
    {
        $this->delivery_city = $delivery_city;
    }

    public function getDeliveryCity()
    {
        return $this->delivery_city;
    }

    public function setDeliveryStreet($delivery_street)
    {
        $this->delivery_street = $delivery_street;
    }

    public function getDeliveryStreet()
    {
        return $this->delivery_street;
    }

    public function setDeliveryHouseNumber($delivery_house_number)
    {
        $this->delivery_house_number = $delivery_house_number;
    }

    public function getDeliveryHouseNumber()
    {
        return $this->delivery_house_number;
    }

    public function setDeliveryApartmentNumber($delivery_apartment_number)
    {
        $this->delivery_apartment_number = $delivery_apartment_number;
    }

    public function getDeliveryApartmentNumber()
    {
        return $this->delivery_apartment_number;
    }

    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function getProducts()
    {
        return $this->products;
    }
}

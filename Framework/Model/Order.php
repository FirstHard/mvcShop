<?php

namespace Framework\Model;

use App\Model;

class Order extends Model
{
    public $id;
    public $order_number;
    public $user_id;
    public $total;
    public $shipping_method_id;
    public $payment_method_id;
    public $status;
    public $created_at;
    public $modified_at;
    public $finished;
    public $track_number;
    public $client_first_name;
    public $client_last_name;
    public $client_middle_name;
    public $client_phone_number;
    public $client_email;
    public $delivery_postcode;
    public $delivery_country_id;
    public $delivery_region_id;
    public $delivery_city_id;
    public $delivery_street;
    public $delivery_house_number;
    public $delivery_appartment_number;

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

    public function setCreatedAtDateTime($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAtDateTime()
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

    public function setOrderTotal($total)
    {
        $this->total = $total;
    }

    public function getOrderTotal()
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

    public function setModifiedAtDateTime($modified_at)
    {
        $this->modified_at = $modified_at;
    }

    public function getModifiedAtDateTime()
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
        return $this->client_larst_name;
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

    public function setDeliveryCountryId($delivery_country_id)
    {
        $this->delivery_country_id = $delivery_country_id;
    }

    public function getDeliveryCountryId()
    {
        return $this->delivery_country_id;
    }

    public function setDeliveryRegionId($delivery_region_id)
    {
        $this->delivery_region_id = $delivery_region_id;
    }

    public function getDeliveryRegionId()
    {
        return $this->delivery_region_id;
    }

    public function setDeliveryCityId($delivery_city_id)
    {
        $this->delivery_city_id = $delivery_city_id;
    }

    public function getDeliveryCityId()
    {
        return $this->delivery_city_id;
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

    public function setDeliveryAppartmentNumber($delivery_appartment_number)
    {
        $this->delivery_appartment_number = $delivery_appartment_number;
    }

    public function getDeliveryAppartmentNumber()
    {
        return $this->delivery_appartment_number;
    }
}

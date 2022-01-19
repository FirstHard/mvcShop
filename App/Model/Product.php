<?php

namespace App\Model;

use Framework\Model;

class Product extends Model
{
    protected $id;
    protected $name;
    protected $alias;
    protected $short_description;
    protected $full_description;
    protected $price;
    protected $new_price;
    protected $brand_id;
    protected $manufacturer_ean;
    protected $shop_articule;
    protected $availability = 1;
    protected $image_name;
    protected $date_added;
    protected $date_modify;
    protected $published = 1;
    protected $average_rating = 0;
    protected $label_id = 0;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    public function getShortDescription()
    {
        return $this->short_description;
    }

    public function setShortDescription($short_description)
    {
        $this->short_description = $short_description;
    }

    public function getFullDescription()
    {
        return $this->full_description;
    }

    public function setFullDescription($full_description)
    {
        $this->full_description = $full_description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getNewPrice()
    {
        return $this->new_price;
    }

    public function setNewPrice($new_price)
    {
        $this->new_price = $new_price;
    }

    public function getBrandId()
    {
        return $this->brand_id;
    }

    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function getManufacturerEan()
    {
        return $this->manufacturer_ean;
    }

    public function setManufacturerEan($manufacturer_ean)
    {
        $this->manufacturer_ean = $manufacturer_ean;
    }

    public function getShopArticule()
    {
        return $this->shop_articule;
    }

    public function setShopArticule($shop_articule)
    {
        $this->shop_articule = $shop_articule;
    }

    public function getAvailability()
    {
        return $this->availability;
    }

    public function setAvailability($availability)
    {
        $this->availability = $availability;
    }

    public function getImageName()
    {
        return $this->image_name;
    }

    public function setImageName($image_name)
    {
        $this->image_name = $image_name;
    }

    public function getDateAdded()
    {
        return $this->date_added;
    }

    public function setDateAdded($date_added)
    {
        $this->date_added = $date_added;
    }

    public function getDateModify()
    {
        return $this->date_modify;
    }

    public function setDateModify($date_modify)
    {
        $this->date_modify = $date_modify;
    }

    public function getPublished()
    {
        return $this->published;
    }

    public function setPublished($published)
    {
        $this->published = $published;
    }

    public function getAverageRating()
    {
        return $this->average_rating;
    }

    public function setAverageRating($average_rating)
    {
        $this->average_rating = $average_rating;
    }

    public function getLabelId()
    {
        return $this->label_id;
    }

    public function setLabelId($label_id)
    {
        $this->label_id = $label_id;
    }
}

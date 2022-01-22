<?php

namespace App\Model;

use Framework\Model;

class ShopCategory extends Model
{
    protected $id;
    protected $name;
    protected $alias;
    protected $parent_id;
    protected $short_description;
    protected $full_description;
    protected $image_name;

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

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
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

    public function getImageName()
    {
        return $this->image_name;
    }

    public function setImageName($image_name)
    {
        $this->image_name = $image_name;
    }
}

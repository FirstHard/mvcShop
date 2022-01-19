<?php

namespace App\Model;

use Framework\DataMapper;

class StateMapper extends DataMapper
{
    protected $elements;
    protected const TABLE_NAME = 'state';

    public function fetchCollection($objects)
    {
        foreach ($objects as $object) {
            $state = new State();
            $state->setId($object['id']);
            $state->setName($object['name']);
            $this->elements[] = $state;
        }
        return $this->elements;
    }

    public function getNameById(int $id): string
    {
        $query = "SELECT `name` FROM " . self::TABLE_NAME . " WHERE id = :id";
        return $this->db->run($query, ['id' => $id])[0]['name'];
    }

    public function getStates()
    {
        return $this->fetchCollection($this->getAll(self::TABLE_NAME, 'id', 'ASC', 0, false));
    }
}
<?php

namespace App\Acme\Transformers;

abstract class transformer
{
	/*
	this class is to ensure that the data keys sent by the api
	is constant even if the columns in the database has changed
	and also to prevent casting all datatypes to string
	while converting data to json
	*/
	public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    abstract public function transform($item);
}

?>
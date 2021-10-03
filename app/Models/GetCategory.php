<?php

namespace Jelena\Models;

class GetCategory extends DB
{
    public array $data=[];
    protected function tableName()
    {
        return "category";
    }
}
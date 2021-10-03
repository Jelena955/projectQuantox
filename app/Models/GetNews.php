<?php

namespace Jelena\Models;
use Jelena\Models\DB;

class GetNews extends BaseModel
{

    public string $search='';
    public array $data=[];
    protected function tableName()
    {
        return "news";
    }

    public function rules():array
    {
        return [
            'search'=> [self::RULE_REQUIRED,self::RULE_MAX],

        ];
    }

}
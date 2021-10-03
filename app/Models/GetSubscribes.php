<?php

namespace Jelena\Models;

class GetSubscribes extends BaseModel
{
   public string $submail='';
   public array $data=[];
    protected function tableName()
    {
        return "subscribers";
    }

    public function rules():array
    {
        return [
            'submail'=> [self::RULE_REQUIRED, self::RULE_MAIL],

        ];
    }



}
<?php
declare(strict_types=1);
namespace Jelena\Models;


class UserBaseModel extends BaseModel
{
    //public string $table = 'users';
    public string $mail='';
    public string $password='';
    public array $data=[];


    public function tableName(){
        return 'users';
    }
    public function rules():array
    {
       return [
           'mail'=> [self::RULE_REQUIRED, self::RULE_MAIL],
           'password'=>[self::RULE_REQUIRED, self::RULE_PASS],
       ];
    }


}
<?php

namespace Jelena\Models;

use Jelena\Controllers\Validation;

abstract class BaseModel extends DB
{
    public array $errors=[];

    public const RULE_MAIL='mail';
    public const RULE_PASS='password';
    public const RULE_REQUIRED='required';
    public const RULE_MAX='max';


    public function loadData(){
        foreach ($this->data as $property => $request){

           // var_dump($request[$property]);
            if (isset($request[$property])){

                return  $request[$property];
          }
            else{
                var_dump($request[$property]);
            }
        }
    }



    abstract public function rules():array;

      public function validate(): bool
      {

         foreach ($this->rules() as $attribute=>$rules){

             $value=$this->{$attribute};

             foreach ($rules as $rule){

                 $ruleName=$rule;

                 if($ruleName==self::RULE_REQUIRED && !$value){

                     $this->addError($attribute, self::RULE_REQUIRED);
                 }

                 if($ruleName==self::RULE_MAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){



                     $this->addError($attribute, self::RULE_MAIL);
                 }

                 if($ruleName==self::RULE_MAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){



                     $this->addError($attribute, self::RULE_MAIL);
                 }

                 if($ruleName==self::RULE_PASS && !preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $value)){



                     $this->addError($attribute, self::RULE_PASS);
                 }
                 if($ruleName==self::RULE_MAX && strlen($value)>20){



                     $this->addError($attribute, self::RULE_MAX);
                 }

             }
         }
              return empty($this->errors);


      }

  public function addError(string $attribute, string $rule){

      $message=$this->errorMessages()[$rule] ?? '';
          $this->errors[$attribute][] =$message;

  }

  public function errorMessages(){

      return [
          self::RULE_REQUIRED=>'This field can\'t be empty',
          self::RULE_MAIL =>'This field must bbe valid email address',
          self::RULE_PASS=>'"Password is not in good format (must include at list one letter, number and simbol)"',
          self::RULE_MAX=>'This field can\'t be biger than 20 simbols.'


      ];
  }




}
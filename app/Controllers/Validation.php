<?php
declare(strict_types=1);
namespace Jelena\Controllers;

//krenula sam da prebacujem validaciju u kontroler, ali nisam stigla da zavrsim
use Exception;

trait Validation
{
    public array $rules = [];
    public array $messages = [];

    private array $defaultMessages = [
        'max' => ""
    ];
    public array $errors = [];

    private bool $success = true;

    /**
     * @throws \Exception
     */
    public function validateMax($request) : void
    {
       // var_dump($this->rules);
        foreach ($this->rules as $property => $rule){
            if (str_contains($rule, 'max')){
                if (isset($request[$property])){
                    $value = $request[$property];
                    var_dump($property);
                    $rules = explode("|", $rule);
                    $rule = $this->getRule($rules, 'max');
                    if ($rule){
                        $explodedRule = explode(':', $rule);
                        if (isset($explodedRule[1])){
                            $maxValue = $explodedRule[1];
                            if ($value > $maxValue){
                                if (isset($this->messages[$property.'.max'])){
                                    $this->errors[$property.'.max'] = $this->messages[$property.'.max'];
                                }else{
                                    $this->errors[$property.'.max'] = $this->defaultMessages['max'];
                                }
                            }
                        }else{
                            throw new Exception("Max rule doesn't has value!");
                        }
                    }
                }
            }
        }
    }

    private function getRule(array $rules, string $rule) : ?string{
        foreach ($rules as $value){
            if (str_contains($value, $rule)){
                return $value;
            }
        }
        return null;
    }

    public function validationHasErrors() : bool
    {
        return count($this->errors) > 0;
    }
}
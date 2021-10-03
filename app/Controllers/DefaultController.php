<?php

namespace Jelena\Controllers;

use Database\DB;
use http\Env\Request;

class DefaultController
{
    use Validation;

    /**
     * @throws \Exception
     * @return void
     */
    public function home(): void
	{
        $test = 'test';
		// implement
        view('news');
      //  view('home')->with('test', $test);
	}

    public function loadDataget()
    {
        foreach ($this->data as $property=>$value)
        {
            if (isset($_GET[$value]))
            {


                $this->{$property}=$_GET[$value];




                return $this->{$property}=$_GET[$value];
        }
    }
    }

    public function loadDatapost(){
        foreach ($this->data as $property=>$value){
           // $value=$_POST[$property];
            //var_dump($property);
           // var_dump($value);
            if (isset($_POST[$value])){


                $this->{$property}=$_POST[$value];




            return $this->{$property}=$_POST[$value];

            }

        }
    }

    public function notFound(): string
    {
        return 'Page not found';
    }

    public function session( $data){
        if(isset($_SESSION[$data])){
           return true;
        }

        else{
           $this->notFound();
        }
    }

    public function unsetsession($data)
    {
       unset($_SESSION[$data]);
    }






	public function contact(): string
	{
        return 'DefaultController -> contact';
	}

	public function companies($id = null): string
	{
        return 'DefaultController -> companies -> id: ' . $id;
	}





}
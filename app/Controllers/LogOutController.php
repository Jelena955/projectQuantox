<?php

namespace Jelena\Controllers;
session_start();

class LogOutController extends DefaultController
{

public function unsetMail(){

    $this->unsetsession('mail');
    view('login');

}





}
<?php


namespace Jelena\Controllers;
session_start();
use Jelena\Models\UserBaseModel;
class LoginController extends DefaultController
{

    use News;

    public array $data=[];

    public function forma(){
        view("login");
    }


    public function login()
    {
        //nije zavrseno
        /*  $this->rules = [
              'username' => 'max:5'
          ];
          $this->messages = [
              'username.max' => 'Korisnicko ime moze imati maksumum 5 karaktera'
          ];

          $this->validateMax($_POST);

          if ($this->validationHasErrors()){
              dd($this->errors);
          }*/

        $this->data = ['mail','password'];
          if($this->loadDatapost()){


            $loginModel = new UserBaseModel();
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $loginModel->password = $password;
            $loginModel->mail = $mail;
            $validation = $loginModel->validate();
            $errors = $loginModel->errors;

            if ($validation) {
                $log = $loginModel->get('password= "' . $password . '"AND umail="' . $mail . '"');
                if ($log != NULL) {
                    foreach ($log as $row) {
                        $_SESSION['mail'] = $row->umail;

                    }


                     $news= $this->writeNews();
                    $cats=$this->writeNewsCat();
                    if($this->session('mail')) {


                   view('admin', compact('news', 'cats') );

                } else {
                    view("notfound");
                }
            } else {
                foreach ($errors as $error => $er)
                {
                    foreach ($er as $err)
                    {
                        echo $err;
                    }
                }
            }
        }
        else{
            view('notfound');
        }
    }

}}
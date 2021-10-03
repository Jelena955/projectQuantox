<?php

namespace Jelena\Controllers;
use Jelena\Models\GetSubscribes;
class SubscribesController extends DefaultController
{
    protected string $id;

    //private string $submail;

  public  function insertSubscribes()
  {
 //var_dump($_POST['cat']);

      if(isset($_POST['new']) || isset( $_POST['cat']))
      {
          $model = new GetSubscribes();
          $model->submail = $_POST['submail'];
          $validation = $model->validate();
          $errors = $model->errors;
          if ($validation) {
              if (isset($_POST['cat']))
              {
                  $this->id = $_POST['cat'];


                  $model->insert(array("idcategory" => $this->id, "idnews" => "NULL", "mail" => $model->submail));
              } else if (isset($_POST['new']))
              {
                  $this->id = $_POST['new'];
                  $model->insert(array("idcategory" => "NULL", "idnews" => $this->id, "mail" => $model->submail));

              }


          }
          else
          {
              foreach ($errors as $error => $er)
              {
                  foreach ($er as $err)
                  {

                      // view('login', compact('err'));
                      echo $err;
                  }
              }
          }
      }
      else{
          view('notfound');
      }




      //$id=NULL;




  }

}
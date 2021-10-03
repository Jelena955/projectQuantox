<?php

namespace Jelena\Controllers;
use Jelena\Models\GetNews;
class SearchController extends DefaultController
{
    public array $data=[];
    public function search()
    {

        $model = new GetNews();
        $this->data= array('search');
        if($this->loadDataget())
        {
            $search=$this->loadDataget();
            $model->search=$search;
            $validation = $model->validate();
            $errors = $model->errors;
            if ($validation)
            {

                $news = $model->get("titlee LIKE LOWER('%$search%')");
                return json_encode($news);

            } else {
                foreach ($errors as $error => $er) {
                    foreach ($er as $err) {
                        // view('login', compact('err'));
                        echo $err;
                    }
                }
            }
        }
    }
}
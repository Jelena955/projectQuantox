<?php

namespace Jelena\Controllers;

use http\Env\Request;
use Jelena\Models\GetCategory;
use Jelena\Models\GetNews;




class CategoryController extends DefaultController
{
    public $id;
    public array $data = [];

    public function store()
    {
        $this->data = ["id"];
        if ($this->loadDataget()){
            //if(isset($_GET['id'])) {
            $id = $_GET['id'];


        //var_dump($id);
        $model = new GetNews();


        if ($id == 'all') {

            $newscategory = $model->get();

        } else {
            $newscategory = $model->get('idcategory=' . $id, 'created_at');
        }

        return json_encode($newscategory);
    }


}





}




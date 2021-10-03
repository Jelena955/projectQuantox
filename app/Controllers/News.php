<?php

namespace Jelena\Controllers;

use Jelena\Models\GetCategory;
use Jelena\Models\GetNews;

trait News
{
    public function writeNews(){
        $model=new GetNews();
        $news=$model->get(null, 'created_at');


    return $news;


    }

    public function writeNewsCat(){

        $modelcategory=new GetCategory();
        $categorys=$modelcategory->get();
        return $categorys;

    }


    public function writeNew()
    {
        $idnew=$_GET['new'];
        $model=new GetNews();
        $new=$model->get('idnews='.$idnew);
        return $new;


    }



}
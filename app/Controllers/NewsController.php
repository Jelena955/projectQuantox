<?php

namespace Jelena\Controllers;
use Jelena\Models\GetNews;
use Jelena\Models\GetCategory;
use Jelena\Models\GetSubscribes;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class NewsController extends DefaultController {

    use News;
    use Mail;

    public function writeNewss()
    {

       $news= $this->writeNews();
       $categorys=$this->writeNewsCat();
        view('news',compact('news',  'categorys'));

    }


    public function writeNeww()
    {

        $new=$this->writeNew();
        view('new', compact('new'));


    }

    /**
     * @throws Exception
     */
    public function insertNews()
    {
        $title = $_GET['title'];
        $description = $_GET['description'];
        $cat = $_GET['cat'];
       // var_dump($cat);
        $model = new GetNews();
        $r = $model->insert(array("titlee" => $title, "description" => $description, "idcategory" => $cat));
        //var_dump($r);
        $sub = new GetSubscribes();
        $result = $sub->get('idcategory=' . $cat);
        $category = new GetCategory();
        $res = $category->get('idcategory=' . $cat);
        foreach ($res as $c) {
            $getcat = $c->name;
            $this->sendMail($result, $getcat);
        }
    }

        public function updateNews()
    {
        $title=$_GET['title'];
        $description=$_GET['description'];
        $cat=$_GET['cat'];
        $news=$_GET['newsid'];
       // var_dump($cat);
        $model=new GetNews();
        try{


        $model->update(array("titlee"=>$title, "description"=>$description, "idcategory"=>$cat), 'idnews='.$news);
       // var_dump($r);
        $sub=new GetSubscribes();
        $result=$sub->get('idnews='.$news);
        if($result!=NULL){
            $catnews=new GetNews();
            $res=$catnews->get('idnews='.$news);
            foreach ($res as $c)
            {
                $getcat=$c->titlee;
                //var_dump($getcat);
                $this->sendMail($result, $getcat);




            }
            echo 'Success';

        }}
        catch(\Exception $ex){

            echo $ex;

            }
       }





        //var_dump($result);
       /* $mail=new PHPMailer();
        try{


        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jelena.naumovski95@gmail.com';
        $mail->Password   = 'xxxxx';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        foreach ($result as $value)
        {
            $mail->setFrom('jelena.naumovski@gmail.com');
            $mail->addAddress($value->mail);
            $mail->isHTML(true);
            $mail->Subject = 'New news';
            $mail->Body    = 'There is new news in '.$getcat.' category';
            $mail->send();


        }
        }

        catch (Exception $e)
        {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";


        }*/











}
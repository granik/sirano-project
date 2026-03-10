<?php

namespace App\Modules\Platform\Presentation\AdminHttp\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index()
    {
        return $this->render('backend/default.html.twig');
    }
}
<?php

namespace Flowcode\FinancialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FlowcodeFinancialBundle:Default:index.html.twig');
    }
}

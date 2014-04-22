<?php

namespace Notemonprof\UserBundle\Controller;

use Proxies\__CG__\Notemonprof\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {

        return $this->render('NotemonprofUserBundle:Default:index.html.twig', array('name' => $name));
    }
}

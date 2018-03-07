<?php

namespace JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
        ->getRepository('JobeetBundle:Job');
        //$totaljobs = $em->getRepository('JobeetBundle:Job')->findAll();
        //echo count($jobs);

        $query = $repository->createQueryBuilder('p')
        ->orderBy('p.id', 'DESC')
        ->getQuery();

        $jobs = $query->setMaxResults(2)->getResult();

        $categories = $em->getRepository('JobeetBundle:Category')->findAll();
        //return $this->render('index.html.twig', array(
        return $this->render('index/index.html.twig', array(
            'jobs' => $jobs,'categories' => $categories
        ));
    }
}

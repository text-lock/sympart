<?php
// src/ArticleBundle/Controller/MainController.php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $articles = $em->createQueryBuilder()
                    ->select('b')
                    ->from('ArticleBundle:Article',  'b')
                    ->addOrderBy('b.createdAt', 'DESC')
                    ->getQuery()
                    ->getResult();

        return $this->render('ArticleBundle:Main:index.html.twig', array(
            'articles' => $articles
        ));
    }
}
<?php
// src/ArticleBundle/Controller/AuthorController.php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Author controller.
 */
class AuthorController extends Controller
{
    /**
     * Show author and assigned articles
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $author = $em->getRepository('ArticleBundle:Author')->find($id);

        if (!$author) {
            throw $this->createNotFoundException('Unable to find author.');
        }
        return $this->render('ArticleBundle:Author:show.html.twig', array(
            'author'      => $author,
        ));
    }

    /**
     * Show author list
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $authors = $em->createQueryBuilder()
                    ->select('b')
                    ->from('ArticleBundle:Author',  'b')
                    ->addOrderBy('b.name', 'ASC')
                    ->getQuery()
                    ->getResult();

        return $this->render('ArticleBundle:Author:index.html.twig', array(
            'authors' => $authors
        ));
    }
}

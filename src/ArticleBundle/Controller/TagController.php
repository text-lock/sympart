<?php
// src/ArticleBundle/Controller/TagController.php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Article controller.
 */
class TagController extends Controller
{
    /**
     * Show tag and assigned articles
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $tag = $em->getRepository('ArticleBundle:Tag')->find($id);

        if (!$tag) {
            throw $this->createNotFoundException('Unable to find tag.');
        }
        return $this->render('ArticleBundle:Tag:show.html.twig', array(
            'tag'      => $tag,
        ));
    }

    /**
     * Show author list
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $tags = $em->createQueryBuilder()
                    ->select('b')
                    ->from('ArticleBundle:Tag',  'b')
                    ->addOrderBy('b.title', 'ASC')
                    ->getQuery()
                    ->getResult();

        return $this->render('ArticleBundle:Tag:index.html.twig', array(
            'tags' => $tags
        ));
    }
}

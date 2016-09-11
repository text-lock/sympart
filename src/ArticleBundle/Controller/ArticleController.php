<?php
// src/ArticleBundle/Controller/ArticleController.php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Article controller.
 */
class ArticleController extends Controller
{
/**
     * Show a article entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('ArticleBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException('Unable to find article.');
        }
        return $this->render('ArticleBundle:Article:show.html.twig', array(
            'article'      => $article,
        ));
    }
}

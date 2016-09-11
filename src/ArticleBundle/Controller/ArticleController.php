<?php
// src/ArticleBundle/Controller/ArticleController.php

namespace ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ArticleBundle\Entity\Article;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * Show a article entry
     * @Route("/{id}", name="article_show")
     * @Method("GET")
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

    /**
     * Deletes an article entity.
     *
     * @Route("/{id}/delete", name="article_delete")
     * @Method("GET")
     */
    public function deleteAction(Article $article)
    {
         
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
        
        return $this->redirectToRoute('Article_homepage');
    }

}

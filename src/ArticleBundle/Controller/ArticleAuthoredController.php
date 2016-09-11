<?php

namespace ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ArticleBundle\Entity\ArticleAuthored;
use ArticleBundle\Form\ArticleAuthoredType;

/**
 * ArticleAuthored controller.
 *
 * @Route("/article")
 */
class ArticleAuthoredController extends Controller
{
    
    /**
     * Creates a new ArticleAuthored entity.
     *
     * @Route("/authored_new", name="authored_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $articleAuthored = new ArticleAuthored();
        $form = $this->createForm('ArticleBundle\Form\ArticleAuthoredType', $articleAuthored);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articleAuthored);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $articleAuthored->getId()));
        }

        return $this->render('ArticleBundle:ArticleAuthored:new.html.twig', array(
            'articleAuthored' => $articleAuthored,
            'form' => $form->createView(),
        ));
    }

    
    /**
     * Displays a form to edit an existing ArticleAuthored entity.
     *
     * @Route("/{id}/authored_edit", name="authored_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ArticleAuthored $articleAuthored)
    {
        
        $editForm = $this->createForm('ArticleBundle\Form\ArticleAuthoredType', $articleAuthored);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articleAuthored);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $articleAuthored->getId()));
        }

        return $this->render('ArticleBundle:ArticleAuthored:edit.html.twig', array(
            'articleAuthored' => $articleAuthored,
            'edit_form' => $editForm->createView(),
        ));
    }

   
}

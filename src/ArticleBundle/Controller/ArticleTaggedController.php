<?php

namespace ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ArticleBundle\Entity\ArticleTagged;
use ArticleBundle\Form\ArticleTaggedType;

/**
 * ArticleTagged controller.
 *
 * @Route("/tagged/")
 */
class ArticleTaggedController extends Controller
{
    
    /**
     * Creates a new ArticleTagged entity.
     *
     * @Route("/new_tagged", name="tagged_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $articleTagged = new ArticleTagged();
        $form = $this->createForm('ArticleBundle\Form\ArticleTaggedType', $articleTagged);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articleTagged);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $articleTagged->getId()));
        }

        return $this->render('ArticleBundle:ArticleTagged:new.html.twig', array(
            'articleTagged' => $articleTagged,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ArticleTagged entity.
     *
     * @Route("/{id}/edit", name="tagged_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ArticleTagged $articleTagged)
    {
        $editForm = $this->createForm('ArticleBundle\Form\ArticleTaggedType', $articleTagged);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articleTagged);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $articleTagged->getId()));
        }

        return $this->render('ArticleBundle:ArticleTagged:edit.html.twig', array(
            'articleTagged' => $articleTagged,
            'edit_form' => $editForm->createView(),
        ));
    }

}

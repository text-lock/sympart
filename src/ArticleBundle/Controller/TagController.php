<?php
// src/ArticleBundle/Controller/TagController.php

namespace ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ArticleBundle\Entity\Tag;


/**
 * Tag controller.
 *
 * @Route("/tag")
 */
class TagController extends Controller
{

     /**
     * Creates a new tag entity.
     *
     * @Route("/new", name="tag_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tag= new Tag();
        $form = $this->createForm('ArticleBundle\Form\TagType', $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('tag_index', array('id' => $tag->getId()));
        }

        return $this->render('ArticleBundle:Tag:new.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
        ));
    }



    /**
     * Show tag and assigned articles
     * @Route("/{id}", name="tag_show")
     * @Method("GET")
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
     * Show tag list
     * @Route("/", name="tag_index")
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

   
    
    /**
     * Displays a form to edit an existing tag entity.
     *
     * @Route("/{id}/edit", name="tag_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tag $tag)
    {
        
        $editForm = $this->createForm('ArticleBundle\Form\TagType', $tag);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('tag_index', array('id' => $tag->getId()));
        }

        return $this->render('ArticleBundle:Tag:edit.html.twig', array(
            'tag' => $tag,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a tag entity.
     *
     * @Route("/{id}/delete", name="tag_delete")
     * @Method("GET")
     */
    public function deleteAction(Tag $tag)
    {
         
        $em = $this->getDoctrine()->getManager();
        $em->remove($tag);
        $em->flush();
        
        return $this->redirectToRoute('tag_index');
    }
}

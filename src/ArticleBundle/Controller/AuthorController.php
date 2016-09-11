<?php
// src/ArticleBundle/Controller/AuthorController.php

namespace ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ArticleBundle\Entity\Author;


/**
 * Author controller.
 * @Route("/author")
 */
class AuthorController extends Controller
{

     /**
     * Creates a new author entity.
     *
     * @Route("/new", name="author_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $author= new Author();
        $form = $this->createForm('ArticleBundle\Form\AuthorType', $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            return $this->redirectToRoute('author_index', array('id' => $author->getId()));
        }

        return $this->render('ArticleBundle:Author:new.html.twig', array(
            'author' => $author,
            'form' => $form->createView(),
        ));
    }



    /**
     * Show author and assigned articles
     * @Route("/{id}", name="author_show")
     * @Method("GET")
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
     * @Route("/", name="author_index")
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

    /**
     * Displays a form to edit an existing author entity.
     *
     * @Route("/{id}/edit", name="author_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Author $author)
    {
        
        $editForm = $this->createForm('ArticleBundle\Form\AuthorType', $author);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            return $this->redirectToRoute('author_index', array('id' => $author->getId()));
        }

        return $this->render('ArticleBundle:Author:edit.html.twig', array(
            'author' => $author,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes an author entity.
     *
     * @Route("/{id}/delete", name="author_delete")
     * @Method("GET")
     */
    public function deleteAction(Author $author)
    {
         
        $em = $this->getDoctrine()->getManager();
        $em->remove($author);
        $em->flush();
        
        return $this->redirectToRoute('author_index');
    }
}

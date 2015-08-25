<?php

namespace SanMax\NewsBundle\Controller;

use SanMax\NewsBundle\Entity\Article;
use SanMax\NewsBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package SanMax\NewsBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $article = new Article();

        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);

        if($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Artikel toegevoegd.');
            return $this->redirect($this->generateUrl('san_max_news_homepage'));

        }

        return $this->render('SanMaxNewsBundle:Default:index.html.twig', [
                'form' => $form->createView(),
                'article' => $article
            ]
        );
    }
}

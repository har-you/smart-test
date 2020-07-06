<?php


namespace App\Controller;


use App\Dto\Search;
use App\Entity\Celebrity;
use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CelebrityController extends AbstractController
{

    /**
     * @Route("/index", name="index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $search = new Search();
        $em = $this->getDoctrine()->getManager();
        $nationalities = $em->getRepository(Celebrity::class)->getNationalities();
        $professions = $em->getRepository(Celebrity::class)->getProfessions();
        $form = $this->createForm(SearchType::class, $search,  ['professions' => $professions, 'nationalities' => $nationalities]);
        return $this->render('celebrity/index.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/search", name="celebrity_search", methods={"POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request)
    {
        $search = new Search();
        $em = $this->getDoctrine()->getManager();
        $nationalities = $em->getRepository(Celebrity::class)->getNationalities();
        $professions = $em->getRepository(Celebrity::class)->getProfessions();
        $form = $this->createForm(SearchType::class, $search,  ['professions' => $professions, 'nationalities' => $nationalities]);
        $celebrities = [];
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $celebrities = $em->getRepository(Celebrity::class)->search($search);
        }

        return $this->render('celebrity/index.html.twig',
            [
                'celebrities' => $celebrities,
                'form' => $form->createView()
            ]);
    }
}
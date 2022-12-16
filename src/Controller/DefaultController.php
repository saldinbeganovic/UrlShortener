<?php

namespace App\Controller;


use App\Entity\Statistic;
use App\Entity\Url;
use App\Repository\UrlRepository;
use App\Service\UrlStatisticsService;
use App\Form\UrlType;
use App\Service\UrlGeneratorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(Request $request, EntityManagerInterface $em, UrlGeneratorService $urlGenerator,
    UrlRepository $urlRepository,
   UrlStatisticsService $urlStatisticsService)
    {
        $urlAll = $urlRepository->findAll();
        $length = count($urlAll);
        $urlData=[];
        for($i=0;$i<$length;$i++){
            $click = $urlStatisticsService->getClicksForUrl($urlAll[$i]);

            array_push($urlData, array('urlData' => $urlAll[$i],'clicks'=>$click));
        }
        
       



        $url = new Url();
        $form = $this->createForm(UrlType::class, $url);

        $form->handleRequest($request);

        $errors = $form->getErrors(true);

        if ($form->isSubmitted() && $form->isValid()) {
            $originalUrl = $form->get('originalUrl')->getData();
            $shortenedUrl = $urlGenerator->getRandomUrl();
            $statistic = new Statistic();
            $url->addUrl($originalUrl, $shortenedUrl, null, $this->getUser(), $statistic);
            $em->persist($url);
            $em->flush();

            return $this->redirectToRoute('public_url_statistics', array(
                'url' => $url->getShortenedUrl(),
            ));

        }

        
      
           
        

  
            
      


        return $this->render('index.html.twig', [
            'urlData' => $urlData,

            'form' => $form->createView(),
            'errors' => $errors,
            
        ]);
    }



}
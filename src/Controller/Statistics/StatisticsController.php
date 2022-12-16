<?php


namespace App\Controller\Statistics;



use App\Repository\UrlRepository;
use App\Service\StatisticsAccessService;
use App\Service\UrlStatisticsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends AbstractController
{
    /**
     * @Route("/s/{url}", methods={"GET"}, name="public_url_statistics")
     */
    public function publicStatistics(
        $url,
        UrlRepository $urlRepository,
        StatisticsAccessService $statisticsAccess,
        UrlStatisticsService $urlStatisticsService
    ) {
        $private = false;

        $link = $urlRepository->findOneBy([
            'shortenedUrl' => $url,
        ]);

        if ($statisticsAccess->userIsAuthorOfSingleUrl($link) || $link->getUserId() === NULL) {

            $clicks = $urlStatisticsService->getClicksForUrl($link);
           
        } else {
            $private = true;
            return $this->render('statistic/public.html.twig', [
                'private' => $private,
            ]);
        }

        return $this->render('statistic/public.html.twig', [
            'url' => $url,
            'clicks' => $clicks,
            
            'private' => $private,
        ]);
    }

    
}
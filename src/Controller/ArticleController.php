<?php


namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function homepage(ArticleRepository $repository)
    {
        $articles = $repository->findAllPublishedOrderedByNewest();
        return $this->render('article/homepage.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/news/{slug}", name="news")
     */
    public function show(Article $article, SlackClient $slack)
    {
        if($article->getSlug() === 'yo') {
            $slack->sendMessage('Jéjé', 'Bonjour la famille');
        }


        $comments = ["C'est incroyable", "Super article", "Nul"];

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'comments' => $comments]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $article->incrementHeartCount();
        $em->flush($article);

        $logger->info('Article is being hearted !');
        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }
}
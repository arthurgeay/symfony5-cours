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
    public function show($slug, SlackClient $slack, EntityManagerInterface $em)
    {
        if($slug === 'yo') {
            $slack->sendMessage('Jéjé', 'Bonjour la famille');
        }

        $repository = $em->getRepository(Article::class);
        /** @var Article $article */
        $article = $repository->findOneBy(['slug' => $slug]);

        if(!$article) {
            throw $this->createNotFoundException(sprintf('Pas d\'article trouvé pour le slug "%s"', $slug));
        }


        $comments = ["C'est incroyable", "Super article", "Nul"];

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'comments' => $comments]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        // TODO - actually heart/unheart the article
        $logger->info('Article is being hearted !');
        return new JsonResponse(['hearts' => rand(5, 100)]);
    }
}
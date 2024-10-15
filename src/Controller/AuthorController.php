<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AuthorController.php',
        ]);
    }
    #[Route('/show_author/{name}',name:'app_author_name' )]
    public function showAuthor_name(string $name):Response
    {
        return $this->render('Author/show_author_name.html.twig',[
            'name'=> $name,
        ]);
    }
    
    #[Route('/authors',name:'app_listAuthors')]
    public function listAuthors()
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/victor.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
            );
            $totalBooks = array_sum(array_column($authors, 'nb_books'));
            return  $this->render('Author/list.html.twig',['authors'=>$authors,
            'totalBooks'=>$totalBooks,
                
            ]);
    }

    #[Route('/authors/details/{id}',name:'author_details')]
    public function authorDetails(int $id)
    {
    $authors = array(
            array('id' => 1, 'picture' => '/images/victor.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
            );
            $author = null;
            foreach ($authors as $a) {
                if ($a['id'] === $id) {
                    $author = $a;
                    break;
                }
            }
            
            if ($author === null) {
                throw $this->createNotFoundException("auteur non trouvé!");
            }
        
        return $this->render('/author/show_author.html.twig',[
'author'=>$author,
        ]);
        
    }
}

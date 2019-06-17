<?php
// src/controller/HomePageController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('homepage/index.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function about() {
        return $this->render('about/about.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact() {
        return $this->render('contact/contact.html.twig');
    }

    /**
     * @Route("/search", name="search")
     */
    public function search() {
        return $this->render('search/search.html.twig');
    }

    /**
     * @Route("/sidebar", name="sidebar")
     */
    public function sidebar() {
        return $this->render('sidebar/sidebar.html.twig');
    }

}

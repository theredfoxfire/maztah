<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="question_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request, QuestionRepository $questionRepository): Response
    {
        $questionQuery = $questionRepository->queryByKeyword();
        $paginators = $paginator->paginate(
            $questionQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            20
        );
        return $this->render('question/index.html.twig', [
            'paginators' => $paginators,
            'questions' => $questionRepository->findByKeyword(),
            'keyword' => '',
        ]);
    }

    /**
     * @Route("/search", name="question_search", methods={"GET"})
     */
    public function search(PaginatorInterface $paginator, Request $request, QuestionRepository $questionRepository): Response
    {
        $token = $request->query->get("token");
        $keyword = $request->query->get('keyword');
        $questionQuery = $questionRepository->queryByKeyword($keyword);
        $paginators = $paginator->paginate(
            $questionQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            20
        );

        if ($request->query && !$this->isCsrfTokenValid('myform', $token))
        {
            return new Response('Operation not allowed', Response::HTTP_BAD_REQUEST,
                ['content-type' => 'text/plain']);
        }

        return $this->render('question/index.html.twig', [
            'paginators' => $paginators,
            'questions' => $questionRepository->findByKeyword($keyword),
            'keyword' => $keyword,
        ]);
    }

    /**
     * @Route("/question/new", name="question_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('question_index');
        }

        return $this->render('question/new.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/question/{id}", name="question_show", methods={"GET"})
     */
    public function show(Question $question): Response
    {
        return $this->render('question/show.html.twig', [
            'question' => $question,
        ]);
    }

    /**
     * @Route("/question/{id}/edit", name="question_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Question $question): Response
    {
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('question_index');
        }

        return $this->render('question/edit.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/question/{id}", name="question_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Question $question): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($question);
            $entityManager->flush();
        }

        return $this->redirectToRoute('question_index');
    }
}

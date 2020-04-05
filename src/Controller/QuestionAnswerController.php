<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\QuestionHistoric;
use App\Form\QuestionType;
use App\Service\Export\CsvExporter;
use App\Service\Export\Exporter;
use App\Service\FaqBot;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class QuestionAnswerController
 */
class QuestionAnswerController extends AbstractController
{
    /**
     * Save or update Faq or Bot
     *
     * @Route("/create", name="create_faq_bot", methods={"POST"})
     * @Route("/edit/{id}", name="update_faq_bot", methods={"PUT"}, requirements={"id"="\d+"})
     *
     * @param Request  $request
     * @param FaqBot   $faqBot
     * @param int|null $id
     *
     * @return JsonResponse
     */
    public function edit(Request $request, FaqBot $faqBot, ?int $id)
    {
        $data = json_decode($request->getContent(), true);
        $question = $id === null ? new Question(): $faqBot->retrieveQuestion($id);
        $form = $this->createForm(QuestionType::class, $question);
        $form->submit($data, false);
        if ($form->isSubmitted() && $form->isValid()) {
            $faqBot->save($question);
            if ($id === null) {
                $response = new JsonResponse('Question created', Response::HTTP_CREATED);
            } else {
                $response = new JsonResponse('Question updated', Response::HTTP_ACCEPTED);
            }

            return $response;
        } else {
            $msg['error'] = (string) $form->getErrors(true,false);

            return new JsonResponse($msg, Response::HTTP_BAD_REQUEST);
        }
    }
}

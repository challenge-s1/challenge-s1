<?php

namespace App\Controller;

use App\Entity\Reporting;
use App\Entity\User;
use App\Entity\VoucherDiscount;
use App\Repository\CommentRepository;
use App\Repository\MasterClassRepository;
use App\Repository\ReasonReportingRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

// use Symfony\Component\Mime\Email;


#[AsController]
class ReportingController extends AbstractController
{
    public function __construct(
        private RequestStack $requestStack,
        private ManagerRegistry $managerRegistry,
    ) {
    }

    public function __invoke(CommentRepository $commentRepository, ReasonReportingRepository $reasonReportingRepository)
    {
        $request = $this->requestStack->getCurrentRequest();
        $id = explode("/", json_decode($request->getContent())->commentid);
        $reasonId = $reasonReportingRepository->find(intval(explode("/", json_decode($request->getContent())->reason)[1]));
        $commentId = intval($id[1]);
        $comment = $commentRepository->find($commentId);
        $reportings = $comment->getReportings();
        if (count($reportings) >= 2) {
            $em = $this->managerRegistry->getManager();
            foreach ($reportings as $reporting) {
                $em->remove($reporting);
            }


            $em->remove($comment);
            $em->flush();
        } else {
            $reporting = new Reporting();
            $reporting->setCommentid($comment);
            $reporting->setReason($reasonId);
            $em = $this->managerRegistry->getManager();
            $em->persist($reporting);
            $em->flush();
        }
        return $this->json('ok');
    }
}

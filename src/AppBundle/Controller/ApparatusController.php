<?php
namespace AppBundle\Controller;

use \AppBundle\Entity\Apparatus;
use AppBundle\Entity\ApparatusStatus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ApparatusController extends ApiController {

    public function listAction() {
        // todo: security

        $apparatusRepository = $this->getDoctrine()->getRepository('AppBundle:Apparatus');
        $apparatuses = $apparatusRepository->findAll();
        $apparatuses = array_map( function(Apparatus $apparatus) {
            return $apparatus->toArray();
        }, $apparatuses );
        return $this->jsonResponse(Response::HTTP_OK, "List Retrieved", $apparatuses);

    }

    public function readAction($id) {
        // todo: security
        $apparatusRepository = $this->getDoctrine()->getRepository('AppBundle:Apparatus');
        $apparatus = $apparatusRepository->find($id);
        if ($apparatus) {
            return $this->jsonResponse(Response::HTTP_OK, "Apparatus Retrieved", $apparatus->toFullArray());
        }
        return $this->jsonResponse(Response::HTTP_NOT_FOUND, "Not Found", []);
    }

    public function createAction(Request $request) {
        // todo: security
        try {
            $apparatus = new Apparatus();
            $apparatus->setName($request->get('name'));
            $apparatus->setSeats($request->get('seats'));
            $apparatus->setType($request->get('type'));
            $apparatus->setVin($request->get('vin'));
            $apparatus->addStatus($this->getNewOffDutyStatus($apparatus));
            $apparatus->undelete();

            $em = $this->getDoctrine()->getManager();
            $em->persist($apparatus);
            $em->flush();
            return $this->jsonResponse(Response::HTTP_CREATED, "Apparatus Created", []);
        }
        catch (\Exception $ex) {
            return $this->jsonResponse(Response::HTTP_BAD_REQUEST, $ex->getMessage(), []);
        }
    }

    public function updateAction(Request $request, $id) {
        // todo: security
        $apparatusRepository = $this->getDoctrine()->getRepository('AppBundle:Apparatus');
        $em = $this->getDoctrine()->getManager();
        /** @var Apparatus $apparatus */
        $apparatus = $apparatusRepository->find($id);

        if ($apparatus) {
            $apparatus->setName($request->get('name'));
            $apparatus->setType($request->get('type'));
            $apparatus->setSeats($request->get('seats'));
            $apparatus->setVin($request->get('vin'));
            $em->persist($apparatus);
            $em->flush();
        }
        else {
            return $this->jsonResponse(Response::HTTP_NOT_FOUND, "Not Found", []);
        }
        return $this->jsonResponse(Response::HTTP_OK, "Apparatus Updated", []);
    }

    public function updateStatusAction(Request $request, $id) {
        // todo: security
        $apparatusRepository = $this->getDoctrine()->getRepository('AppBundle:Apparatus');
        $entityManager = $this->getDoctrine()->getManager();

        $apparatus = $apparatusRepository->find($id);
        if ($apparatus) {
            $status = new ApparatusStatus();
            $status
                ->setApparatus($apparatus)
                ->setPersonnelCount($request->get('personnel'))
                ->setOffDutyTime(new \DateTime($request->get('offduty')))
                ->setOnDutyTime(new \DateTime('now'))
                ->setMedicalLevel($request->get('level'))
                ->setPost($request->get('post'))
                ->setDutyStatus($request->get('status') == 'onduty' ? ApparatusStatus::STATUS_ONDUTY : ApparatusStatus::STATUS_OFFDUTY);
            $apparatus->addStatus($status);
            $entityManager->persist($apparatus);
            $entityManager->flush();
            return $this->jsonResponse(Response::HTTP_OK, "Status Updated", []);
        }
        return $this->jsonResponse(Response::HTTP_NOT_FOUND, "Not Found", []);
    }

    public function getStatusAction(Request $request, $id) {

    }

    public function deleteAction($id) {
        // todo: security

        $apparatusRepository = $this->getDoctrine()->getRepository('AppBundle:Apparatus');
        $entityManager = $this->getDoctrine()->getManager();
        $apparatus = $apparatusRepository->find($id);
        if ($apparatus) {
            $apparatus->delete();
            $entityManager->persist($apparatus);
            $entityManager->flush();
            return $this->jsonResponse(Response::HTTP_OK, "Apparatus Deleted", []);
        }
        return $this->jsonResponse(Response::HTTP_NOT_FOUND, "Not Found", []);
    }

    public function unDeleteAction($id) {
        // todo: security

        $apparatusRepository = $this->getDoctrine()->getRepository('AppBundle:Apparatus');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->getFilters()->disable('soft_deleteable_filter');
        $apparatus = $apparatusRepository->find($id);
        if ($apparatus) {
            $apparatus->undelete();
            $entityManager->persist($apparatus);
            $entityManager->flush();
            $entityManager->getFilters()->enable('soft_deleteable_filter');
            return $this->jsonResponse(Response::HTTP_OK, "Apparatus Undeleted", []);
        }
        return $this->jsonResponse(Response::HTTP_NOT_FOUND, "Not Found", []);
    }

    public function oosAction(Request $request, $id) {

        // todo: security
        $apparatusRepository = $this->getDoctrine()->getRepository('AppBundle:Apparatus');
        $entityManager = $this->getDoctrine()->getManager();

        $apparatus = $apparatusRepository->find($id);
        if ($apparatus) {
            $status = new ApparatusStatus();
            $status
                ->setApparatus($apparatus)
                ->setPersonnelCount(0)
                ->setOffDutyTime(new \DateTime('now'))
                ->setOnDutyTime(new \DateTime('now'))
                ->setMedicalLevel('none')
                ->setPost($request->get('post'))
                ->setDutyStatus(ApparatusStatus::STATUS_OOS)
                ->setOosReason($request->get('reason'));
            $apparatus->addStatus($status);
            $entityManager->persist($apparatus);
            $entityManager->flush();
            return $this->jsonResponse(Response::HTTP_OK, "Status Updated", []);
        }
        return $this->jsonResponse(Response::HTTP_NOT_FOUND, "Not Found", []);

    }

    protected function getNewOffDutyStatus(Apparatus $apparatus) {
        $status = new ApparatusStatus();
        $status
            ->setMedicalLevel('none')
            ->setOffDutyTime(new \DateTime())
            ->setOnDutyTime(new \DateTime())
            ->setPersonnelCount(0)
            ->setPost('Station')
            ->setDutyStatus(ApparatusStatus::STATUS_OFFDUTY)
            ->setApparatus($apparatus);
        return $status;
    }
}
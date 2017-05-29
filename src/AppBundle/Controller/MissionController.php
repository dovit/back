<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mission;
use AppBundle\Form\MissionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Mission controller.
 *
 * @Route("missions")
 */
class MissionController extends Controller
{
    /**
     * Lists all mission.
     *
     * @Route("/", name="missions_index")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $missions = $this->get('app.mission_service')
            ->getMissions($this->getUser(), $request->query->getInt('page'), $this->getParameter('limit_paginator'));
        
        return $this->render('mission/index.html.twig', [
            'missions' => $missions,
        ]);
    }

    /**
     * Creates a new mission entity.
     *
     * @Route("/new", name="missions_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CLIENT')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mission);
            $em->flush();

            return $this->redirectToRoute('missions_show',
                ['id' => $mission->getId()]
            );
        }

        return $this->render('mission/new.html.twig', [
            'mission' => $mission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a mission entity.
     *
     * @Route("/{id}", name="missions_show")
     * @Method("GET")
     * @param Mission $mission
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Mission $mission)
    {
        $deleteForm = $this->createDeleteForm($mission);

        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing mission entity.
     *
     * @Route("/{id}/edit", name="missions_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CLIENT')")
     * @param Request $request
     * @param Mission $mission
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Mission $mission)
    {
        if ($this->getUser()->getId() !== $mission->getClient()->getId())
            throw new AccessDeniedException();

        $deleteForm = $this->createDeleteForm($mission);
        $editForm = $this->createForm(MissionType::class, $mission);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('missions_edit',
                ['id' => $mission->getId()]
            );
        }

        return $this->render('mission/edit.html.twig', [
            'mission' => $mission,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a mission entity.
     *
     * @Route("/{id}", name="missions_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Mission $mission
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Mission $mission)
    {
        if ($this->getUser()->getId() !== $mission->getClient()->getId())
            throw new AccessDeniedException();

        $form = $this->createDeleteForm($mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mission);
            $em->flush();
        }

        return $this->redirectToRoute('missions_index');
    }

    /**
     * Creates a form to delete a mission entity.
     *
     * @param Mission $mission The mission entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Mission $mission)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('missions_delete', ['id' => $mission->getId()]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

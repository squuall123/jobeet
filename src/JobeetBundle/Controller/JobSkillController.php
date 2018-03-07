<?php

namespace JobeetBundle\Controller;

use JobeetBundle\Entity\JobSkill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Jobskill controller.
 *
 * @Route("jobskill")
 */
class JobSkillController extends Controller
{
    /**
     * Lists all jobSkill entities.
     *
     * @Route("/", name="jobskill_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jobSkills = $em->getRepository('JobeetBundle:JobSkill')->findAll();

        return $this->render('jobskill/index.html.twig', array(
            'jobSkills' => $jobSkills,
        ));
    }

    /**
     * Creates a new jobSkill entity.
     *
     * @Route("/new", name="jobskill_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $jobSkill = new Jobskill();
        $form = $this->createForm('JobeetBundle\Form\JobSkillType', $jobSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jobSkill);
            $em->flush();

            return $this->redirectToRoute('jobskill_show', array('id' => $jobSkill->getId()));
        }

        return $this->render('jobskill/new.html.twig', array(
            'jobSkill' => $jobSkill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jobSkill entity.
     *
     * @Route("/{id}", name="jobskill_show")
     * @Method("GET")
     */
    public function showAction(JobSkill $jobSkill)
    {
        $deleteForm = $this->createDeleteForm($jobSkill);

        return $this->render('jobskill/show.html.twig', array(
            'jobSkill' => $jobSkill,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jobSkill entity.
     *
     * @Route("/{id}/edit", name="jobskill_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, JobSkill $jobSkill)
    {
        $deleteForm = $this->createDeleteForm($jobSkill);
        $editForm = $this->createForm('JobeetBundle\Form\JobSkillType', $jobSkill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jobskill_edit', array('id' => $jobSkill->getId()));
        }

        return $this->render('jobskill/edit.html.twig', array(
            'jobSkill' => $jobSkill,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jobSkill entity.
     *
     * @Route("/{id}", name="jobskill_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, JobSkill $jobSkill)
    {
        $form = $this->createDeleteForm($jobSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jobSkill);
            $em->flush();
        }

        return $this->redirectToRoute('jobskill_index');
    }

    /**
     * Creates a form to delete a jobSkill entity.
     *
     * @param JobSkill $jobSkill The jobSkill entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(JobSkill $jobSkill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jobskill_delete', array('id' => $jobSkill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

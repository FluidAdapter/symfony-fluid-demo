<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dummy;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Dummy controller.
 *
 * @Route("dummy")
 */
class DummyController extends Controller
{
    /**
     * Lists all dummy entities.
     *
     * @Route("/", name="dummy_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dummies = $em->getRepository('AppBundle:Dummy')->findAll();

        return $this->render('Dummy/Index.html', array(
            'dummies' => $dummies,
        ));
    }

    /**
     * Creates a new dummy entity.
     *
     * @Route("/new", name="dummy_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $dummy = new Dummy();
        $form = $this->createForm('AppBundle\Form\DummyType', $dummy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dummy);
            $em->flush($dummy);

            return $this->redirectToRoute('dummy_index');
        }

        return $this->render('Dummy/New.html', array(
            'dummy' => $dummy,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dummy entity.
     *
     * @Route("/{id}", name="dummy_show")
     * @Method("GET")
     */
    public function showAction(Dummy $dummy)
    {
        $deleteForm = $this->createDeleteForm($dummy);

        return $this->render('Dummy/Show.html', array(
            'dummy' => $dummy,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing dummy entity.
     *
     * @Route("/{id}/edit", name="dummy_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Dummy $dummy)
    {
        $deleteForm = $this->createDeleteForm($dummy);
        $editForm = $this->createForm('AppBundle\Form\DummyType', $dummy);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dummy_edit', array('id' => $dummy->getId()));
        }

        return $this->render('dummy/edit.html.twig', array(
            'dummy' => $dummy,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dummy entity.
     *
     * @Route("/{id}", name="dummy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Dummy $dummy)
    {
        $form = $this->createDeleteForm($dummy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dummy);
            $em->flush($dummy);
        }

        return $this->redirectToRoute('dummy_index');
    }

    /**
     * Creates a form to delete a dummy entity.
     *
     * @param Dummy $dummy The dummy entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dummy $dummy)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dummy_delete', array('id' => $dummy->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

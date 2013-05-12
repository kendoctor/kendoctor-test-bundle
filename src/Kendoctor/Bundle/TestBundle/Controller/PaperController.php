<?php

namespace Kendoctor\Bundle\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Kendoctor\Bundle\TestBundle\Entity\Paper;
use Kendoctor\Bundle\TestBundle\Form\PaperType;
use Kendoctor\Bundle\TestBundle\Entity\ItemGroup;
use Kendoctor\Bundle\TestBundle\Form\ItemGroupType;
use Kendoctor\Bundle\TestBundle\Entity\ItemGroupItem;

/**
 * Paper controller.
 *
 * @Route("/paper")
 */
class PaperController extends Controller {

    /**
     * Lists all Paper entities.
     *
     * @Route("/", name="paper")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KendoctorTestBundle:Paper')->getPublishedPapers();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Paper entity.
     *
     * @Route("/", name="paper_create")
     * @Method("POST")
     * @Template("KendoctorTestBundle:Paper:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Paper();
        
        
        $form = $this->createForm(new PaperType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paper_show', array('id'=>$entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Paper entity.
     *
     * @Route("/new", name="paper_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
  
      
        $entity = new Paper();
        $form = $this->createForm(new PaperType(), $entity);
        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Paper entity.
     *
     * @Route("/{id}", name="paper_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KendoctorTestBundle:Paper')->getPaperWithAllItemsById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paper entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Paper entity.
     *
     * @Route("/{id}/edit", name="paper_edit")
     * @Method("GET")
     * @Template("KendoctorTestBundle:Paper:paperForm.html.twig")
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KendoctorTestBundle:Paper')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paper entity.');
        }

        $editForm = $this->createForm(new PaperType(), $entity);
        return array(
            'edit_form' => $editForm->createView(),
            'entity' => $entity            
        );
    }

    /**
     * Edits an existing Paper entity.
     *
     * @Route("/{id}", name="paper_update")
     * @Method("PUT")
     * @Template("KendoctorTestBundle:Paper:paperForm.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KendoctorTestBundle:Paper')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paper entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PaperType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            return  $this->render("KendoctorTestBundle:Paper:paperShow.html.twig", array("entity"=>$entity));
          
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()           
        );
    }

    /**
     * Deletes a Paper entity.
     *
     * @Route("/{id}", name="paper_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KendoctorTestBundle:Paper')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Paper entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paper'));
    }

    /**
     * Creates a form to delete a Paper entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}

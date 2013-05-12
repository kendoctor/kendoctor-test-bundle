<?php

namespace Kendoctor\Bundle\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Kendoctor\Bundle\TestBundle\Entity\ItemGroup;
use Kendoctor\Bundle\TestBundle\Form\ItemGroupType;

/**
 * ItemGroup controller.
 *
 * @Route("/itemgroup")
 */
class ItemGroupController extends Controller
{
    /**
     * Lists all ItemGroup entities.
     *
     * @Route("/", name="itemgroup")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KendoctorTestBundle:ItemGroup')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new ItemGroup entity.
     *
     * @Route("/{paper_id}", name="itemgroup_create")
     * @Method("POST")
     * @Template("KendoctorTestBundle:ItemGroup:new.html.twig")
     */
    public function createAction(Request $request, $paper_id)
    {
        $em = $this->getDoctrine()->getManager();
        $paper = $em->getRepository("KendoctorTestBundle:Paper")->find($paper_id);
        
        if($paper === null)
        {
            throw $this->createNotFoundException("Not Found the paper");
        }
         
        $entity  = new ItemGroup();
        $entity->setPaper($paper);
        
        $form = $this->createForm(new ItemGroupType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {        
            $em->persist($entity);
            $em->flush();
            return $this->render("KendoctorTestBundle:ItemGroup:show.html.twig", array("entity"=> $entity));    
           
        }

        return array(
            'paper' => $paper,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new ItemGroup entity.
     *
     * @Route("/{paper_id}/type-{itemgroup_type}/new", name="itemgroup_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($paper_id, $itemgroup_type)
    {
        $em = $this->getDoctrine()->getManager();
        $paper = $em->getRepository("KendoctorTestBundle:Paper")->find($paper_id);
        
        if($paper === null)
        {
            throw $this->createNotFoundException("Not Found the paper");
        }
        
        
        $entity = new ItemGroup();
        
        
        $entity->setType($itemgroup_type);
        
        $form   = $this->createForm(new ItemGroupType(), $entity);

        return array(
            'paper' => $paper,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ItemGroup entity.
     *
     * @Route("/{id}", name="itemgroup_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KendoctorTestBundle:ItemGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ItemGroup entity.
     *
     * @Route("/{id}/edit", name="itemgroup_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KendoctorTestBundle:ItemGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemGroup entity.');
        }

        $editForm = $this->createForm(new ItemGroupType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ItemGroup entity.
     *
     * @Route("/{id}", name="itemgroup_update")
     * @Method("PUT")
     * @Template("KendoctorTestBundle:ItemGroup:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KendoctorTestBundle:ItemGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ItemGroupType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            return $this->render("KendoctorTestBundle:ItemGroup:show.html.twig", array("entity"=> $entity));  
           
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ItemGroup entity.
     *
     * @Route("/delete/{id}", name="itemgroup_delete")
     * 
     */
    public function deleteAction(Request $request, $id)
    {
          $em = $this->getDoctrine()->getManager();
          $entity = $em->getRepository('KendoctorTestBundle:ItemGroup')->find($id);

            if (!$entity) {               
                throw $this->createNotFoundException('Unable to find ItemGroup entity.');
            }

            $em->remove($entity);
            $em->flush();

         return new Response(json_encode(array("success"=>true))) ;
    }

    /**
     * Creates a form to delete a ItemGroup entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}

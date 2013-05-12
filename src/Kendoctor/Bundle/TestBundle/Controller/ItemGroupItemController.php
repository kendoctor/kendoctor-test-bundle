<?php

namespace Kendoctor\Bundle\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Kendoctor\Bundle\TestBundle\Entity\ItemGroupItem;
use Kendoctor\Bundle\TestBundle\Form\ItemGroupItemType;
use Kendoctor\Bundle\TestBundle\Entity\ItemGroup;

/**
 * ItemGroupItem controller.
 *
 * @Route("/itemgroupitem")
 */
class ItemGroupItemController extends Controller
{
    /**
     * Lists all ItemGroupItem entities.
     *
     * @Route("/", name="itemgroupitem")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KendoctorTestBundle:ItemGroupItem')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new ItemGroupItem entity.
     *
     * @Route("{itemgroup_id}/", name="itemgroupitem_create")
     * @Method("POST")
     * @Template("KendoctorTestBundle:ItemGroupItem:new.html.twig")
     */
    public function createAction(Request $request,$itemgroup_id)
    {
        $em = $this->getDoctrine()->getManager();
        $itemGroup = $em->getRepository('KendoctorTestBundle:ItemGroup')->find($itemgroup_id);
        
        if (!$itemGroup) {
            throw $this->createNotFoundException('Unable to find ItemGroup entity.');
        }
        
        $entity = new ItemGroupItem();

        switch($itemGroup->getType())
        {
            case ItemGroup::SINGLE_CHOICE:               
                $form   = $this->createForm(new ItemGroupItemType(new \Kendoctor\Bundle\TestBundle\Form\SingleChoiceItemType()), $entity);
                break;
        }        
        
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setItemGroup($itemGroup);
            $em->persist($entity);
            $em->flush();

            return $this->render("KendoctorTestBundle:ItemGroup:".$itemGroup->getType().".html.twig", array('itemGroupItem'=>$entity,'questionItem'=>$entity->getQuestionItem()));
        }

        return array(
            'itemGroup' => $itemGroup,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new ItemGroupItem entity.
     *
     * @Route("{itemgroup_id}/new", name="itemgroupitem_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($itemgroup_id)
    {
        $em = $this->getDoctrine()->getManager();
        $itemGroup = $em->getRepository('KendoctorTestBundle:ItemGroup')->find($itemgroup_id);
        
        
        
        if (!$itemGroup) {
            throw $this->createNotFoundException('Unable to find ItemGroup entity.');
        }
        
        $entity = new ItemGroupItem();
        
        
        switch($itemGroup->getType())
        {
            case ItemGroup::SINGLE_CHOICE:
                $singleChoiceItem = new \Kendoctor\Bundle\TestBundle\Entity\SingleChoiceItem();
                $singleChoiceItem->setSubject("demo");
                $ChoiceItemAnswerCount = 4;
                for($i=1;$i<=$ChoiceItemAnswerCount;$i++)
                {
                    $singleChoiceItem->addChoiceItemAnswer(new \Kendoctor\Bundle\TestBundle\Entity\ChoiceItemAnswer());
                  
                }
                
                $entity->setQuestionItem($singleChoiceItem);
                $form   = $this->createForm(new ItemGroupItemType(new \Kendoctor\Bundle\TestBundle\Form\SingleChoiceItemType()), $entity);
                break;
        }
        
        
        

        return array(
            'itemGroup' => $itemGroup,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ItemGroupItem entity.
     *
     * @Route("/{id}", name="itemgroupitem_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KendoctorTestBundle:ItemGroupItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemGroupItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ItemGroupItem entity.
     *
     * @Route("/{id}/edit", name="itemgroupitem_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KendoctorTestBundle:ItemGroupItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemGroupItem entity.');
        }

        $editForm = $this->createForm(new ItemGroupItemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ItemGroupItem entity.
     *
     * @Route("/{id}", name="itemgroupitem_update")
     * @Method("PUT")
     * @Template("KendoctorTestBundle:ItemGroupItem:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KendoctorTestBundle:ItemGroupItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemGroupItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ItemGroupItemType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('itemgroupitem_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ItemGroupItem entity.
     *
     * @Route("/{id}", name="itemgroupitem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KendoctorTestBundle:ItemGroupItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ItemGroupItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('itemgroupitem'));
    }

    /**
     * Creates a form to delete a ItemGroupItem entity by id.
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

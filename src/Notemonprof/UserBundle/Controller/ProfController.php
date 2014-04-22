<?php
/**
 * Created by IntelliJ IDEA.
 * User: jenubis
 * Date: 14/04/2014
 * Time: 18:58
 */

namespace Notemonprof\UserBundle\Controller;

use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Notemonprof\UserBundle\Entity\User;
use Notemonprof\UserBundle\Form\ProfType;
class ProfController extends Controller {

function addAction(Request $request){

    $user=$this->get('fos_user.user_manager')->createUser();
    $flash = $this->get('braincrafted_bootstrap.flash');
    $form = $this->createFormBuilder($user)
        ->add('username', 'text')
        ->add('email', 'text')
        ->add('plainPassword', 'password')
        ->add('save', 'submit')
        ->getForm();

    $form->handleRequest($request);
    if ($form->isValid()) {
        $user->addRole('ROLE_PROF');
        try {
            $this->get('fos_user.user_manager')->updateUser($user);
        }
        catch(DBALException $e){

            $flash->error('Cet utilisateur existe déja');
            return $this->render('NotemonprofUserBundle:Prof:addprof.html.twig', array(
                'form' => $form->createView(),));
        }
    }
    $flash->success('Utilisateur enregistré');
    return $this->render('NotemonprofUserBundle:Prof:addprof.html.twig', array(
        'form' => $form->createView(),));
}

    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NotemonprofUserBundle:User')->createQueryBuilder('p')
            ->where('p.roles LIKE \'%PROF%\'')
            ->getQuery()->getResult();

        return $this->render('NotemonprofUserBundle:Prof:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new User entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new User();
        $entity->addRole('ROLE_PROF');
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('braincrafted_bootstrap.flash')->success('Prof ajouté');
            return $this->redirect($this->generateUrl('prof_show', array('id' => $entity->getId())));
        }

        return $this->render('NotemonprofUserBundle:Prof:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Creates a form to create a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new ProfType(), $entity, array(
            'action' => $this->generateUrl('prof_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createCreateForm($entity);

        return $this->render('NotemonprofUserBundle:Prof:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NotemonprofUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NotemonprofUserBundle:Prof:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NotemonprofUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NotemonprofUserBundle:Prof:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(new ProfType(), $entity, array(
            'action' => $this->generateUrl('prof_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $flash = $this->get('braincrafted_bootstrap.flash');
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NotemonprofUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $flash->success('Professeur updated');

            return $this->redirect($this->generateUrl('prof_edit', array('id' => $id)));
        }

        return $this->render('NotemonprofUserBundle:Prof:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NotemonprofUserBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('prof_'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('prof_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }




} 
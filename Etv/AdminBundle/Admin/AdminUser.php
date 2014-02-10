<?php
// vendor/etv/admin-bundle/Etv/AdminBundle/Admin/AdminUser.php

namespace Etv\AdminBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AdminUser extends Admin
{
    // Fields to be shown on create/edit forms
    public function getNewInstance()
    {
      $user = parent::getNewInstance();
      // provide a default date/time of now.
      
      //$user->setRoles( new \DateTime( 'now' ) );
      return $user;
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $edit = false;
        if ($this->getSubject()->getId() > 0) {
             $edit = true;
        }
        
        $formMapper
            ->add('username', 'text', array('label' => 'User name'))
            ->add('firstName', 'text', array('label' => 'First name'))
            ->add('lastName', 'text', array('label' => 'Last name'))
            ->add('email', 'text', array('label' => 'E-mail'))
            ->add('active', 'checkbox', array('label' => 'Is active?', 'required' => false))
            //->add('roles','sonata_type_collection' , array('label' => 'Choice', 'required' => false))
            ->add('roles', 'entity', array('label' => 'Roles',
                'class' => 'EtvAdminBundle:AdminRole', 
                'property' => 'name', 
                'multiple' => true, 
                'by_reference' => false,
                //'expanded'=>true,
                'required' => false))
            ->add('password', 'password', array('label' => 'Password', 'required' => ($edit) ? false : true))    
        ;
        if ($edit) {
            $uniqid = $this->getRequest()->query->get('uniqid');
            if ($uniqid) {
                $formData = $this->getRequest()->request->get($uniqid);
                if ($formData && isset($formData['password']) && !$formData['password']) {
                    unset($formData['password']);
                    $formMapper->remove('password');
                    $formData = $this->getRequest()->request->set($uniqid, $formData);
                }
            }
        }
    }
    
   
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('firstName')
            ->add('lastName')
            ->add('email')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('active')
            
            //->add('created_at','datetime')
           // ->add('modify_at','datetime')
           ;
    }
    
    
    public function prePersist($object) {
        $this->setPassword($object);
    }
    
    public function preUpdate($object) {
        $this->setPassword($object);
    }
    public function getExportFormats()
    {
        return array(
            'csv', 'xls'
        ); //'json', 'xml', 
    }
    
    
    protected function setPassword($object) {
        $uniqid = $this->getRequest()->query->get('uniqid');
        $formData = $this->getRequest()->request->get($uniqid);
        if($formData && array_key_exists('password', $formData) && $formData['password'] !== null && strlen($formData['password']) > 0) {
            $salt = md5(rand());
            $encoderService = $this->getConfigurationPool()->getContainer()->get('etv.admin.etvpw_encoder');
           // var_dump($encoderService); die();
           // $encoder = ->getEncoder($object);
            $password = $encoderService->encodePassword($formData['password'], $salt);
            $object->setPassword($password);
            //$object->setPassword(md5(md5($formData['password']).$salt).$salt);
        }
    }
    
    
}

/*
 ->add('description', 'textarea', array(
                'label' => 'Item description',
                'attr'  => array(
                    'class' => 'redactor-init',
                    'style' => 'width: 683px;'
                )
 ->add('visible', 'boolean', array('editable' => true))
if ($this->admin->isGranted('LIST')) {
    ...
}
 */
<?php
// vendor/etv/admin-bundle/Etv/AdminBundle/Admin/EtvUserAdmin.php

namespace Etv\AdminBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EtvUserAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', 'text', array('label' => 'User name'))
            ->add('firstName', 'text', array('label' => 'First name'))
            ->add('lastName', 'text', array('label' => 'Last name'))
            ->add('email', 'text', array('label' => 'E-mail'))
            ->add('password', 'password', array('label' => 'Password'))
        ;
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
            //->add('created_at','datetime')
           // ->add('modify_at','datetime')
           ;
    }
    
    
    public function prePersist($object) {
        $uniqid = $this->getRequest()->query->get('uniqid');
        $formData = $this->getRequest()->request->get($uniqid);
        if(array_key_exists('password', $formData) && $formData['password'] !== null && strlen($formData['password']) > 0) {
            $salt = md5(rand());
            $object->setPassword(md5(md5($formData['password']).$salt).$salt);
        }
    }
    
    public function preUpdate($object) {
        var_dump('itt'); 
        die();
        $uniqid = $this->getRequest()->query->get('uniqid');
        $formData = $this->getRequest()->request->get($uniqid);
        if(array_key_exists('password', $formData) && $formData['password'] !== null && strlen($formData['password']) > 0) {
            $object->setPassword(sha1($formData['password']));
        }
    }
}
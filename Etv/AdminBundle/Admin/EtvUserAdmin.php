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
        //   ->add('lastname', 'text', array('label' => 'Last name'))
           //->add('lastname', 'text', array('label' => 'Last name'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('firstName')
            ->add('lastName')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('firstName')
            ->add('lastName')
            //->add('created_at','datetime')
           // ->add('modify_at','datetime')
           ;
    }
}
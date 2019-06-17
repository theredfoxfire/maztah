<?php
// src/Form/ContactType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',TextType::class);
        $builder->add('email',EmailType::class);
        $builder->add('subject',TextType::class);
        $builder->add('body',TextareaType::class);
    }

    public function getBlockPrefix()
    {
        return 'contact';
    }
}

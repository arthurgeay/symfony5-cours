<?php
/**
 * Created by PhpStorm.
 * User: arthurgeay
 * Date: 11/03/2020
 * Time: 22:42
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ;
    }
}
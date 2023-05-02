<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Translation\TranslatableMessage;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Contraseña'],
                'second_options' => ['label' => 'Confirme Contraseña'],
            ])
            ->add('nombre', TextType::class, array(
                'label' => 'Nombre', 
           ))
            ->add('apellidos')
            ->add('telefono', IntegerType::class, array(
                'label' => 'No. Teléfono  ',
                
           ))
            ->add('marca', TextType::class, array(
                'label' => 'Selecciona la marca  ',
                
           ))
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                  'Proveedor' => 'ROLE_USER_PROVIDER',
                  'Economia' => 'ROLE_ECONOMIA',
                  'Administrador' => 'ROLE_ADMIN',
                  'Almacen' => 'ROLE_ALMACEN',
                ],'label' => 'Selecciona el Rol  ',
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Estoy de acuerdo con los <a href="#">términos de uso</a> ',
                
            'label_html' => true,
            ])
            
            
        ;
        // Data transformer
     $builder->get('roles')
     ->addModelTransformer(new CallbackTransformer(
         function ($rolesArray) {
              // transform the array to a string
              return count($rolesArray)? $rolesArray[0]: null;
         },
         function ($rolesString) {
              // transform the string back to an array
              return [$rolesString];
         }
 ));



    }

     

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

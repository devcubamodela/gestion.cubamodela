<?php

namespace App\Form;

use App\Entity\Economia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EconomiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idProducto')
            ->add('idOrden')
            ->add('idProveedor')
            ->add('pagado')
            ->add('fechaPagado')
            ->add('trazaPagado')
            ->add('cantidadPagado')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Economia::class,
        ]);
    }
}

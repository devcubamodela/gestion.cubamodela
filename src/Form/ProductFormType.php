<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('sku')
            ->add('amount')
            ->add('picture')
            ->add('brand')
            ->add('date')
            ->add('slug')
            ->add('permalink')
            ->add('date_created')
            ->add('date_created_gmt')
            ->add('date_modified')
            ->add('date_modified_gmt')
            ->add('type')
            ->add('status')
            ->add('featured')
            ->add('catalog_visibility')
            ->add('description')
            ->add('short_description')
            ->add('price')
            ->add('regular_price')
            ->add('date_on_sale_from')
            ->add('date_on_sale_from_gmt')
            ->add('date_on_sale_to')
            ->add('date_on_sale_to_gmt')
            ->add('on_sale')
            ->add('total_sales')
            ->add('stock_quantity')
            ->add('stock_status')
            ->add('backorders')
            ->add('backorders_allowed')
            ->add('sold_individuality')
            ->add('wigth')
            ->add('idProduct')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}

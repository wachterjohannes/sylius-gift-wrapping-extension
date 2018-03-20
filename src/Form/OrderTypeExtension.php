<?php

declare(strict_types=1);

namespace Acme\SyliusExamplePlugin\Form;

use Sylius\Bundle\OrderBundle\Form\Type\CartType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class OrderTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('giftWrapping', CheckboxType::class, ['label' => 'Add giftwrapping (+10$ charge)']);
    }

    public function getExtendedType()
    {
        return CartType::class;
    }
}

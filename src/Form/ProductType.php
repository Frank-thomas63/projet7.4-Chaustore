<?php

namespace App\Form;
use App\Entity\Brand;
use App\Entity\Color;
use App\Entity\Product;
use App\Entity\Category;
use App\Controller\ProductController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('image', FileType::class, array(
                'label' => 'Upload image',
                'data_class' => null,
                'required' => false,
                
            ))
            ->add('price', MoneyType::class, [
              'divisor' => 100,
            ])
            ->add('gender',ChoiceType::class, [
                'choices' => [
                    'W' => 'W',
                    'M' => 'm',
            ]])
            ->add('category',EntityType::class, [
                  'class' => category::class,
                  'choice_label' => function($category)
                  {
                     return $category->getName();
                  }
            ])
            ->add('brand', EntityType::class, [
                  'class' => brand::class,
                  'choice_label' => function($brand)
                  {
                     return $brand->getName();
                  }
            ])
            ->add('color', EntityType::class, [
                  'class' => color::class,
                  'choice_label' => function($color)
                  {
                     return $color->getName();
                  }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

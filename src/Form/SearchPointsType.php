<?php

namespace App\Form;

use App\Form\Model\SearchPointsModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\SubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormEvents;

class SearchPointsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('street', TextType::class, [
                'required' => false,
            ])
            ->add('city', TextType::class)
            ->add('zip', TextType::class, [
                'required' => false,
            ])
            ->add('search', SubmitType::class)
            ->addEventListener(FormEvents::SUBMIT, function (SubmitEvent $event): void {
                $model = $event->getData();
                $form = $event->getForm();
                if (!$model) {
                    return;
                }
                if ('01-234' === $model->getZip()) {
                    $form->add('name', TextType::class, ['mapped' => false, 'required' => false]);
                }
            })
            ->get('city')
                ->addModelTransformer(new CallbackTransformer(
                    function ($city): ?string {
                        return $city;
                    },
                    function ($city): string {
                        return ucfirst(strtolower($city));
                    }
                ))
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchPointsModel::class,
        ]);
    }
}

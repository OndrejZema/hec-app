<?php

namespace App\Form\Type\Chart;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChartType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data' => null,
            'type' => 'bar',
            'mapped' => false
        ]);
        $resolver->addAllowedTypes('data', [ChartData::class]);
    }
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['data'] = $options['data'];
        $view->vars['type'] = $options['type'];
        $view->vars['mapped'] = $options['mapped'];
    }

    public function getBlockPrefix(): string
    {
        return 'chart';
    }
}

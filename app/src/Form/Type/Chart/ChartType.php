<?php

namespace App\Form\Type\Chart;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ChartType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['type'] = $options['type'];
        $view->vars['data'] = $options['data'];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'type' => 'bar',
            'data' => null,
        ]);
        // $resolver->setRequired(['type', 'data']);

        $resolver->setAllowedTypes('type', 'string');
        $resolver->setAllowedTypes('data', ['null', ChartData::class]);
    }

    public function getParent(): string
    {
        return HiddenType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'chart'; // Twig bude hledat block "chart_data_widget"
    }
}

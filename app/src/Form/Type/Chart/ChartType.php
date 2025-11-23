<?php

namespace App\Form\Type\Chart;

use App\Form\DataTransformer\StringToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ChartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
//        $builder->addModelTransformer(new StringToArrayTransformer());
    }
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['type'] = $options['type'];
        $view->vars['labels'] = $options['labels'];
        $view->vars['label'] = $options['label'];
        $view->vars['backgroundColor'] = $options['backgroundColor'];
        $view->vars['borderColor'] = $options['borderColor'];
        $view->vars['borderWidth'] = $options['borderWidth'];
        $view->vars['dragData'] = $options['dragData'];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'type' => 'bar',
            'data' => [],
            'labels' => [],
            'label' => '',
            'backgroundColor' => '#fd9a00',
            'borderColor' => '#fd9a00',
            'borderWidth' => 6,
            'dragData' => true
        ]);

        $resolver->setAllowedTypes('type', 'string');
        $resolver->setAllowedTypes('data', ['array']);
        $resolver->setAllowedTypes('labels', ['array']);
        $resolver->setAllowedTypes('label', ['string']);
        $resolver->setAllowedTypes('backgroundColor', ['string']);
        $resolver->setAllowedTypes('borderColor', ['string']);
        $resolver->setAllowedTypes('borderWidth', ['integer']);
        $resolver->setAllowedTypes('dragData', ['boolean']);
    }

    public function getParent(): string
    {
        return TextType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'chart'; // Twig bude hledat block "chart_data_widget"
    }
}

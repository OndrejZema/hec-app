<?php

namespace App\Form;

use App\Form\Type\Chart\ChartData;
use App\Form\Type\Chart\ChartDataset;
use App\Form\Type\Chart\ChartType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $chartData = $options['data']['chartData'];
        $builder
            ->add('items', ChartType::class, [
                    'type' => 'bar',
                    'data' => new ChartData(
                        ["a", "b", "c"],
                        [
                            new ChartDataset(
                                "data...",
                                $chartData,
                            )
                        ]
                    )
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

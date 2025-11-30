<?php

namespace App\Form;

use App\Dto\ConsumptionProfile\CreateConsumptionProfileDto;
use App\Enum\ProfileTypeEnum;
use App\Form\Type\Chart\ChartType;
use App\Service\Interface\IDateRangeService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsumptionProfileFormType extends AbstractType
{
    public function __construct(protected IDateRangeService $dateRangeService)
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.name',
                'translation_domain' => 'common',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'form.description',
                'translation_domain' => 'common',
                'required' => false,
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'form.type',
                'translation_domain' => 'common',
                'choices' => ProfileTypeEnum::getChoices(),
                'required' => true,
            ])
            ->add('consumptionIndex', RangeType::class, [
                'label' => 'form.consumption_index',
                'translation_domain' => 'consumption_profile',
                'required' => true,
                'attr' => [
                    'min' => 0,
                    'max' => 2,
                ]
            ])
            ->add('profileDay', ChartType::class, [
                'label' => 'form.profile.day',
                'translation_domain' => 'consumption_profile',
                'required' => true,
                'labels' => $this->dateRangeService->hours()
            ])
            ->add('profileWeek', ChartType::class, [
                'label' => 'form.profile.week',
                'translation_domain' => 'consumption_profile',
                'required' => true,
                'labels' => $this->dateRangeService->days()
            ])
            ->add('profileMonth', ChartType::class, [
                'label' => 'form.profile.month',
                'translation_domain' => 'consumption_profile',
                'required' => true,
                'labels' => $this->dateRangeService->weeks()
            ])
            ->add('profileYear', ChartType::class, [
                'label' => 'form.profile.year',
                'translation_domain' => 'consumption_profile',
                'required' => true,
                'labels' => $this->dateRangeService->months()
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateConsumptionProfileDto::class,
        ]);
    }
}

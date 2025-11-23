<?php

namespace App\Form;

use App\Dto\PerformanceProfile\CreatePerformanceProfileDto;
use App\Entity\User;
use App\Enum\ProfileTypeEnum;
use App\Form\Type\Chart\ChartData;
use App\Form\Type\Chart\ChartDataset;
use App\Form\Type\Chart\ChartType;
use App\Service\Interface\IHouseService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerformanceProfileFormType extends AbstractType
{
    public function __construct(protected IHouseService $houseService)
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var User $user */
        $user = $options['user'];
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
            ->add('performanceIndex', RangeType::class, [
                'label' => 'form.performance_index',
                'translation_domain' => 'performance_profile',
                'required' => true,
                'attr' => [
                    'min' => 0,
                    'max' => 2,
                ]
            ])
            ->add('profileDay', ChartType::class, [
                'label' => 'form.profile.day',
                'translation_domain' => 'performance_profile',
                'required' => true,
                'labels' => ['jedna', 'dva', 'tri']
            ]);
//            ->add('profileWeek', ChartType::class, [
//                    'label' => 'form.profile.week',
//                'translation_domain' => 'performance_profile',
//                'required' => true,
//            ])
//            ->add('profileMonth', ChartType::class, [
//                'label' => 'form.profile.month',
//                'translation_domain' => 'performance_profile',
//                'required' => true,
//            ])
//            ->add('profileYear', ChartType::class, [
//                'label' => 'form.profile.year',
//                'translation_domain' => 'performance_profile',
//                'required' => true,
//            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreatePerformanceProfileDto::class,
        ]);

        $resolver->setRequired('user');
    }
}

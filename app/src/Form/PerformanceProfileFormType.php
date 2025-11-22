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
        $houses = [];
        foreach ($this->houseService->getForUser($user) as $house) {
            $houses[$house->name] = $house->id;
        }
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
            ->add('houseId', ChoiceType::class, [
                'label' => 'form.house',
                'translation_domain' => 'common',
                'required' => true,
                'choices' => $houses
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'form.type',
                'translation_domain' => 'common',
                'choices' => ProfileTypeEnum::getChoices(),
                'required' => true,
            ])
            ->add('performanceIndex', TextareaType::class, [
                'label' => 'form.type',
                'translation_domain' => 'common',
                'required' => true,
            ])
            ->add('profileDay', ChartType::class, [
                'label' => 'form.type',
                'translation_domain' => 'performance_profile',
                'required' => true,
                'data' => new ChartData(["8:00"], [new ChartDataset("test", [1])])
            ])
            ->add('profileWeek', ChartType::class, [
                'label' => 'form.type',
                'translation_domain' => 'performance_profile',
                'required' => true,
                'data' => new ChartData(["monday"], [new ChartDataset("test", [1])])
            ])
            ->add('profileMonth', ChartType::class, [
                'label' => 'form.type',
                'translation_domain' => 'performance_profile',
                'required' => true,
                'data' => new ChartData(["1"], [new ChartDataset("test", [1])])
            ])
            ->add('profileYear', ChartType::class, [
                'label' => 'form.type',
                'translation_domain' => 'performance_profile',
                'required' => true,
                'data' => new ChartData(["january"], [new ChartDataset("test", [1])])
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreatePerformanceProfileDto::class,
        ]);

        $resolver->setRequired('user');
    }
}

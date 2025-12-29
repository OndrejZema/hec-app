<?php

namespace App\Form;

use App\Dto\BrokerProfile\CreateBrokerProfileDto;
use App\Form\Type\Chart\ChartType;
use App\Service\Interface\IDateRangeService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BrokerProfileFormType extends AbstractType
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
            ->add('purchaseProfileDay', ChartType::class, [
                'label' => 'form.purchase.profile.day',
                'translation_domain' => 'broker_profile',
                'required' => true,
                'labels' => $this->dateRangeService->hours()
            ])
            ->add('purchaseProfileWeek', ChartType::class, [
                'label' => 'form.purchase.profile.week',
                'translation_domain' => 'broker_profile',
                'required' => true,
                'labels' => $this->dateRangeService->days()
            ])
            ->add('purchaseProfileMonth', ChartType::class, [
                'label' => 'form.purchase.profile.month',
                'translation_domain' => 'broker_profile',
                'required' => true,
                'labels' => $this->dateRangeService->weeks()
            ])
            ->add('purchaseProfileYear', ChartType::class, [
                'label' => 'form.purchase.profile.year',
                'translation_domain' => 'broker_profile',
                'required' => true,
                'labels' => $this->dateRangeService->months()
            ])
            ->add('saleProfileDay', ChartType::class, [
                'label' => 'form.sale.profile.day',
                'translation_domain' => 'broker_profile',
                'required' => true,
                'labels' => $this->dateRangeService->hours()
            ])
            ->add('saleProfileWeek', ChartType::class, [
                'label' => 'form.sale.profile.week',
                'translation_domain' => 'broker_profile',
                'required' => true,
                'labels' => $this->dateRangeService->days()
            ])
            ->add('saleProfileMonth', ChartType::class, [
                'label' => 'form.sale.profile.month',
                'translation_domain' => 'broker_profile',
                'required' => true,
                'labels' => $this->dateRangeService->weeks()
            ])
            ->add('saleProfileYear', ChartType::class, [
                'label' => 'form.sale.profile.year',
                'translation_domain' => 'broker_profile',
                'required' => true,
                'labels' => $this->dateRangeService->months()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateBrokerProfileDto::class,
        ]);
    }
}

<?php

namespace App\Service;

use App\Service\Interface\IDateRangeService;
use Carbon\Carbon;
use Symfony\Contracts\Translation\TranslatorInterface;

class DateRangeService implements IDateRangeService
{
    public function __construct(protected TranslatorInterface $translator)
    {
    }

    public function hours(): array
    {
        $hours = [];
        for ($i = 0; $i < 24; $i++) {
            $hours[] = sprintf('%02d:00', $i);
        }
        return $hours;
    }

    public function days(): array
    {
        Carbon::setLocale($this->translator->getLocale());

        $days = [];
        $date = Carbon::parse('next Monday');

        for ($i = 0; $i < 7; $i++) {
            $days[] = $date->getTranslatedDayName();
            $date->addDay();
        }

        return $days;

    }

    public function weeks(): array
    {
        return ['1', '2', '3', '4'];
    }

    public function months(): array
    {
        Carbon::setLocale($this->translator->getLocale());
        $months = [];
        $date = Carbon::create(null, 1, 1);
        for ($i = 0; $i < 12; $i++) {
            $monthName = $date->getTranslatedMonthName();
            $months[] = $monthName;
            $date->addMonth();
        }
        return $months;
    }
}

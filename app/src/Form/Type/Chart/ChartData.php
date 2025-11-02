<?php

namespace App\Form\Type\Chart;

class ChartData
{
    /**
     * @param array<string> $labels
     * @param array<Chartdataset> $datasets
     */
    public function __construct(
        public array $labels,
        public array $datasets,
    ){}
}

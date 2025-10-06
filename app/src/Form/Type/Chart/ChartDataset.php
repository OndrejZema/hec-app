<?php

namespace App\Form\Type\Chart;

class ChartDataset
{
    public function __construct(
        public string $label,
        public array $data
    ){}
}

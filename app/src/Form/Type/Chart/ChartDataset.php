<?php

namespace App\Form\Type\Chart;

class ChartDataset
{
    public function __construct(
        public string $label,
        public array  $data,
        public string $backgroundColor = "#fd9a00",
        public string $borderColor = "#fd9a00",
        public int    $borderWidth = 6,
        public bool   $dragData = true
    )
    {
    }
}

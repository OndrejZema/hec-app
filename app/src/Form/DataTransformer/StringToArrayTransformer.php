<?php

namespace App\Form\DataTransformer;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToArrayTransformer implements DataTransformerInterface
{
    /**
     * @param mixed|null $value
     * @return string
     */
    public function transform(mixed $value): string
    {
        if (null === $value) {
            return '';
        }

        if (!is_array($value)) {
            // Tohle by se nemělo stát, pokud je DTO správně typované.
            throw new TransformationFailedException('Očekáván typ array, přijat jiný typ.');
        }

        // Převod pole na string, oddělený čárkou a mezerou
        return implode(',', $value);
    }

    /**
     * @param ?mixed $value
     * @return array<string|int|float>
     */
    public function reverseTransform(mixed $value): array
    {
        if (null === $value || '' === $value) {
            return [];
        }
        if (!is_string($value)) {
            throw new TransformationFailedException('Očekáván typ string.');
        }
        $string = preg_replace('/\s*,\s*/', ',', $value);
        $array = explode(',', $string);
        $array = array_filter($array);
        return array_values($array);
    }
}

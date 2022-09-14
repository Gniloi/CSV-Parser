<?php

declare(strict_types=1);

namespace App;

class CurrencyModifier
{
    public function modify(mixed $value, string $currencyName): string
    {
        if ($currencyName == "USD") {
            $value = (string) $value;
            return $this->USD($value);
        }
    }

    public function USD(string $value): string
    {
        if ($value < 0) {
            $value = str_pad($value, strlen($value) + 1, "-", STR_PAD_LEFT);
            $value[1] = '$';
        }

        if ($value > 0) {
            $value = str_pad($value, strlen($value) + 1, "$", STR_PAD_LEFT);
        }

        return $value;
    }
}

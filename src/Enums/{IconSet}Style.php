<?php

namespace Vendor\Icons\{IconSet}\Enums;

use Filafly\Icons\Contracts\StyleEnum;

enum {IconSet}Style: string implements StyleEnum
{
    case Regular = '';           // Default, no suffix
    case Bold = '-bold';
    case Light = '-light';
    // ... other styles

    public function getStyleName(): string
    {
        return match ($this) {
            self::Regular => 'regular',
            self::Bold => 'bold',
            self::Light => 'light',
        };
    }

    public function getEnumSuffix(): string
    {
        return match ($this) {
            self::Regular => 'Regular',
            self::Bold => 'Bold',
            self::Light => 'Light',
        };
    }

    public static function getStyleNames(): array
    {
        return ['regular', 'bold', 'light'];
    }

    public static function fromStyleName(string $styleName): ?self
    {
        return match (strtolower($styleName)) {
            'regular' => self::Regular,
            'bold' => self::Bold,
            'light' => self::Light,
            default => null,
        };
    }
}
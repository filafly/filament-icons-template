<?php

namespace {Vendor}\Icons\{IconSet}Enums;

use Filament\Support\Contracts\ScalableIcon;
use Filament\Support\Enums\IconSize;

enum {IconSet}: string implements ScalableIcon
{
    // Icons with consistent naming pattern
    case Search = 'search';
    case SearchBold = 'search-bold';  // If styles are in enum
    case Home = 'home';
    case Filter = 'filter';
    // ... all available icons

    public function getIconForSize(IconSize $size): string
    {
        return match ($size) {
            default => '{iconset}-'.$this->value,
        };
    }
}
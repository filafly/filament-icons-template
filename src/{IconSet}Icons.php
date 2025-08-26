<?php

namespace Vendor\Icons\{IconSet};

use Vendor\Icons\{IconSet}\Enums\{IconSet};
use Vendor\Icons\{IconSet}\Enums\{IconSet}Style; // Optional, if styles exist
use Filafly\Icons\IconSet;
use Filament\Actions\View\ActionsIconAlias;
use Filament\Forms\View\FormsIconAlias;
use Filament\Infolists\View\InfolistsIconAlias;
use Filament\Notifications\View\NotificationsIconAlias;
use Filament\Schemas\View\SchemaIconAlias;
use Filament\Support\View\SupportIconAlias;
use Filament\Tables\View\TablesIconAlias;
use Filament\View\PanelsIconAlias;

class {IconSet}Icons extends IconSet
{
    protected string $pluginId = 'vendor-filament-{iconset}-icons';

    protected mixed $iconEnum = {IconSet}::class;

    protected string $iconPrefix = '{iconset}'; // e.g., 'phosphor', 'carbon'

    // Optional: Only if icon set has multiple styles
    protected mixed $styleEnum = {IconSet}Style::class;

    protected array $iconMap = [
        // Core Panel Navigation
        PanelsIconAlias::GLOBAL_SEARCH_FIELD => {IconSet}::Search,
        PanelsIconAlias::PAGES_DASHBOARD_ACTIONS_FILTER => {IconSet}::Filter,
        PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM => {IconSet}::Home,
        // ... (complete mapping of all Filament aliases)
    ];
}
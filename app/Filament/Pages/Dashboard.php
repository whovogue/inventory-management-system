<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    // The navigation icon must be of type ?string
    protected static ?string $navigationIcon = 'heroicon-o-home'; // This can be a string or null

    // The navigation label must also be of type ?string
    protected static ?string $navigationLabel = 'Dashboard'; // This can be a string or null

    public static function getSlug(): string
    {
        return 'dashboard'; // This should match the route name
    }
}




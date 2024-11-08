<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    // Redirect after creating the user
    protected function afterCreate(): void
    {
        $this->redirect(route('filament.admin.resources.users.index'));
    }
}

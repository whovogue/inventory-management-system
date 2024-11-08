<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')->required(),
            TextInput::make('email')->required()->email(),
            
            // Password field logic
            TextInput::make('password')
            ->password()
            ->label('Password')
            ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null) // Only hash and update if filled
            ->dehydrated(fn ($state) => filled($state)) // Only send data if the field is filled
            ->required(fn ($livewire) => $livewire instanceof Pages\CreateUser) // Required only when creating
            ->nullable(), // Allows it to be empty on edit
            
            Select::make('roles')
                ->label('User Type')
                ->options([
                    'admin' => 'Admin',
                    'staff' => 'Staff',
                    'manager' => 'Manager',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable(),
                TextColumn::make('roles')
                ->label('User Type')
                ->sortable()
                ->formatStateUsing(fn (string $state) => ucfirst($state)) // Capitalizes the role name
                ->badge() // Applies badge styling
                ->colors([ // Defines colors based on the role
                    'primary' => 'Admin',
                    'success' => 'manager',
                    'warning' => 'staff',
                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

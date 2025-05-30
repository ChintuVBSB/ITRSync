<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('role')
                ->label('User Role')
                ->required()
                ->options([
                    'admin' => 'Admin',
                    'manager' => 'Manager',
                    'user' => 'User',
                    'staff'=> 'Staff',
                ])
                
                ->native(false),
            Forms\Components\TextInput::make('password')
            ->password()
            ->required(fn(string $context)=>$context==='create')
            ->dehydrateStateUsing(fn ($state) => \Hash::make($state))
            ->label('Password'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')->sortable()
                ->searchable()
                ->formatStateUsing(fn ($state) => ucwords($state)),

                TextColumn::make('email')
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn ($state) => ucfirst($state)),

                TextColumn::make('role')
                ->searchable()
                ->label('Role')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                'admin' => 'danger',
                'manager' => 'warning',
                'staff' => 'info',
                'user' => 'success',
                default => 'gray',
                }),
                TextColumn::make('created_at')
                ->dateTime()
                ->label('Created')
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

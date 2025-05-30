<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\PersonResource\Pages;
use App\Filament\User\Resources\PersonResource\RelationManagers;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;

class PersonResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('name')->required(),
            Select::make('gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other',
                ])->required(),

            DatePicker::make('dob')->label('Date of Birth')->required(),

            Textarea::make('address')->required(),

            TextInput::make('pan')->required(),
            FileUpload::make('pan_attachment')->label('PAN Attachment')->required(),

            TextInput::make('aadhar')->required(),
            FileUpload::make('aadhar_attachment')->label('Aadhar Attachment')->required(),

            Select::make('residential_status')
                ->label('Residential Status')
                ->options([
                    'Resident' => 'Resident',
                    'Non-Resident' => 'Non-Resident',
                    'Resident but Not Ordinary Resident' => 'Resident but Not Ordinary Resident',
                ])
                ->columns(1),

            TextInput::make('mobile')->required(),
            TextInput::make('email')->email()->required(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email'),
                TextColumn::make('mobile'),
                TextColumn::make('created_at')->label('Created')->dateTime(),
            ])
            ->filters([
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
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePerson::route('/create'),
            'edit' => Pages\EditPerson::route('/{record}/edit'),
        ];
    }
}

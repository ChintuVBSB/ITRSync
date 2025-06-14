<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\PersonResource\Pages;
use App\Filament\User\Resources\PersonResource\RelationManagers;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
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
use Filament\Forms\Components\Repeater; 

class PersonResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            // Name, Gender, DOB in a row
            Grid::make(3)->schema([
                TextInput::make('name')
                    ->required()
                    ->columnSpan(1),

                Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                        'other' => 'Other',
                    ])
                    ->required()
                    ->columnSpan(1),

                DatePicker::make('dob')
                    ->label('Date of Birth')
                    ->required()
                    ->columnSpan(1),
            ]),

            // PAN and PAN attachment in the same row
            Grid::make(4)->schema([
                TextInput::make('pan')
                    ->label('PAN Number')
                    ->required(),


            // Aadhaar and Aadhaar attachment in the same row
                TextInput::make('aadhar')
                    ->label('Aadhaar Number')
                    ->required(),

                FileUpload::make('pan_attachment')
                    ->label('PAN Attachment')
                    ->required()
                    ->panelLayout('compact')
                    ->visible(fn ($record) => !$record || !$record->pan_attachment),

                FileUpload::make('aadhar_attachment')
                    ->label('Aadhaar Attachment')
                    ->required()
                    ->visible(fn ($record) => !$record || !$record->aadhar_attachment),
            ]),

            // ITR Password, Address, Residential Status
            Grid::make(4)->schema([
                TextInput::make('itr_password')
                    ->label('ITR Account Password')
                    ->password()
                    ->revealable()
                    ->required(),

                Select::make('residential_status')
                    ->label('Residential Status')
                    ->options([
                        'Resident' => 'Resident',
                        'Non-Resident' => 'Non-Resident',
                        'Resident but Not Ordinary Resident' => 'Resident but Not Ordinary Resident',
                    ])
                    ->required(),
                Textarea::make('address')
                    ->label('Address')
                    ->required()
                    ->rows(2)
                    ->columnSpan(2),
            ]),

            // Mobile and Email
            Grid::make(3)->schema([
                TextInput::make('mobile')
                ->required()
                ->columnSpan(1),
                TextInput::make('email')
                ->email()
                ->required()
                ->columnSpan(1),
            ]),

            // Bank Details
            Repeater::make('bankDetails')   
                ->label('Bank Details')
                ->relationship('bankDetails')
                ->createItemButtonLabel('+ Add Bank Info')
                ->schema([
                    TextInput::make('bank_name')->label('Bank Name')->required(), 
                    TextInput::make('account_number')->label('Account Number')->required(), 
                    TextInput::make('ifsc_code')->label('IFSC Code')->required(),
                ])
                ->columns(3)
                ->columnSpanFull()
        ]);
}



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('mobile'),
                TextColumn::make('email'),
                TextColumn::make('pan'),
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

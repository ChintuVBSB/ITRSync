<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\IncomeTypeResource\Pages;
use App\Filament\User\Resources\IncomeTypeResource\RelationManagers;
use App\Models\IncomeType;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomeTypeResource extends Resource
{
    protected static ?string $model = IncomeType::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-rupee';
    protected static ?string $navigationLabel = 'Income';
    protected static ?int $navigationSort = 3; // Higher than Submissions
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Tabs::make('Income Details')
    ->tabs([
        Tab::make('Salary')
            ->schema([
                Toggle::make('no_form_16')->label('No Form 16')->reactive(),

                Grid::make(3)->schema([
                    FileUpload::make('form_16')->label('Form 16')->multiple()
                        ->visible(fn(Get $get) => $get('no_form_16') === false),

                    FileUpload::make('salary_slips')->label('Salary Slips')->multiple()
                        ->visible(fn(Get $get) => $get('no_form_16') === false),

                    FileUpload::make('arrears_sheet')->label('Arrears Sheet (if received)')->multiple()
                        ->visible(fn(Get $get) => $get('no_form_16') === false),

                    TextInput::make('employer_pan')
                        ->label('TAN or PAN of Employer')
                        ->placeholder('e.g., AAAPL1234C')
                        ->visible(fn(Get $get) => $get('no_form_16') === true),
                    TextInput::make('salary_amount')
                        ->label('Salary Amount')->numeric()
                        ->placeholder('800000'),
                    Textarea::make('employer_address')->label('Address of Employer')
                        ->placeholder('Enter full address of your employer')
                        ->visible(fn(Get $get) => $get('no_form_16') === true),

                    ]),
                
                
                Section::make('HRA Details')
                    ->schema([
                        TextInput::make('hra_rent_paid')
                        ->label('Rent Paid')
                        ->columnSpan(1)
                        ->placeholder('e.g., 15000'),
                        TextInput::make('hra_city')->label('City of Residence')
                        ->placeholder('e.g., Bangalore'),
                        TextInput::make('hra_landlord_name')->label('Name of Landlord')
                        ->placeholder('Full name'),
                        Textarea::make('hra_property_address')->label('Address of the Property'),
                    ])->columns(2),
                    ]),

        Tab::make('House Property')
            ->schema([
                Repeater::make('rented_properties')->label('Rented Properties')
                    ->createItemButtonLabel('Add More Rented Property')
                    ->schema([
                        TextInput::make('tenant_name'),
                        TextInput::make('property_address'),
                        TextInput::make('rental_income'),
                        TextInput::make('ownership_percent')->placeholder("%"),
                        TextInput::make('months_occupied'),
                        FileUpload::make('tax_receipts')->multiple(),
                        FileUpload::make('interest_certificate')->multiple(),
                    ])->columns(2)->defaultItems(1),

                Section::make('Self-Occupied Property')
                    ->schema([
                        TextInput::make('self_address'),
                        TextInput::make('self_ownership_percent'),
                        FileUpload::make('self_interest_certificate')->multiple(),
                    ])->columns(2),
                    ]),

        Tab::make('Business')
            ->schema([
                Repeater::make('businesses')->label('Business Ventures')
                    ->schema([
                        Section::make('Presumptive Scheme')->schema([
                            TextInput::make('presumptive_business_name'),
                            TextInput::make('presumptive_bank_sales')->numeric(),
                            TextInput::make('presumptive_cash_sales')->numeric(),
                        ])->columns(2),

                        Section::make('Normal Business')->schema([
                            TextInput::make('normal_total_sales')->numeric(),
                            TextInput::make('normal_total_expenses')->numeric(),
                            FileUpload::make('normal_bank_statement')->multiple(),
                        ])->columns(2),

                        Section::make('Firm Income')->schema([
                            TextInput::make('firm_name'),
                            TextInput::make('firm_pan'),
                            TextInput::make('firm_share_percent')->numeric(),
                            TextInput::make('firm_remuneration')->numeric(),
                            TextInput::make('firm_interest')->numeric(),
                            TextInput::make('firm_profit_loss')->numeric(),
                            TextInput::make('firm_closing_balance')->numeric(),
                        ])->columns(2),
                    ])->defaultItems(1)->columns(1),
                        ]),
        Tab::make('Capital Gains')
            ->schema([
                Section::make('Sale of Securities')->description('e.g., Equity Funds, Bonds')
                    ->schema([
                        FileUpload::make('demat_statement')->multiple(),
                    ]),

                Section::make('Sale of Immovable Property')->schema([
                    FileUpload::make('sale_deed')->multiple(),
                    FileUpload::make('purchase_deed')->multiple(),
                    Textarea::make('improvement_expenses_details'),
                ])->columns(2),
            ])
            ->visible(fn(Get $get) => in_array('capital_gains', (array) $get('income_types'))),

        Tab::make('Other Sources')->schema([
            Grid::make(3)->schema([
                Textarea::make('other_income_details'),
                Textarea::make('dividend_income'),
                Textarea::make('interest_from_others'),
                FileUpload::make('crypto_income_statement')->multiple(),
                FileUpload::make('interest_certificate')->multiple(),
            ])
        ])
    ])
    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListIncomeTypes::route('/'),
            'create' => Pages\CreateIncomeType::route('/create'),
            'edit' => Pages\EditIncomeType::route('/{record}/edit'),
        ];
    }
}

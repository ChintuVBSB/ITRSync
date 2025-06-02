<?php

namespace App\Filament\User\Resources\SubmissionResource\Pages;

use App\Filament\User\Resources\SubmissionResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Section; 
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use App\Models\Person;
use Filament\Forms\Get;
use Filament\Forms\Components\Grid;

class CreateSubmission extends CreateRecord
{
    protected static string $resource = SubmissionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                Step::make('Basic Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('year')
                                    ->label('Financial Year')
                                    ->required()
                                    ->options([
                                        '2024-2025' => '2024-2025',
                                        '2023-2024' => '2023-2024',
                                        '2022-2023' => '2022-2023',
                                        '2021-2022' => '2021-2022',
                                        '2020-2021' => '2020-2021',
                                    ]),
                                Select::make('person_id')
                                    ->label('Select Person')
                                    ->options(
                                        Person::where('user_id', Auth::id())->pluck('name', 'id')
                                    )
                                    ->searchable()
                                    ->required(),
                            ])
                    ]),

                Step::make('Check Income Types')
                    ->schema([
                        CheckboxList::make('income_types')
                            ->label('Income Types')
                            ->options([
                                'salary' => 'Income from Salary',
                                'house_property' => 'Income from House Property',
                                'business' => 'Income from Business and Profession',
                                'capital_gains' => 'Income from Capital Gains',
                                'other_sources' => 'Income from Other Sources',
                            ])
                            ->columns(1)
                            ->reactive()
                            ->statePath('data.income_types'), 
                        CheckboxList::make('deduction_types')
                            ->label('Deduction Types')
                            ->options([
                                '80C' => '80 C- Investments',
                                '80D' => '80 D- Mediclaim',
                                '80E' => '80 E- Interest on Education loan',
                                '80G' => '80G/ 80GGA/ 80GGC- Donation',
                                'other Deduction' => 'Any Other Deduction Document',
                            ])
                            ->columns(1)
                            ->reactive(),
                        
                    ]),

                Step::make('Incomes')
                    ->schema([
                        // SALARY SECTION
                        Section::make('Income from Salary')
                            ->schema([
                                Toggle::make('no_form_16')
                                    ->label('No Form 16')
                                    ->reactive(),

                                Grid::make(2)->schema([
                                    FileUpload::make('form_16')
                                        ->label('Form 16')
                                        ->multiple()
                                        ->visible(fn(Get $get) => $get('no_form_16') === false),

                                    FileUpload::make('salary_slips')
                                        ->label('Salary Slips')
                                        ->multiple()
                                        ->visible(fn(Get $get) => $get('no_form_16') === false),

                                    FileUpload::make('arrears_sheet')
                                        ->label('Arrears Sheet (if received)')
                                        ->multiple()
                                        ->visible(fn(Get $get) => $get('no_form_16') === false),

                                    TextInput::make('employer_pan')
                                        ->label('TAN or PAN of Employer')
                                        ->visible(fn(Get $get) => $get('no_form_16') === true),

                                    Textarea::make('employer_address')
                                        ->label('Address of Employer')
                                        ->visible(fn(Get $get) => $get('no_form_16') === true),

                                    TextInput::make('salary_amount')
                                        ->label('Salary Amount')
                                        ->numeric()
                                        ->visible(fn(Get $get) => $get('no_form_16') === true),
                                ]),

                                Section::make('HRA Details')
                                    ->schema([
                                        TextInput::make('hra_rent_paid')->label('Rent Paid'),
                                        TextInput::make('hra_city')->label('City of Residence'),
                                        TextInput::make('hra_landlord_name')->label('Name of Landlord'),
                                        Textarea::make('hra_property_address')->label('Address of the Property'),
                                    ])->columns(2),
                            ])
                            ->hidden(fn(Get $get) => !in_array('salary', (array) $get('data.income_types'))),

                        // HOUSE PROPERTY SECTION
                        Section::make('Income from House Property')
                            ->schema([
                                Repeater::make('rented_properties')
                                    ->label('Rented Properties')
                                    ->schema([
                                        TextInput::make('tenant_name')->label('Tenant Name'),
                                        TextInput::make('property_address')->label('Address of Property'),
                                        TextInput::make('rental_income')->label('Rental Income'),
                                        FileUpload::make('tax_receipts')->label('Receipts of House Tax / Property Tax')->multiple(),
                                        FileUpload::make('interest_certificate')->label('Interest Certificate')->multiple(),
                                        TextInput::make('ownership_percent')->label('Percentage of Ownership'),
                                        TextInput::make('months_occupied')->label('No. of Months of Occupancy'),
                                    ])
                                    ->columns(2)
                                    ->defaultItems(1)
                                    ->createItemButtonLabel('Add More Property'),

                                Section::make('Self-Occupied Property')
                                    ->schema([
                                        TextInput::make('self_address')->label('Address of Property'),
                                        FileUpload::make('self_interest_certificate')->label('Interest Certificate')->multiple(),
                                        TextInput::make('self_ownership_percent')->label('Percentage of Ownership'),
                                    ])->columns(2),
                            ])
                            ->hidden(fn(Get $get) => !in_array('house_property', (array) $get('data.income_types'))),
                        
                            //business section
                        Section::make('Income from Business & Profession')
    ->schema([
        Repeater::make('businesses')
            ->label('Business Ventures')
            ->schema([
                // Presumptive Scheme
                Section::make('Presumptive Scheme')
                    ->schema([
                        TextInput::make('presumptive_business_name')
                            ->label('Name of the Business'),
                        TextInput::make('presumptive_bank_sales')
                            ->label('Bank Sales')
                            ->numeric(),
                        TextInput::make('presumptive_cash_sales')
                            ->label('Cash Sales')
                            ->numeric(),
                    ])
                    ->columns(2),

                // Normal Business
                Section::make('Normal Business')
                    ->schema([
                        TextInput::make('normal_total_sales')
                            ->label('Total Sales')
                            ->numeric(),
                        TextInput::make('normal_total_expenses')
                            ->label('Total Expenses')
                            ->numeric(),
                        FileUpload::make('normal_bank_statement')
                            ->label('Bank Statement for Financial Year')
                            ->multiple(),
                    ])
                    ->columns(2),

                // Partnership Firm Income
                Section::make('Interest, Remuneration, Profit from Firm')
                    ->schema([
                        TextInput::make('firm_name')
                            ->label('Firm Name'),
                        TextInput::make('firm_pan')
                            ->label('Firm Pan'),
                        TextInput::make('firm_share_percent')
                            ->label('Percentage of Share')
                            ->numeric(),

                        TextInput::make('firm_remuneration')
                            ->label('Remuneration / Salary')
                            ->numeric(),
                        TextInput::make('firm_interest')
                            ->label('Interest on Capital')
                            ->numeric(),
                        TextInput::make('firm_profit_loss')
                            ->label('Profit / Loss of Firm')
                            ->numeric(),
                        TextInput::make('firm_closing_balance')
                            ->label('Closing Balance of Capital (As on 31st March)')
                            ->numeric(),
                    ])
                    ->columns(2),
            ])
            ->createItemButtonLabel('Add More Business')
            ->defaultItems(1)
            ->columns(1),
    ])
    ->hidden(fn(Get $get) => !in_array('business', (array) $get('data.income_types'))),
                        Section::make('Income from Capital Gains')
    ->schema([
        Section::make('Sale of Securities')
            ->description('Eg: Listed Securities, Zero coupon Bonds, Equity Oriented Funds, Unit of Business Trust')
            ->schema([
                FileUpload::make('demat_statement')
                    ->label('Demat Statement for the Financial Year')
                    ->multiple(),
            ])
            ->columns(1),

        Section::make('Sale of Immovable Property')
            ->schema([
                FileUpload::make('sale_deed')->label('Sale Deed')->multiple(),
                FileUpload::make('purchase_deed')->label('Purchase Deed')->multiple(),
                Textarea::make('improvement_expenses_details')->label('Details of Expenses in Improvement of Asset, if any'),
            ])
            ->columns(2),
    ])
    ->hidden(fn(Get $get) => !in_array('capital_gains', (array) $get('data.income_types'))),

// OTHER SOURCES SECTION
Section::make('Income from Other Sources')
    ->schema([
        FileUpload::make('interest_certificate')->label('Interest Certificate (Savings/FD/RD)')->multiple(),

        Textarea::make('dividend_income')->label('Dividend Income, if any'),

        Textarea::make('interest_from_others')->label('Interest from other party, if any'),

        FileUpload::make('crypto_income_statement')->label('Annual Statement from Crypto / Virtual Digital Assets')->multiple(),

        Textarea::make('other_income_details')->label('Other income not covered under above heads'),
    ])
    ->hidden(fn(Get $get) => !in_array('other_sources', (array) $get('data.income_types'))),
                    ]),
                Step::make('Deductions')
            ])->columnSpanFull(),
        ]);
    }
}

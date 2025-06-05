<?php

namespace App\Filament\User\Resources\SubmissionResource\Pages;

use App\Filament\User\Resources\SubmissionResource;
use App\Models\Person;
use App\Models\IncomeType;
use App\Models\DeductionType;
use Filament\Forms\Form;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Get;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

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
        Tabs::make('Submission Wizard')
            ->tabs([
                // BASIC DETAILS TAB
                Tab::make('Basic Details')
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
                            ]),

                        CheckboxList::make('income_types')
                            ->label('Select Income Sources')
                            ->options([
                                'salary' => 'Salary',
                                'house_property' => 'House Property',
                                'business' => 'Business',
                                'capital_gains' => 'Capital Gains',
                                'other_sources' => 'Other Sources',
                            ])
                            ->columns(1)
                            ->reactive(),

                        CheckboxList::make('deduction_types')
                            ->label('Deduction Types')
                            ->options([
                                '80C' => '80 C - Investments',
                                '80D' => '80 D - Mediclaim',
                                '80E' => '80 E - Interest on Education Loan',
                                '80G' => '80G/80GGA/80GGC - Donation',
                                'other' => 'Other Deduction Documents',
                            ])
                            ->columns(1)
                            ->reactive(),
                    ]),

                // DYNAMIC TABS BASED ON INCOME TYPES
                Tab::make('Salary')
                    ->visible(fn(Get $get) => in_array('salary', (array) $get('income_types')))
                    ->schema([
                        Toggle::make('no_form_16')->label('No Form 16')->reactive(),

                        Grid::make(3)->schema([
                            FileUpload::make('form_16')->label('Form 16')->multiple()
                                ->visible(fn(Get $get) => $get('no_form_16') === false),
                            FileUpload::make('salary_slips')->label('Salary Slips')->multiple()
                                ->visible(fn(Get $get) => $get('no_form_16') === false),
                            FileUpload::make('arrears_sheet')->label('Arrears Sheet')->multiple()
                                ->visible(fn(Get $get) => $get('no_form_16') === false),
                            TextInput::make('employer_pan')->label('Employer PAN')
                                ->visible(fn(Get $get) => $get('no_form_16') === true),
                            TextInput::make('salary_amount')->label('Salary Amount')->numeric(),
                            Textarea::make('employer_address')->label('Employer Address')
                                ->visible(fn(Get $get) => $get('no_form_16') === true),
                        ]),

                        Section::make('HRA Details')->schema([
                            TextInput::make('hra_rent_paid')->label('Rent Paid'),
                            TextInput::make('hra_city')->label('City'),
                            TextInput::make('hra_landlord_name')->label('Landlord Name'),
                            Textarea::make('hra_property_address')->label('Property Address'),
                        ])->columns(2),
                    ]),

                Tab::make('House Property')
                    ->visible(fn(Get $get) => in_array('house_property', (array) $get('income_types')))
                    ->schema([
                        Repeater::make('rented_properties')->label('Rented Properties')->schema([
                            TextInput::make('tenant_name'),
                            TextInput::make('property_address'),
                            TextInput::make('rental_income'),
                            TextInput::make('ownership_percent'),
                            TextInput::make('months_occupied'),
                            FileUpload::make('tax_receipts')->multiple(),
                            FileUpload::make('interest_certificate')->multiple(),
                        ])->columns(2),

                        Section::make('Self-Occupied Property')->schema([
                            TextInput::make('self_address'),
                            TextInput::make('self_ownership_percent'),
                            FileUpload::make('self_interest_certificate')->multiple(),
                        ])->columns(2),
                    ]),

                Tab::make('Business')
                    ->visible(fn(Get $get) => in_array('business', (array) $get('income_types')))
                    ->schema([
                        Repeater::make('businesses')->label('Business Ventures')->schema([
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
                        ])->defaultItems(1),
                    ]),

                Tab::make('Capital Gains')
                    ->visible(fn(Get $get) => in_array('capital_gains', (array) $get('income_types')))
                    ->schema([
                        Section::make('Sale of Securities')->schema([
                            FileUpload::make('demat_statement')->multiple(),
                        ]),

                        Section::make('Sale of Immovable Property')->schema([
                            FileUpload::make('sale_deed')->multiple(),
                            FileUpload::make('purchase_deed')->multiple(),
                            Textarea::make('improvement_expenses_details'),
                        ])->columns(2),
                    ]),

                Tab::make('Other Sources')
                    ->visible(fn(Get $get) => in_array('other_sources', (array) $get('income_types')))
                    ->schema([
                        Grid::make(3)->schema([
                            Textarea::make('other_income_details'),
                            Textarea::make('dividend_income'),
                            Textarea::make('interest_from_others'),
                            FileUpload::make('crypto_income_statement')->multiple(),
                            FileUpload::make('interest_certificate')->multiple(),
                        ])
                    ]),
            ])
            ->columnSpanFull()
    ]);
}


    protected function afterCreate(): void
    {
        $submission = $this->record;

        $incomeTypes = collect($this->data['income_types'] ?? []);
        $incomeTypeIds = IncomeType::whereIn('slug', $incomeTypes)->pluck('id');

        $deductionTypes = collect($this->data['deduction_types'] ?? []);
        $deductionTypeIds = DeductionType::whereIn('slug', $deductionTypes)->pluck('id');

        $submission->incomeTypes()->sync($incomeTypeIds);
        $submission->deductionTypes()->sync($deductionTypeIds);
    }
}

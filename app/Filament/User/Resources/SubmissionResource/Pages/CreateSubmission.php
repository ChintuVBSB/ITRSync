<?php

namespace App\Filament\User\Resources\SubmissionResource\Pages;

use App\Filament\User\Resources\SubmissionResource;
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
use Filament\Resources\Pages\CreateRecord;

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
            Section::make('Basic Details')
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
            ]),

        // INCOME TYPES SECTION
        Section::make('Check Income Types')
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
                    ->reactive(),

                CheckboxList::make('deduction_types')
                    ->label('Deduction Types')
                    ->options([
                        '80C' => '80 C- Investments',
                        '80D' => '80 D- Mediclaim',
                        '80E' => '80 E- Interest on Education loan',
                        '80G' => '80G/ 80GGA/ 80GGC- Donation',
                        'other' => 'Any Other Deduction Document',
                    ])
                    ->columns(1)
                    ->reactive()
            ]),
        ]);
    }

    protected function afterCreate(): void
{
    $submission = $this->record;

    $incomeTypes = collect($this->data['income_types'] ?? []);
    $incomeTypeIds = \App\Models\IncomeType::whereIn('slug', $incomeTypes)->pluck('id');

    $deductionTypes = collect($this->data['deduction_types'] ?? []);
    $deductionTypeIds = \App\Models\DeductionType::whereIn('slug', $deductionTypes)->pluck('id');

    $submission->incomeTypes()->sync($incomeTypeIds);
    $submission->deductionTypes()->sync($deductionTypeIds);
    
    }
}   
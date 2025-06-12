<?php

namespace App\Filament\User\Resources\SubmissionResource\Pages;

use App\Filament\User\Resources\SubmissionResource;
use App\Models\Person;
use App\Models\IncomeType;
use App\Models\DeductionType;
use Filament\Forms\Form;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateSubmission extends CreateRecord
{
    protected static string $resource = SubmissionResource::class;

    protected array $selectedIncomeTypes = [];
    protected array $selectedDeductionTypes = [];

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Basic Details')->schema([
                Grid::make(2)->schema([
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
                    ->label('Select Income Types')
                    ->options([
                        'salary' => 'Salary',
                        'house_property' => 'House Property',
                        'business' => 'Business',
                        'capital_gains' => 'Capital Gains',
                        'other_sources' => 'Other Sources',
                    ])
                    ->columns(1),
                    

                CheckboxList::make('deduction_types')
                    ->label('Select Deduction Types')
                    ->options([
                        '80C' => '80 C - Investments',
                        '80D' => '80 D - Mediclaim',
                        '80E' => '80 E - Interest on Education Loan',
                        '80G' => '80G/80GGA/80GGC - Donation',
                        'other' => 'Other Deduction Documents',
                    ])
                    ->columns(1),
                
                CheckboxList::make('Other_income_docs')
                    ->label('Other')
                    ->options([
                        'other' => 'Whether your gross total annual income is more than Rs. 1 cr',
                    ])
                    ->columns(1),
            ])

        ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->selectedIncomeTypes = $data['income_types'] ?? [];
        $this->selectedDeductionTypes = $data['deduction_types'] ?? [];

        unset($data['income_types'], $data['deduction_types']);
        $data['user_id'] = Auth::id();
        $data['estimated_income'] = $data['estimated_income'] ?? null;

        return $data;
    }

    protected function afterCreate(): void
    {
        $submission = $this->record;

        $incomeTypeIds = IncomeType::whereIn('slug', $this->selectedIncomeTypes)->pluck('id');
        $deductionTypeIds = DeductionType::whereIn('slug', $this->selectedDeductionTypes)->pluck('id');

        $submission->incomeTypes()->sync($incomeTypeIds);
        $submission->deductionTypes()->sync($deductionTypeIds);

        $this->redirect(route('submission.details', ['submissionId' => $submission->id]));
    }

    protected function getRedirectUrl(): string
    {
        return route('submission.details', ['submissionId' => $this->record->id]);
    }
}

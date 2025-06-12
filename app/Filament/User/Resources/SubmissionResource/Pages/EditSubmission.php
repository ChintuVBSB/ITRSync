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
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditSubmission extends EditRecord
{
    protected static string $resource = SubmissionResource::class;

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
                    ->label('Select Income Sources')
                    ->options([
                        'salary' => 'Salary',
                        'house_property' => 'House Property',
                        'business' => 'Business',
                        'capital_gains' => 'Capital Gains',
                        'other_sources' => 'Other Sources',
                    ])
                    ->columns(1),

                CheckboxList::make('deduction_types')
                    ->label('Deduction Types')
                    ->options([
                        '80C' => '80 C - Investments',
                        '80D' => '80 D - Mediclaim',
                        '80E' => '80 E - Interest on Education Loan',
                        '80G' => '80G/80GGA/80GGC - Donation',
                        'other' => 'Other Deduction Documents',
                    ])
                    ->columns(1),
            ]),
        ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['income_types'] = $this->record->incomeTypes()->pluck('slug')->toArray();
        $data['deduction_types'] = $this->record->deductionTypes()->pluck('slug')->toArray();
        return $data;
    }

    protected function afterSave(): void
    {
        $submission = $this->record;

        $incomeTypes = collect($this->data['income_types'] ?? []);
        $incomeTypeIds = IncomeType::whereIn('slug', $incomeTypes)->pluck('id');

        $deductionTypes = collect($this->data['deduction_types'] ?? []);
        $deductionTypeIds = DeductionType::whereIn('slug', $deductionTypes)->pluck('id');

        $submission->incomeTypes()->sync($incomeTypeIds);
        $submission->deductionTypes()->sync($deductionTypeIds);
    }
    protected function getRedirectUrl(): string
    {
        return route('submission.details', ['submissionId' => $this->record->id]);
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}

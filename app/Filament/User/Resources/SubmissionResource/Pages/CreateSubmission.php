<?php

namespace App\Filament\User\Resources\SubmissionResource\Pages;

use App\Filament\User\Resources\SubmissionResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;
use App\Models\Person;
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
                        Select::make('year')
                            ->label('Financial Year')
                            ->required()
                            ->options([
                                '2020-2021' => 'FY 2020-2021',
                                '2021-2022' => 'FY 2021-2022',
                                '2022-2023' => 'FY 2022-2023',
                                '2023-2024' => 'FY 2023-2024',
                                '2024-2025' => 'FY 2024-2025',
                            ]),
                        Select::make('person_id')
                            ->label('Select Person')
                            ->options(
                                Person::where('user_id', Auth::id())
                                ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->required(),
                    ]),
            ]),
        ]);
    }
}

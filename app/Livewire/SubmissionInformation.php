<?php

namespace App\Livewire;

use App\Models\Submission;
use Livewire\Component;
use Filament\Forms\Components\Accordion;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
class SubmissionInformation extends Component
{

    public $id;
    public Submission $submission;

    public function mount($id)
    {
        $this->id = $id;
        $this->submission = Submission::findOrFail($id);
        $this->form->fill($this->submission->toArray());
    }

    public function render()
    {
        return view('livewire.submission-information', [
            'form' => $this->form,
        ]);
    }

    
}

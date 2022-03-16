<?php

namespace App\Http\Livewire\Forms;

use App\Models\Document;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;

class EditDocument extends Component implements HasForms
{
    use InteractsWithForms;
    
    public $document_id;

    public function mount(): void
    {
        $this->form->fill([
            'name' => $this->document->name,
            'content' => $this->document->content,
            'type' => $this->document->type,
            'published_on' => $this->document->published_on,
        ]);
    }

    public function getDocumentProperty():Document
    {
        return Document::findOrFail($this->document_id);
    }

    protected function getFormSchema(): array 
    {
        return [
            TextInput::make('name')->required()->label('Name of Document'),
            MarkdownEditor::make('content')->label('Content'),
            Select::make('type')->reactive()->options(['ebook' => 'E-Book','paper' => 'Traditional Paper'])->label('Type'),
            DatePicker::make('published_on')->label('Day of publishing'),

            // ...
        ];
    } 
    

    public function submit(){
        
    }

    public function render():View
    {
        return view('livewire.forms.edit-document');
    }

    
    protected function getFormStatePath(): string
    {
        return 'data';
    }
}

<?php

namespace App\Livewire;

use Filament\Forms;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Password;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class CustomProfileUpdate extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $record;

    public function __construct()
    {
        $this->record = Auth::user();
    }


    // public function routes()
    // {
    //     return [
    //         Route::get('/profile/update', $this->name('edit'))->name('profile.update'),
    //     ];
    // }

    public function getUrl(): string
    {
        return route('profile.update');
    }
    public function mount(): void
    {
        if (!isset($this->record)) {
            $this->record = Auth::user();
        }
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name'),

            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function edit(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.custom-profile-update');
    }
}

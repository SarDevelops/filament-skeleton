<?php

namespace App\Filament\Pages;

use Filament\Forms;
use App\Models\Role;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $record;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.edit-profile';

    public function mount(): void
    {
        $this->form->fill(auth()->user()->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\Card::make()
                    ->columnSpan(2)
                    ->columns(2)
                    ->schema([
                        Section::make()
                            ->columns([
                                'sm' => 2,
                            ])
                            ->schema([

                                TextInput::make('first_name')
                                    ->live()
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('name', Str::slug($state)))->required(),
                                TextInput::make('last_name'),
                                TextInput::make('email')->email()->required(),
                                Select::make('role')
                                    ->label('Select Role')
                                    ->options(Role::all()->pluck('role_name', 'id'))
                                    ->searchable()->required(),
                                TextInput::make('name')->required(),
                            ]),
                        FileUpload::make('profile')->image()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')->required(),
                    ]),
                // Forms\Components\Card::make()
                //     ->columnSpan(2)
                //     ->columns(2)
                //     ->schema([
                //         Section::make('Reset Password')
                //             ->schema([
                //                 TextInput::make('password')
                //                     ->password()
                //                     ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                //                     ->confirmed(),
                //                 TextInput::make('password_confirmation')

                //             ]),

                //     ]),

            ])
            ->statePath('data');

    }

    // public function edit(): void
    // {
    //     $data = $this->form->getState();

    //     $this->record->update($data);
    // }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('Save Change'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();
            auth()->user()->update($data);
        } catch (Halt $exception) {
            return;
        }
        Notification::make()
            ->success()
            ->title(__('Profile Update success fully'))
            ->send();
    }

}

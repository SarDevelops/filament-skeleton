<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Rawilk\FilamentPasswordInput\Password;
use App\Filament\PasswordAction;
use Filament\Forms\Concerns\InteractsWithForms;

class ChangePassword extends Page implements HasForms
{

    use InteractsWithForms;

    public ?array $data = [];

    public $record;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.change-password';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                ->columns(1)
                ->columnSpan(1)
                    ->schema([
                        Section::make()
                            ->schema([
                                Password::make('password')
                                    ->label('New Password')
                                    ->regeneratePassword(),
                            ])->columns(2),
                            // PasswordAction::make('secure_action')->action('enableTwoFactor')->icon('heroicon-s-shield-check')

                    // Forms\Components\TextInput::make("current_password")
                    //     ->required()
                    //     ->password()
                    //     ->rule("current_password"),
                    ]),

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
            ->title(__('Password Update successfully'))
            ->send();
    }

}

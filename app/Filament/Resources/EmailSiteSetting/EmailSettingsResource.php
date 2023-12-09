<?php

namespace App\Filament\Resources\EmailSiteSetting;

use Filament\Forms;
use Filament\Tables;
use App\Models\Setting;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use App\Models\EmailSiteSetting\EmailSettings;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmailSiteSetting\EmailSettingsResource\Pages;
use App\Filament\Resources\EmailSiteSetting\EmailSettingsResource\RelationManagers;

class EmailSettingsResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Email Settings';

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('slug', 'email-setting');
    }

    public static function form(Form $form): Form
    {
        $user_id = auth()->user()->id;
        $data['form'] = $form->schema([
                Forms\Components\Grid::make(3)
                ->schema([
                    Forms\Components\Card::make()
                        ->columnSpan(2)
                        ->columns(2)
                        ->schema([
                            Section::make('Email Settings')
                                ->schema([
                                    Forms\Components\TextInput::make('user_id')
                                    ->label('User ID')
                                    ->default($user_id)->readonly(),
                                    Forms\Components\TextInput::make('name')
                                        ->helperText(new HtmlString('Enter template <strong> Title</strong>'))
                                        ->placeholder('Enter mail Title')->rules('required')
                                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                        ->reactive()
                                        ->required(),
                                    Forms\Components\TextInput::make('slug')
                                        ->required()->readonly(),
                                    Section::make('value')
                                        ->label('Site Settings')
                                        ->statePath('value')
                                        ->schema([
                                            Forms\Components\TextInput::make('smtp-host')
                                                ->label('SMTP Host')
                                                ->required(),
                                            Forms\Components\TextInput::make('smtp-port')
                                                ->label('SMTP Port')
                                                ->required(),
                                            Select::make('smtp-encryption')
                                                ->label('SMTP Encryption')
                                                ->options([
                                                    'ssl' => 'SSL',
                                                    'tls' => 'TLS',
                                                ]),
                                            Forms\Components\TextInput::make('smtp-user')
                                                ->label('SMTP User')
                                                ->required(),
                                            Forms\Components\TextInput::make('smtp-password')
                                                ->label('SMTP Password')
                                                ->required(),
                                            Forms\Components\TextInput::make('from-name')
                                                ->label('From Name')
                                                ->required(),
                                            Forms\Components\TextInput::make('reply-to-email')
                                            ->label('Reply to Email')
                                            ->required(),
                                            Forms\Components\TextInput::make('email-signature')
                                            ->label('Email Signature')
                                            ->required(),
                                        ]),
                                ]),
                        ]),
                ]),
            ]);
        return $data['form'];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                        ->searchable()
                        ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                ])->icon('heroicon-m-ellipsis-horizontal')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmailSettings::route('/'),
            'create' => Pages\CreateEmailSettings::route('/create'),
            'view' => Pages\ViewEmailSettings::route('/{record}'),
            'edit' => Pages\EditEmailSettings::route('/{record}/edit'),
        ];
    }
}

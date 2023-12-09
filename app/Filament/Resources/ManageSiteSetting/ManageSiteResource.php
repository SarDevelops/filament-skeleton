<?php

namespace App\Filament\Resources\ManageSiteSetting;

use Filament\Forms;
use Filament\Tables;
use App\Models\Setting;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ManageSiteSetting\ManageSiteResource\Pages;
use App\Filament\Resources\ManageSiteSetting\ManageSiteResource\RelationManagers;

class ManageSiteResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'General Settings';

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('slug', 'general-setting');
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
                            Section::make('General Settings')
                            ->description('Prevent abuse by limiting the number of requests per period')
                                ->schema([

                                    Forms\Components\TextInput::make('user_id')
                                    ->label('User name')
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
                                        ->description('Prevent abuse by limiting the number of requests per period')
                                        ->schema([
                                            Forms\Components\FileUpload::make('site-logo')->image()
                                                    ->label('Site Logo')
                                                    ->imageResizeMode('cover')
                                                    ->imageCropAspectRatio('16:9')
                                                    ->imageResizeTargetWidth('1920')
                                                    ->imageResizeTargetHeight('1080')->required(),
                                            Forms\Components\TextInput::make('site-name')
                                                ->label('Site Name')
                                                ->required(),
                                            Forms\Components\TextInput::make('site-email')
                                                ->label('Site Email')
                                                ->required(),
                                            Forms\Components\TextInput::make('site-contact')
                                                ->label('Site contact')
                                                ->required(),
                                            Forms\Components\TextInput::make('site-address')
                                                ->label('Site Address')
                                                ->required(),
                                            Forms\Components\TextInput::make('admin-name')
                                                ->label('Admin Name')
                                                ->required(),
                                            Forms\Components\TextInput::make('admin-email')
                                                ->label('Admin Email')
                                                ->required(),
                                            Forms\Components\TextInput::make('admin-contact')
                                            ->label('Admin Contact')
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
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                    ]),
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
            'index' => Pages\ListManageSites::route('/'),
            'create' => Pages\CreateManageSite::route('/create'),
            'view' => Pages\ViewManageSite::route('/{record}'),
            'edit' => Pages\EditManageSite::route('/{record}/edit'),
        ];
    }
}

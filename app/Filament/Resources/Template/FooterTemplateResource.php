<?php

namespace App\Filament\Resources\Template;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\EmailTemplate;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use App\Models\Template\FooterTemplate;
use Filament\Forms\Components\KeyValue;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Template\FooterTemplateResource\Pages;
use App\Filament\Resources\Template\FooterTemplateResource\RelationManagers;

class FooterTemplateResource extends Resource
{
    protected static ?string $model = EmailTemplate::class;

    protected static ?string $navigationGroup = 'Templates';

    protected static ?string $navigationLabel = 'Footer Template';

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('slug','email-footer');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            //     TextInput::make('name')
            //     ->helperText(new HtmlString('Enter template <strong> Title</strong>'))
            //     ->placeholder('Enter mail Title')->rules('required')
            //     ->live()
            //     ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
            //     ->reactive()
            //     ->required(),

            // TextInput::make('slug')
            //     ->required()->readonly(),

            // TextInput::make('subject')
            //     ->helperText(new HtmlString('Enter mail Subject <strong>Subject</strong>'))
            //     ->placeholder('Enter mail Subject'),

            KeyValue::make('placeholders')
                ->addActionLabel('Add Placeholder Name')
                ->keyLabel('refer_name')
                ->keyPlaceholder('{placeholder slug}')
                ->valueLabel('name')
                ->valuePlaceholder('placeholder name')
                ->rules('required')->required(),

            RichEditor::make('message')->rules('required')->required()
                ->toolbarButtons([
                    'attachFiles',
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
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
            'index' => Pages\ListFooterTemplates::route('/'),
            'create' => Pages\CreateFooterTemplate::route('/create'),
            'view' => Pages\ViewFooterTemplate::route('/{record}'),
            'edit' => Pages\EditFooterTemplate::route('/{record}/edit'),
        ];
    }
    public static function canCreate(): bool
    {
       return false;
    }
}

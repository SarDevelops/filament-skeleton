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
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\KeyValue;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\Template\EmailTemplateResource\Pages;

class EmailTemplateResource extends Resource
{
    protected static ?string $model = EmailTemplate::class;

    protected static ?string $navigationGroup = 'Templates';

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('slug', '!=', 'email-header')->where('slug', '!=', 'email-footer');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Card::make()
                            ->columnSpan(2)
                            ->columns(1)
                            ->schema([
                                TextInput::make('name')
                                    ->helperText(new HtmlString('Enter template <strong> Title</strong>'))
                                    ->placeholder('Enter mail Title')->rules('required')
                                    ->live()
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->reactive()
                                    ->required(),

                                TextInput::make('slug')
                                    ->required()->readonly(),

                                TextInput::make('subject')
                                    ->helperText(new HtmlString('Enter mail Subject <strong>Subject</strong>'))
                                    ->placeholder('Enter mail Subject')->rules('required')->required(),
                                MarkdownEditor::make('message')->rules('required')->required()
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'heading',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'table',
                                        'undo',
                                    ]),
                            ]),

                        Forms\Components\Grid::make(1)
                            ->columns(1)
                            ->columnSpan(1)
                            ->schema([
                                KeyValue::make('placeholders')
                                    ->addActionLabel('Add Placeholder Name')
                                    ->keyLabel('refer_name')
                                    ->keyPlaceholder('{placeholder slug}')
                                    ->valueLabel('name')
                                    ->valuePlaceholder('placeholder name')
                                    ->rules('required')->required(),
                            ]),
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
                Action::make('Test Mail')
                    ->form([
                        TextInput::make('mail_id')
                            ->label('Enter test mail')
                            ->required(),
                    ])
                    ->fillForm(fn(EmailTemplate $record): array=> [
                        'email' => $record->mail,
                    ])
                    ->action(function (array $data, EmailTemplate $record): void {
                        try {
                            $emails = $data['mail_id'];
                            $templateHeaderName = 'email-header';
                            $templateFooterName = 'email-footer';
                            $mail_body_template = $record;
                            $mail_header_template = EmailTemplate::where('slug', $templateHeaderName)->first();
                            $mail_footer_template = EmailTemplate::where('slug', $templateFooterName)->first();
                            $placeholders = ['{title}', '{description}'];
                            $replace = [$record->placeholders['{title}'], $record->placeholders['{description}']];
                            $mail_body = str_replace(
                                $placeholders,
                                $replace,
                                $mail_body_template->message
                            );
                            $data = [
                                'user_email' => $emails,
                                'mail_subject' => $mail_body_template->subject,
                                'mail_body' => $mail_header_template->message . $mail_body . $mail_footer_template->message,
                            ];
                            Mail::send([], [], function ($message) use ($data) {
                                $message->to($data['user_email'])
                                    ->subject($data['mail_subject'])
                                    ->from($data['user_email'])
                                    ->html($data['mail_body']);
                            });

                            Notification::make()
                                ->title('Mail send successfully')
                                ->success()
                                ->send();
                        } catch (\Throwable $th) {
                            Notification::make()
                            ->title('something want to wrong')
                            ->danger()
                            ->send();
                        }
                    })->icon('heroicon-o-envelope-open')
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
            'index' => Pages\ListEmailTemplates::route('/'),
            'create' => Pages\CreateEmailTemplate::route('/create'),
            'view' => Pages\ViewEmailTemplate::route('/{record}'),
            'edit' => Pages\EditEmailTemplate::route('/{record}/edit'),
        ];
    }

}

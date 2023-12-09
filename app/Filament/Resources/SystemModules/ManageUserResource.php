<?php

namespace App\Filament\Resources\SystemModules;

use App\Filament\Resources\SystemModules\ManageUserResource\Pages;
use App\Models\Role;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Rawilk\FilamentPasswordInput\Password;

class ManageUserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'System Module';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->live()
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('name', Str::slug($state)))->required(),
                TextInput::make('last_name')->required(),
                TextInput::make('email')->email()->required(),
                Select::make('role')
                    ->label('Select Role')
                    ->options(Role::all()->pluck('role_name', 'id'))
                    ->searchable()->required(),
                Password::make('password')
                    ->label('Password')
                    ->required()
                    ->inlineSuffix()
                    ->copyable()
                    ->copyIconColor('warning')
                    ->regeneratePasswordIconColor('primary')->hiddenOn('edit'),
                // TextInput::make('confirm password')->label('Confirm Password')
                //     ->password()
                //     ->required()
                //     ->confirmed()->hiddenOn('edit'),
                TextInput::make('name')->required(),
                FileUpload::make('profile')->image()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $role_name_closure = function (User $user) {
            return $user->roles->role_name;
        };
        return $table
            ->columns([
                ImageColumn::make('profile')->circular(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('roles.role_name'),
            ])
            ->filters([

            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])->icon('heroicon-m-ellipsis-horizontal'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(),
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
            'index' => Pages\ListManageUsers::route('/'),
            'create' => Pages\CreateManageUser::route('/create'),
            'view' => Pages\ViewManageUser::route('/{record}'),
            'edit' => Pages\EditManageUser::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }
}

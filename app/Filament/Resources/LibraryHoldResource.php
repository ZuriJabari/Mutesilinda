<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LibraryHoldResource\Pages;
use App\Models\LibraryHold;
use App\Notifications\LibraryHoldAvailable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Schema;

class LibraryHoldResource extends Resource
{
    protected static ?string $model = LibraryHold::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Library';

    protected static ?int $navigationSort = 4;

    public static function canViewAny(): bool
    {
        return Schema::hasTable('library_holds');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hold')
                    ->schema([
                        Forms\Components\Select::make('book_id')
                            ->relationship('book', 'title')
                            ->searchable()
                            ->preload()
                            ->disabled(),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'email')
                            ->searchable()
                            ->preload()
                            ->disabled(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'notified' => 'Notified',
                                'fulfilled' => 'Fulfilled',
                                'canceled' => 'Canceled',
                            ])
                            ->required(),
                        Forms\Components\DateTimePicker::make('notified_at')
                            ->seconds(false),
                        Forms\Components\DateTimePicker::make('expires_at')
                            ->seconds(false),
                        Forms\Components\DateTimePicker::make('fulfilled_at')
                            ->seconds(false),
                        Forms\Components\DateTimePicker::make('canceled_at')
                            ->seconds(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('book.title')
                    ->label('Book')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('User')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'warning',
                        'notified' => 'primary',
                        'fulfilled' => 'success',
                        'canceled' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Joined')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('notify')
                    ->label('Notify')
                    ->icon('heroicon-o-bell')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->visible(fn (LibraryHold $record) => $record->status === 'active')
                    ->action(function (LibraryHold $record) {
                        $record->status = 'notified';
                        $record->notified_at = now();
                        $record->expires_at = now()->addHours(48);
                        $record->save();

                        $record->user->notify(new LibraryHoldAvailable($record));
                    }),
                Tables\Actions\Action::make('fulfill')
                    ->label('Fulfill')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (LibraryHold $record) => in_array($record->status, ['active', 'notified'], true))
                    ->action(function (LibraryHold $record) {
                        $record->status = 'fulfilled';
                        $record->fulfilled_at = now();
                        $record->save();
                    }),
                Tables\Actions\Action::make('cancel')
                    ->label('Cancel')
                    ->icon('heroicon-o-x-mark')
                    ->color('gray')
                    ->requiresConfirmation()
                    ->visible(fn (LibraryHold $record) => in_array($record->status, ['active', 'notified'], true))
                    ->action(function (LibraryHold $record) {
                        $record->status = 'canceled';
                        $record->canceled_at = now();
                        $record->save();
                    }),
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLibraryHolds::route('/'),
            'edit' => Pages\EditLibraryHold::route('/{record}/edit'),
        ];
    }
}

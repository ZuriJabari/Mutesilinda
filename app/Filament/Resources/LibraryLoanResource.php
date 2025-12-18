<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LibraryLoanResource\Pages;
use App\Models\LibraryHold;
use App\Models\LibraryLoan;
use App\Notifications\LibraryHoldAvailable;
use App\Notifications\LibraryLoanApproved;
use App\Notifications\LibraryLoanCheckedOut;
use App\Notifications\LibraryLoanRejected;
use App\Notifications\LibraryLoanReturned;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Schema;

class LibraryLoanResource extends Resource
{
    protected static ?string $model = LibraryLoan::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Library';

    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool
    {
        return Schema::hasTable('library_loans');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Loan')
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
                                'requested' => 'Requested',
                                'approved' => 'Approved',
                                'checked_out' => 'Checked out',
                                'returned' => 'Returned',
                                'rejected' => 'Rejected',
                                'canceled' => 'Canceled',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('user_note')
                            ->label('User note')
                            ->rows(3)
                            ->disabled()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('admin_note')
                            ->label('Admin note')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Timeline')
                    ->schema([
                        Forms\Components\DateTimePicker::make('requested_at')
                            ->seconds(false)
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('approved_at')
                            ->seconds(false)
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('checked_out_at')
                            ->seconds(false)
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('due_at')
                            ->label('Due date')
                            ->seconds(false),
                        Forms\Components\DateTimePicker::make('returned_at')
                            ->seconds(false)
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('rejected_at')
                            ->seconds(false)
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('canceled_at')
                            ->seconds(false)
                            ->disabled(),
                    ])
                    ->columns(3),
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
                    ->label('Borrower')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'requested' => 'warning',
                        'approved' => 'primary',
                        'checked_out' => 'info',
                        'returned' => 'success',
                        'rejected' => 'danger',
                        'canceled' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('requested_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('due_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('returned_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->visible(fn (LibraryLoan $record) => $record->status === 'requested')
                    ->action(function (LibraryLoan $record) {
                        $record->status = 'approved';
                        $record->approved_at = now();
                        $record->rejected_at = null;
                        $record->canceled_at = null;
                        $record->save();

                        $record->user->notify(new LibraryLoanApproved($record));
                    }),
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (LibraryLoan $record) => in_array($record->status, ['requested', 'approved'], true))
                    ->action(function (LibraryLoan $record) {
                        $record->status = 'rejected';
                        $record->rejected_at = now();
                        $record->approved_at = null;
                        $record->checked_out_at = null;
                        $record->due_at = null;
                        $record->returned_at = null;
                        $record->save();

                        $record->user->notify(new LibraryLoanRejected($record));
                    }),
                Tables\Actions\Action::make('check_out')
                    ->label('Check out')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('info')
                    ->requiresConfirmation()
                    ->visible(fn (LibraryLoan $record) => $record->status === 'approved')
                    ->action(function (LibraryLoan $record) {
                        $record->status = 'checked_out';
                        $record->checked_out_at = now();
                        if (!$record->due_at) {
                            $record->due_at = now()->addDays(14);
                        }
                        $record->save();

                        $record->user->notify(new LibraryLoanCheckedOut($record));
                    }),
                Tables\Actions\Action::make('mark_returned')
                    ->label('Mark returned')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (LibraryLoan $record) => $record->status === 'checked_out')
                    ->action(function (LibraryLoan $record) {
                        $record->status = 'returned';
                        $record->returned_at = now();
                        $record->save();

                        $record->user->notify(new LibraryLoanReturned($record));

                        $nextHold = LibraryHold::query()
                            ->where('book_id', $record->book_id)
                            ->where('status', 'active')
                            ->orderBy('created_at')
                            ->first();

                        if ($nextHold) {
                            $nextHold->status = 'notified';
                            $nextHold->notified_at = now();
                            $nextHold->expires_at = now()->addHours(48);
                            $nextHold->save();

                            $nextHold->user->notify(new LibraryHoldAvailable($nextHold));
                        }
                    }),
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLibraryLoans::route('/'),
            'edit' => Pages\EditLibraryLoan::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PodcastResource\Pages;
use App\Models\Podcast;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PodcastResource extends Resource
{
    protected static ?string $model = Podcast::class;

    protected static ?string $navigationIcon = 'heroicon-o-microphone';

    protected static ?string $navigationGroup = 'Library';

    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        return Schema::hasTable('podcasts');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Podcast')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state)))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('show_name')
                            ->label('Show name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('external_url')
                            ->label('External URL')
                            ->url()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('embed_html')
                            ->label('Embed HTML')
                            ->helperText('Paste the embed code (iframe/oEmbed) from Spotify/Apple/YouTube. It will be rendered on the public library page.')
                            ->rows(6)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Publishing')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                        Forms\Components\Toggle::make('is_featured')
                            ->default(false)
                            ->required(),
                        Forms\Components\DateTimePicker::make('listened_at')
                            ->label('Listened date')
                            ->seconds(false),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('show_name')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('listened_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPodcasts::route('/'),
            'create' => Pages\CreatePodcast::route('/create'),
            'edit' => Pages\EditPodcast::route('/{record}/edit'),
        ];
    }
}

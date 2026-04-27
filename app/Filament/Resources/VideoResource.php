<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;
    protected static ?string $navigationIcon  = 'heroicon-o-video-camera';
    protected static ?string $navigationLabel = 'Видео';
    protected static ?string $modelLabel      = 'Видео';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?int    $navigationSort  = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Название')->required()->columnSpanFull(),
            Forms\Components\TextInput::make('youtube_id')
                ->label('YouTube ID (например: dQw4w9WgXcQ)')->required(),
            Forms\Components\TextInput::make('sort')
                ->label('Сортировка')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')
                ->label('Активно')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('sort')->label('№')->sortable(),
            Tables\Columns\TextColumn::make('title')->label('Название')->searchable()->limit(50),
            Tables\Columns\TextColumn::make('youtube_id')->label('YouTube ID'),
            Tables\Columns\IconColumn::make('is_active')->label('Активно')->boolean(),
        ])->defaultSort('sort')->reorderable('sort');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit'   => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}

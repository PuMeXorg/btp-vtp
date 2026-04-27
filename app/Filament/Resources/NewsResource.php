<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;
    protected static ?string $navigationIcon  = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Новости';
    protected static ?string $modelLabel      = 'Новость';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?int    $navigationSort  = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Заголовок')->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn(Set $set, ?string $state) =>
                    $set('slug', Str::slug($state ?? ''))
                ),
            Forms\Components\TextInput::make('slug')
                ->label('URL (slug)')->required()->unique(ignoreRecord: true),
            Forms\Components\FileUpload::make('image')
                ->label('Изображение')->image()->directory('news'),
            Forms\Components\Textarea::make('excerpt')
                ->label('Краткое описание')->rows(2)->columnSpanFull(),
            Forms\Components\RichEditor::make('content')
                ->label('Содержимое')->columnSpanFull(),
            Forms\Components\TextInput::make('meta_title')->label('SEO Title'),
            Forms\Components\Textarea::make('meta_description')
                ->label('SEO Description')->rows(2),
            Forms\Components\DateTimePicker::make('published_at')
                ->label('Дата публикации')->default(now()),
            Forms\Components\Toggle::make('is_active')
                ->label('Опубликовано')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')->label('Фото'),
            Tables\Columns\TextColumn::make('title')->label('Заголовок')->searchable()->limit(50),
            Tables\Columns\TextColumn::make('published_at')->label('Дата')->date('d.m.Y')->sortable(),
            Tables\Columns\IconColumn::make('is_active')->label('Опубликовано')->boolean(),
        ])->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit'   => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}

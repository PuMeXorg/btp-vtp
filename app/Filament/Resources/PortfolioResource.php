<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;
    protected static ?string $navigationIcon  = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Портфолио';
    protected static ?string $modelLabel      = 'Проект';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?int    $navigationSort  = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Название')->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn(Set $set, ?string $state) =>
                    $set('slug', Str::slug($state ?? ''))
                ),
            Forms\Components\TextInput::make('slug')
                ->label('URL (slug)')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('category')
                ->label('Категория'),
            Forms\Components\FileUpload::make('image')
                ->label('Изображение')->image()->directory('portfolio'),
            Forms\Components\Textarea::make('excerpt')
                ->label('Краткое описание')->rows(2)->columnSpanFull(),
            Forms\Components\RichEditor::make('content')
                ->label('Содержимое')->columnSpanFull(),
            Forms\Components\TextInput::make('sort')
                ->label('Сортировка')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')
                ->label('Активен')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('sort')->label('№')->sortable(),
            Tables\Columns\ImageColumn::make('image')->label('Фото'),
            Tables\Columns\TextColumn::make('title')->label('Название')->searchable()->limit(40),
            Tables\Columns\TextColumn::make('category')->label('Категория'),
            Tables\Columns\IconColumn::make('is_active')->label('Активен')->boolean(),
        ])->defaultSort('sort')->reorderable('sort');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit'   => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}

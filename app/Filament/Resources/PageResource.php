<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon  = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Страницы и услуги';
    protected static ?string $modelLabel      = 'Страница';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')
                ->label('Тип')->options([
                    'page'    => 'Страница',
                    'service' => 'Услуга',
                    'catalog' => 'Каталог',
                ])->required()->default('page'),

            Forms\Components\Select::make('parent_id')
                ->label('Родительская страница')
                ->relationship('parent', 'title')
                ->searchable()->nullable(),

            Forms\Components\TextInput::make('title')
                ->label('Заголовок')->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn(Set $set, ?string $state) =>
                    $set('slug', Str::slug($state ?? ''))
                ),

            Forms\Components\TextInput::make('slug')
                ->label('URL (slug)')->required()->unique(ignoreRecord: true),

            Forms\Components\FileUpload::make('image')
                ->label('Изображение')->image()->directory('pages'),

            Forms\Components\Textarea::make('excerpt')
                ->label('Краткое описание')->rows(2)->columnSpanFull(),

            Forms\Components\RichEditor::make('content')
                ->label('Содержимое')->columnSpanFull(),

            Forms\Components\TextInput::make('meta_title')
                ->label('SEO Title'),
            Forms\Components\Textarea::make('meta_description')
                ->label('SEO Description')->rows(2),

            Forms\Components\TextInput::make('sort')
                ->label('Сортировка')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')
                ->label('Активна')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('sort')->label('№')->sortable(),
            Tables\Columns\ImageColumn::make('image')->label('Фото'),
            Tables\Columns\TextColumn::make('title')->label('Заголовок')->searchable()->limit(40),
            Tables\Columns\BadgeColumn::make('type')->label('Тип'),
            Tables\Columns\TextColumn::make('parent.title')->label('Родитель'),
            Tables\Columns\IconColumn::make('is_active')->label('Активна')->boolean(),
        ])->defaultSort('sort')->reorderable('sort')
        ->filters([
            Tables\Filters\SelectFilter::make('type')->options([
                'page'    => 'Страницы',
                'service' => 'Услуги',
                'catalog' => 'Каталог',
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit'   => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}

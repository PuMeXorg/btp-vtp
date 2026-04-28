<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomepageBlockResource\Pages;
use App\Models\HomepageBlock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HomepageBlockResource extends Resource
{
    protected static ?string $model = HomepageBlock::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';
    protected static ?string $navigationLabel = 'Конструктор главной';
    protected static ?string $modelLabel = 'Блок главной';
    protected static ?string $pluralModelLabel = 'Блоки главной';
    protected static ?string $navigationGroup = 'Главная страница';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Основное')
                ->schema([
                    Forms\Components\Select::make('type')
                        ->label('Тип блока')
                        ->options([
                            'hero' => 'Hero / Первый экран',
                            'advantages' => 'Преимущества',
                            'services' => 'Услуги',
                            'process' => 'Как мы работаем',
                            'cta' => 'Форма / CTA',
                            'portfolio' => 'Портфолио',
                            'html' => 'HTML-блок',
                        ])
                        ->required()
                        ->default('hero'),

                    Forms\Components\TextInput::make('title')
                        ->label('Заголовок')
                        ->maxLength(255),

                    Forms\Components\Textarea::make('subtitle')
                        ->label('Подзаголовок')
                        ->rows(3)
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('content')
                        ->label('Контент')
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('image')
                        ->label('Изображение')
                        ->image()
                        ->directory('homepage')
                        ->disk('public')
                        ->visibility('public'),

                    Forms\Components\TextInput::make('button_text')
                        ->label('Текст кнопки'),

                    Forms\Components\TextInput::make('button_url')
                        ->label('Ссылка кнопки')
                        ->placeholder('/kontakty или https://...'),

                    Forms\Components\TextInput::make('sort')
                        ->label('Порядок')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Показывать блок')
                        ->default(true),
                ])
                ->columns(2),

            Forms\Components\Section::make('HTML / настройки')
                ->description('Можно вставить HTML-код для кастомного блока.')
                ->schema([
                    Forms\Components\Textarea::make('settings.custom_html')
                        ->label('HTML-код')
                        ->rows(10)
                        ->columnSpanFull(),
                ])
                ->collapsed(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort')
                    ->label('Порядок')
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'hero' => 'Hero',
                        'advantages' => 'Преимущества',
                        'services' => 'Услуги',
                        'process' => 'Процесс',
                        'cta' => 'CTA',
                        'portfolio' => 'Портфолио',
                        'html' => 'HTML',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Фото'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),
            ])
            ->defaultSort('sort')
            ->reorderable('sort');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomepageBlocks::route('/'),
            'create' => Pages\CreateHomepageBlock::route('/create'),
            'edit' => Pages\EditHomepageBlock::route('/{record}/edit'),
        ];
    }
}

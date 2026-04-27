<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegionResource\Pages;
use App\Models\Region;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;
    protected static ?string $navigationIcon  = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Регионы';
    protected static ?string $modelLabel      = 'Регион';
    protected static ?string $navigationGroup = 'Настройки';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Название')->required(),
            Forms\Components\TextInput::make('slug')
                ->label('Slug (URL)')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('phone')
                ->label('Телефон (для ссылки)'),
            Forms\Components\TextInput::make('phone_display')
                ->label('Телефон (отображаемый)'),
            Forms\Components\TextInput::make('email')
                ->label('Email')->email(),
            Forms\Components\TextInput::make('address')
                ->label('Адрес')->columnSpanFull(),
            Forms\Components\TextInput::make('working_hours')
                ->label('Время работы'),
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
            Tables\Columns\TextColumn::make('name')->label('Регион')->searchable(),
            Tables\Columns\TextColumn::make('phone_display')->label('Телефон'),
            Tables\Columns\TextColumn::make('email')->label('Email'),
            Tables\Columns\IconColumn::make('is_active')->label('Активен')->boolean(),
        ])->defaultSort('sort')->reorderable('sort');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRegions::route('/'),
            'create' => Pages\CreateRegion::route('/create'),
            'edit'   => Pages\EditRegion::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;
    protected static ?string $navigationIcon  = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Заявки';
    protected static ?string $modelLabel      = 'Заявка';
    protected static ?string $navigationGroup = 'CRM';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Имя'),
            Forms\Components\TextInput::make('phone')->label('Телефон'),
            Forms\Components\TextInput::make('email')->label('Email'),
            Forms\Components\TextInput::make('region')->label('Регион'),
            Forms\Components\Textarea::make('comment')
                ->label('Комментарий')->columnSpanFull(),
            Forms\Components\TextInput::make('source_url')
                ->label('Страница')->columnSpanFull(),
            Forms\Components\Select::make('status')
                ->label('Статус')->options([
                    'new'       => 'Новая',
                    'processed' => 'Обработана',
                    'rejected'  => 'Отклонена',
                ]),
            Forms\Components\TextInput::make('bitrix24_lead_id')
                ->label('ID в Битрикс24')->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('created_at')
                ->label('Дата')->dateTime('d.m.Y H:i')->sortable(),
            Tables\Columns\TextColumn::make('name')->label('Имя')->searchable(),
            Tables\Columns\TextColumn::make('phone')->label('Телефон')->searchable(),
            Tables\Columns\TextColumn::make('region')->label('Регион'),
            Tables\Columns\TextColumn::make('form_type')->label('Форма'),
            Tables\Columns\BadgeColumn::make('status')
                ->label('Статус')
                ->colors([
                    'warning' => 'new',
                    'success' => 'processed',
                    'danger'  => 'rejected',
                ]),
            Tables\Columns\TextColumn::make('bitrix24_lead_id')->label('Битрикс24'),
        ])->defaultSort('created_at', 'desc')
        ->filters([
            Tables\Filters\SelectFilter::make('status')->options([
                'new'       => 'Новые',
                'processed' => 'Обработанные',
                'rejected'  => 'Отклонённые',
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'edit'  => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}

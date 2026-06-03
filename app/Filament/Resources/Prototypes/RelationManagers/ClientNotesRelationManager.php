<?php

namespace App\Filament\Resources\Prototypes\RelationManagers;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientNotesRelationManager extends RelationManager
{
    protected static string $relationship = 'clientNotes';
    protected static ?string $title = 'ملاحظات العملاء';
    protected static ?string $modelLabel = 'ملاحظة';
    protected static ?string $pluralModelLabel = 'الملاحظات';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('author_name')
                    ->label('اسم الكاتب')
                    ->required()
                    ->maxLength(255),
                Textarea::make('note')
                    ->label('الملاحظة')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('author_name')
            ->columns([
                TextColumn::make('author_name')
                    ->label('اسم الكاتب')
                    ->weight('bold'),
                TextColumn::make('note')
                    ->label('الملاحظة')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

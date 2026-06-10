<?php

namespace App\Filament\Resources\MarketingServices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class MarketingServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('الخدمة')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('category.name')
                    ->label('التصنيف المرتبط')
                    ->searchable()
                    ->sortable(),
                    
                \Filament\Tables\Columns\TextInputColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable(),
                    
                IconColumn::make('is_active')
                    ->label('الحالة')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc');
    }
}

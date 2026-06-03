<?php

namespace App\Filament\Resources\Tags\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TagsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ColorColumn::make('color')
                    ->label('اللون')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('اسم الوسم')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->label('المعرّف')
                    ->badge()
                    ->color('gray')
                    ->fontFamily('mono'),

                TextColumn::make('prototypes_count')
                    ->label('النماذج')
                    ->counts('prototypes')
                    ->badge()
                    ->color('sky')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->since()
                    ->sortable(),
            ])
            ->defaultSort('name')
            ->actions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('حذف المحدد'),
                ]),
            ])
            ->emptyStateHeading('لا توجد وسوم بعد')
            ->emptyStateDescription('أنشئ وسوماً لتصنيف نماذجك.')
            ->emptyStateIcon('heroicon-o-tag');
    }
}

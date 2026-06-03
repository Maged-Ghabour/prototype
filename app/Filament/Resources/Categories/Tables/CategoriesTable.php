<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ColorColumn::make('color')
                    ->label('اللون')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('اسم التصنيف')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->label('المعرّف')
                    ->badge()
                    ->color('gray')
                    ->fontFamily('mono'),

                TextColumn::make('prototypes_count')
                    ->label('عدد النماذج')
                    ->counts('prototypes')
                    ->badge()
                    ->color('violet')
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->since()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->actions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('حذف المحدد'),
                ]),
            ])
            ->emptyStateHeading('لا توجد تصنيفات بعد')
            ->emptyStateDescription('أنشئ تصنيفاً لتنظيم نماذجك التجريبية.')
            ->emptyStateIcon('heroicon-o-folder');
    }
}

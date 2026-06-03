<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Prototypes\PrototypeResource;
use App\Models\Prototype;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPrototypes extends BaseWidget
{
    protected static ?int $sort = 3; // ترتيب الظهور بعد الإحصاءات والرسم البياني
    protected int|string|array $columnSpan = 'full'; // لتمتد على كامل العرض

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PrototypeResource::getEloquentQuery()
            )
            ->defaultSort('created_at', 'desc')
            ->heading('أحدث النماذج المضافة')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->weight('bold')
                    ->url(fn (Prototype $record): string => PrototypeResource::getUrl('edit', ['record' => $record])),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('التصنيف')
                    ->badge()
                    ->color(fn ($record) => $record?->category?->color ? 'primary' : 'gray')
                    ->placeholder('—'),

                Tables\Columns\IconColumn::make('is_public')
                    ->label('عام')
                    ->boolean()
                    ->trueIcon('heroicon-o-globe-alt')
                    ->falseIcon('heroicon-o-lock-closed')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                \Filament\Actions\Action::make('preview')
                    ->label('معاينة')
                    ->icon('heroicon-o-eye')
                    ->iconButton()
                    ->color('info')
                    ->url(fn ($record) => route('prototype.preview', $record->slug))
                    ->openUrlInNewTab(),
            ])
            ->paginated(false); // إخفاء الترقيم لأننا نعرض 5 فقط
    }
}

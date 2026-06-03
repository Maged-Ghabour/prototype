<?php

namespace App\Filament\Resources\Prototypes\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ReplicateAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

/**
 * PrototypesTable — إعداد جدول Filament للنماذج التجريبية
 *
 * Filament v5: جميع Actions تحت Filament\Actions\
 */
class PrototypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('الصورة')
                    ->square()
                    ->defaultImageUrl(asset('images/placeholder.png')),

                // عمود العنوان مع التصنيف والوصف
                TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->category?->name ?? '—'),

                // التصنيف — badge ملوّن
                TextColumn::make('category.name')
                    ->label('التصنيف')
                    ->badge()
                    ->color(fn ($record) => $record?->category?->color ? 'primary' : 'gray')
                    ->placeholder('—')
                    ->sortable(),

                // الوسوم — مجموعة badges
                TextColumn::make('tags.name')
                    ->label('الوسوم')
                    ->badge()
                    ->color('info')
                    ->separator(',')
                    ->placeholder('—'),

                // الحالة
                TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->sortable(),

                // حالة الإتاحة
                IconColumn::make('is_public')
                    ->label('عام')
                    ->boolean()
                    ->trueIcon('heroicon-o-globe-alt')
                    ->falseIcon('heroicon-o-lock-closed')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                // تاريخ الإنشاء
                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime('j M Y')
                    ->sortable()
                    ->since()
                    ->tooltip(fn ($record) => $record->created_at->format('Y-m-d H:i:s')),
            ])

            // ── فلاتر البحث والتصفية ─────────────────────────────────
            ->filters([
                SelectFilter::make('category_id')
                    ->label('التصنيف')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('جميع التصنيفات'),

                SelectFilter::make('tags')
                    ->label('الوسم')
                    ->relationship('tags', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('جميع الوسوم'),

                SelectFilter::make('is_public')
                    ->label('الإتاحة')
                    ->options([
                        '1' => 'عام',
                        '0' => 'خاص',
                    ])
                    ->placeholder('الكل'),

                SelectFilter::make('status')
                    ->label('الحالة')
                    ->options(\App\Enums\PrototypeStatus::class),
            ])
            ->filtersLayout(\Filament\Tables\Enums\FiltersLayout::AboveContent)

            // ── الإجراءات ──────────────────────────────────────────────
            ->actions([
                EditAction::make()->label('تعديل')->iconButton(),

                ReplicateAction::make()
                    ->iconButton()
                    ->label('تكرار')
                    ->icon('heroicon-o-document-duplicate')
                    ->beforeReplicaSaved(function ($replica, $record) {
                        $baseSlug = $replica->slug . '-copy';
                        $slug = $baseSlug;
                        $counter = 1;
                        while (\App\Models\Prototype::where('slug', $slug)->exists()) {
                            $slug = $baseSlug . '-' . $counter++;
                        }
                        $replica->slug = $slug;
                        $replica->title = $replica->title . ' (نسخة)';
                        
                        // نسخ الصورة المصغرة إن وجدت
                        if ($record->thumbnail && \Illuminate\Support\Facades\Storage::disk('public')->exists($record->thumbnail)) {
                            $extension = pathinfo($record->thumbnail, PATHINFO_EXTENSION);
                            $newPath = 'prototypes/thumbnails/' . uniqid() . '.' . $extension;
                            \Illuminate\Support\Facades\Storage::disk('public')->copy($record->thumbnail, $newPath);
                            $replica->thumbnail = $newPath;
                        }
                    })
                    ->successNotificationTitle('تم تكرار النموذج بنجاح!'),

                Action::make('preview')
                    ->label('معاينة')
                    ->icon('heroicon-o-eye')
                    ->iconButton()
                    ->color('info')
                    ->url(fn ($record) => route('prototype.preview', $record->slug))
                    ->openUrlInNewTab()
                    ->tooltip('فتح المعاينة العامة'),

                DeleteAction::make()->label('حذف')->iconButton(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('حذف المحدد'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('لا توجد نماذج بعد')
            ->emptyStateDescription('ابدأ بإنشاء أول نموذج تجريبي مولّد بالذكاء الاصطناعي.')
            ->emptyStateIcon('heroicon-o-code-bracket');
    }
}

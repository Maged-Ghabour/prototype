<?php

namespace App\Filament\Resources\Prototypes;

use App\Filament\Resources\Prototypes\Pages\CreatePrototype;
use App\Filament\Resources\Prototypes\Pages\EditPrototype;
use App\Filament\Resources\Prototypes\Pages\ListPrototypes;
use App\Filament\Resources\Prototypes\Schemas\PrototypeForm;
use App\Filament\Resources\Prototypes\Tables\PrototypesTable;
use App\Models\Prototype;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

/**
 * PrototypeResource
 *
 * The main Filament resource for managing AI-generated prototypes.
 * Accessible only to authenticated administrators via the /admin panel.
 */
class PrototypeResource extends Resource
{
    /**
     * The Eloquent model this resource manages.
     */
    protected static ?string $model = Prototype::class;

    /**
     * Navigation icon in the sidebar.
     */
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCodeBracket;

    /**
     * التسمية في شريط التنقل الجانبي
     */
    protected static ?string $navigationLabel = 'دراسات الحالة';

    /**
     * التسمية المفردة للعنصر
     */
    protected static ?string $modelLabel = 'دراسة حالة';

    /**
     * التسمية الجمع للعناصر
     */
    protected static ?string $pluralModelLabel = 'دراسات الحالة';

    /**
     * ترتيب الظهور في القائمة
     */
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationGroup(): ?string
    {
        return 'أعمال الوكالة';
    }

    /**
     * Define the form schema used for create/edit pages.
     */
    public static function form(Schema $schema): Schema
    {
        return PrototypeForm::configure($schema);
    }

    /**
     * Define the table (list) configuration.
     */
    public static function table(Table $table): Table
    {
        return PrototypesTable::configure($table);
    }

    /**
     * Define relationship managers (none needed for this MVP).
     */
    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\Prototypes\RelationManagers\ClientNotesRelationManager::class,
        ];
    }

    /**
     * Define the pages (routes) for this resource.
     */
    public static function getPages(): array
    {
        return [
            'index'  => ListPrototypes::route('/'),
            'create' => CreatePrototype::route('/create'),
            'edit'   => EditPrototype::route('/{record}/edit'),
        ];
    }
}

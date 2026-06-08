<?php

namespace App\Filament\Resources\MarketingServices;

use App\Filament\Resources\MarketingServices\Pages\CreateMarketingService;
use App\Filament\Resources\MarketingServices\Pages\EditMarketingService;
use App\Filament\Resources\MarketingServices\Pages\ListMarketingServices;
use App\Filament\Resources\MarketingServices\Schemas\MarketingServiceForm;
use App\Filament\Resources\MarketingServices\Tables\MarketingServicesTable;
use App\Models\MarketingService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MarketingServiceResource extends Resource
{
    protected static ?string $model = MarketingService::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return MarketingServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MarketingServicesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMarketingServices::route('/'),
            'create' => CreateMarketingService::route('/create'),
            'edit' => EditMarketingService::route('/{record}/edit'),
        ];
    }
}

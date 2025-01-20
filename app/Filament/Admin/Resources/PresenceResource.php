<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PresenceResource\Pages;
use App\Filament\Admin\Resources\PresenceResource\Widgets\FilterPresenceByAgenda;
use App\Models\Presence;
use Carbon\Carbon;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PresenceResource extends Resource
{
    protected static ?string $model = Presence::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $navigationLabel = 'Presence';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $slug = 'presence';

    protected static ?string $breadcrumb = "Presence";

    protected static ?int $navigationSort = 3;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('nidn')
                    ->searchable()
                    ->default('-'),
                TextColumn::make('nim')
                    ->searchable()
                    ->default('-'),
                TextColumn::make('created_at')
                    ->label('Presence Date')
                    ->getStateUsing(function ($record) {
                        return Carbon::parse($record->created_at)->timezone('Asia/Jakarta')->format('M d, Y H:i:s');
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Empty data')
            ->emptyStateDescription('No data found');
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
            'index' => Pages\ListPresences::route('/'),
        ];
    }
}

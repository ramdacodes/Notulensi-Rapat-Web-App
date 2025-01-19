<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AgendaResource\Pages;
use App\Models\Agenda;
use App\MeetingStatus;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $navigationLabel = 'Agenda';

    protected static ?string $slug = 'agenda';

    protected static ?string $breadcrumb = 'Agenda';

    protected static ?string $navigationGroup = 'Master Data';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(name: 'name')
                    ->placeholder('Please enter agenda name')
                    ->autocomplete(false)
                    ->required(),
                TextInput::make(name: 'location')
                    ->placeholder('Please enter location')
                    ->autocomplete(false)
                    ->required(),
                DatePicker::make(name:'date')
                    ->placeholder('Please select date')
                    ->native(false)
                    ->required(),
                TagsInput::make(name:'participants')
                    ->placeholder('Please enter participants')
                    ->required(),
                TextInput::make(name:'inviter_name')
                    ->placeholder('Please enter inviter name')
                    ->autocomplete(false)
                    ->required(),
                TextInput::make(name:'inviter_position')
                    ->placeholder('Please enter inviter position')
                    ->autocomplete(false)
                    ->required(),
                Select::make(name:'status')
                    ->placeholder('Please select status')
                    ->options(MeetingStatus::class)
                    ->native(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('location')
                    ->searchable(),
                TextColumn::make('date')
                    ->date(),
                TextColumn::make('participants')
                    ->searchable()
                    ->badge(),
                TextColumn::make('created_at')
                    ->getStateUsing(function ($record) {
                        return Carbon::parse($record->created_at)->timezone('Asia/Jakarta')->format('M d, Y H:i:s');
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->native(false)
                    ->options(MeetingStatus::class),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}

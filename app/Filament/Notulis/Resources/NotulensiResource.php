<?php

namespace App\Filament\Notulis\Resources;

use App\Filament\Notulis\Resources\NotulensiResource\Pages;
use App\Models\Agenda;
use App\Models\Notulensi;
use Carbon\Carbon;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class NotulensiResource extends Resource
{
    protected static ?string $model = Notulensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationLabel = 'Notulensi';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $slug  = 'notulensi';

    protected static ?string $breadcrumb = "Notulensi";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Section::make('Notulensi Details')
                            ->schema([
                                Select::make('agenda_id')
                                    ->label('Agenda')
                                    ->relationship('agenda', 'name', function ($query) {
                                        return $query
                                            ->where('status', 'ongoing')
                                            ->whereDoesntHave('notulensi');
                                    })
                                    ->placeholder('Please select agenda')
                                    ->preload()
                                    ->searchable()
                                    ->native(false)
                                    ->columnSpanFull()
                                    ->disabled(fn (string $context): bool => $context === 'edit')
                                    ->required(fn (string $context): bool => $context === 'create')
                                    ->getOptionLabelUsing(fn ($value) => Agenda::find($value)?->name),
                                RichEditor::make('conclusion')
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                                    ->columnSpanFull()
                                    ->minLength(50)
                                    ->required()
                            ])
                            ->columnSpan(1),
                        Section::make('Attachments')
                            ->schema([
                                Repeater::make('attachments')
                                    ->required()
                                    ->schema([
                                        TextInput::make('title')
                                            ->placeholder('Please enter title')
                                            ->required(),
                                        FileUpload::make('file')
                                            ->image()
                                            ->disk('public')
                                            ->directory('images/agendas/attachments')
                                            ->required(),
                                        Textarea::make('description')
                                            ->placeholder('Please enter description')
                                            ->required()
                                    ])
                                    ->reorderable()
                                    ->columnSpanFull()
                                    ->default([])
                                    ->addActionLabel('Add Attachment'),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('agenda.name')
                    ->searchable(),
                TextColumn::make('conclusion')
                    ->html()
                    ->limit(50),
                TextColumn::make('created_at')
                    ->getStateUsing(function ($record) {
                        return Carbon::parse($record->created_at)->timezone('Asia/Jakarta')->format('M d, Y H:i:s');
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                    ->after(function (Notulensi $record) {
                        if ($record->attachments) {
                            foreach ($record->attachments as $attachment) {
                                Storage::disk('public')->delete($attachment);
                            }
                        }
                    }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                    ->after(function (Notulensi $record) {
                        if ($record->attachments) {
                            foreach ($record->attachments as $attachment) {
                                Storage::disk('public')->delete($attachment);
                            }
                        }
                    }),
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
            'index' => Pages\ListNotulensis::route('/'),
            'create' => Pages\CreateNotulensi::route('/create'),
            'edit' => Pages\EditNotulensi::route('/{record}/edit'),
        ];
    }
}

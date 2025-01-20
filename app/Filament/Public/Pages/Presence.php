<?php

namespace App\Filament\Public\Pages;

use App\Models\Agenda;
use App\Models\Presence as PresenceModel;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Presence extends Page
{
    protected static string $view = 'filament.public.pages.presence';

    public $agenda_id;
    public $type;
    public $identity;
    public $name;

    public function getTitle(): string|Htmlable
    {
        return 'Form Presence';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('agenda_id')
                    ->label('Agenda')
                    ->options(Agenda::all()->pluck('name', 'agenda_id'))
                    ->placeholder('Please select agenda')
                    ->preload()
                    ->searchable()
                    ->native(false)
                    ->columnSpanFull()
                    ->required(),
                Select::make('type')
                    ->label('Role')
                    ->options([
                        'student' => 'Student',
                        'lecturer' => 'Lecturer',
                    ])
                    ->placeholder('Please select role')
                    ->native(false)
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('identity')
                    ->label('NIM/NIDN')
                    ->autocomplete(false)
                    ->placeholder('Please enter NIM/NIDN')
                    ->columnSpanFull()
                    ->numeric()
                    ->required(),
                TextInput::make('name')
                    ->autocomplete(false)
                    ->placeholder('Please enter name')
                    ->columnSpanFull()
                    ->required()
            ]);
    }

    public function submit(): void
    {
        $this->validate();

        $agenda_id = $this->agenda_id;
        $type = $this->type;
        $identity = $this->identity;
        $name = $this->name;

        if ($type == 'student') {
            try {
                $check = PresenceModel::where('agenda_id', $agenda_id)
                    ->where('nim', $identity)
                    ->first();

                if ($check) {
                    Notification::make()
                        ->title('Attendance Failed')
                        ->danger()
                        ->body("Attendance for the student {$name} (NIM: {$identity}) has already been recorded.")
                        ->send();
                    return;
                }

                PresenceModel::create([
                    'agenda_id' => $agenda_id,
                    'nim' => $identity,
                    'name' => $name,
                ]);

                Notification::make()
                    ->title('Attendance Recorded')
                    ->success()
                    ->body("Attendance for the student {$name} (NIM: {$identity}) has been successfully recorded.")
                    ->send();
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Attendance Error')
                    ->danger()
                    ->body('An error occurred while saving attendance. Please try again.')
                    ->send();
            }
        } else if ($type == 'lecturer') {
            try {
                $check = PresenceModel::where('agenda_id', $agenda_id)
                    ->where('nidn', $identity)
                    ->first();

                if ($check) {
                    Notification::make()
                        ->title('Attendance Failed')
                        ->danger()
                        ->body("Attendance for the lecturer {$name} (NIDN: {$identity}) has already been recorded.")
                        ->send();
                    return;
                }

                PresenceModel::create([
                    'agenda_id' => $agenda_id,
                    'nidn' => $identity,
                    'name' => $name,
                ]);

                Notification::make()
                    ->title('Attendance Recorded')
                    ->success()
                    ->body("Attendance for the lecturer {$name} (NIDN: {$identity}) has been successfully recorded.")
                    ->send();
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Attendance Error')
                    ->danger()
                    ->body('An error occurred while saving attendance. Please try again.')
                    ->send();
            }
        }

        $this->reset(['agenda_id', 'type', 'identity', 'name']);
    }
}

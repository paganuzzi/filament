<?php

namespace App\Livewire\User;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ListUsers extends Component implements HasForms, HasTable
{
    use InteractsWithForms,InteractsWithTable;

    public function table(Table $table): Table
    {

        return $table
            ->query(User::query())
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('pagos_sum_importe')
                    ->sum('pagos', 'importe')
                    ->default(0)
                    ->money('ARS'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('pagos')
                    ->label('pagos')
                    ->icon('heroicon-s-presentation-chart-bar')
                    ->url(fn (Model $user): string => route('user.pagos', ['user' => $user->id])),
                EditAction::make()
                    ->form([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(255),
                    ]),
                DeleteAction::make(),
            ])
            ->bulkActions([
                // ...
            ])
            ->headerActions([
                CreateAction::make()
                    ->model(User::class)
                    ->form([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(255),
                        TextInput::make('password')
                            ->name('Contraseña')
                            ->required()
                            ->password()
                            ->maxLength(255)
                            ->same('passwordconfirm'),
                        TextInput::make('passwordconfirm')
                            ->name('Confirme contraseña')
                            ->required()
                            ->password()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.user.list-users');
    }
}

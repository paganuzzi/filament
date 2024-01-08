<?php

namespace App\Livewire\User;

use App\Models\Pago;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class UserPayments extends Component implements HasForms, HasTable
{
    use InteractsWithForms,InteractsWithTable;

    public $user;

    public function table(Table $table): Table
    {

        return $table
            ->relationship(fn () => $this->user->pagos())
            ->columns([
                TextColumn::make('descripcion'),
                TextColumn::make('importe'),
            ])
            ->actions([
                EditAction::make()
                    ->form([
                        TextInput::make('descripcion')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('importe')
                            ->required()
                            ->numeric()
                            ->maxLength(255),
                    ]),
                DeleteAction::make(),
                RestoreAction::make(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->model(Pago::class)
                    ->form([
                        TextInput::make('descripcion')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('importe')
                            ->required()
                            ->numeric()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public function render(): View|Factory
    {
        return view('livewire.user.user-payments');
    }
}

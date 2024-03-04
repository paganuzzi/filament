<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Widgets\Widget;

class CreateUserWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.resources.user-resource.widgets.create-user-widget';

    protected int|string|array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique('users', 'email'),
                TextInput::make('password')
                    ->same('passwordconfirm')
                    ->password(),
                TextInput::make('passwordconfirm')
                    ->password()
                    ->same('password'),
                Toggle::make('is_admin')
                    ->onColor('success')
                    ->offColor('danger'),
            ])
            ->statePath('data')
            ->columns(2);
    }

    public function create(): void
    {
        $this->validate();
        User::create($this->form->getState());
        $this->form->fill();
        $this->dispatch('contact-created');
    }

    public static function canView(): bool
    {
        return auth()->user()->isAdmin();
    }
}

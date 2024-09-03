<?php

namespace App\Filament\Auth;

use FIlament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as AuthRegister;

class Register extends AuthRegister {
    public function form (Form $form): Form {
     
        return $form->schema([
            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),

            TextInput::make('phone'),
            Select::make('role')
            ->options([
                'seller' => 'Seller',
            ])
        ])
        ->statePath('data');
    }
}
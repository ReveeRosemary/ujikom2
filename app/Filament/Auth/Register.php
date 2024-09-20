<?php
namespace App\Filament\Auth;

use App\Models\Toko;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as AuthRegister;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Illuminate\Support\Facades\Hash;

class Register extends AuthRegister
{
    public function form(Form $form): Form
    {
        return $form->schema([
            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
            TextInput::make('nama_toko')
                ->required()
                ->label('Nama Toko'),
        ])
        ->statePath('data');
    }

    public function register(): ?RegistrationResponse
    {
        $data = $this->form->getState();

        $role = 'Seller';
        // Buat User Baru
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $role,
        ]);

        $toko = Toko::create([
            'name' => $data['nama_toko'],
            'user_id' => $user->id
        ]);

        $user->save();

        // Login user setelah registrasi
        auth()->login($user);

        // Mengembalikan respons registrasi yang sesuai
        return app(RegistrationResponse::class);
    }
}

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
            TextInput::make('phone')
                ->required()
                ->label('Nomor HP'),
            Select::make('role')
                ->options([
                    'seller' => 'Seller',
                ])
                ->required()
                ->label('Role'),
        ])
        ->statePath('data');
    }

    public function register(): ?RegistrationResponse
    {
        $data = $this->form->getState();

        // Buat User Baru
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'role' => $data['role'],
        ]);

        // Buat Toko Baru yang berelasi dengan user
        $toko = Toko::create([
            'name' => $data['name'] . "'s Toko", // Nama toko
            'user_id' => $user->id, // Asosiasi dengan pengguna yang baru dibuat
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'], // Ini mungkin sebaiknya tidak disimpan langsung
        ]);

        // Update toko_id di tabel users
        $user->toko_id = $toko->id;
        $user->save();

        // Login user setelah registrasi
        auth()->login($user);

        // Mengembalikan respons registrasi yang sesuai
        return app(RegistrationResponse::class);
    }
}

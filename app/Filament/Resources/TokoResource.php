<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Toko;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TokoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TokoResource\RelationManagers;

class TokoResource extends Resource
{
    protected static ?string $model = Toko::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')
                    ->required()
                    ->label('Nama Toko'),
                    TextInput::make('email')
                    ->required()
                    ->label('Email'),
                    TextInput::make('phone')
                    ->required()
                    ->numeric()
                    ->label('Nomor HP'),
                    TextInput::make('password')
                    ->required()
                    ->password()
                    ->minLength(8)
                    ->label('Password'),  
                    FileUpload::make('foto')
                    ->label('Foto Toko'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Nama Toko'),
                TextColumn::make('email')
                ->label('Email'),
                TextColumn::make('phone')
                ->label('Nomor HP'),
                ImageColumn::make('foto')
                ->label('Foto Toko'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTokos::route('/'),
            'create' => Pages\CreateToko::route('/create'),
            'edit' => Pages\EditToko::route('/{record}/edit'),
        ];
    }
}

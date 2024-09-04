<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Produk;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProdukResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProdukResource\RelationManagers;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('nama_produk')
                    ->required()
                    ->label('Nama Produk'),
                    TextInput::make('harga')
                    ->required()
                    ->label('Harga Produk'),
                    TextInput::make('stok')
                    ->required()
                    ->numeric()
                    ->label('Stok Produk'),  
                    FileUpload::make('foto')
                    ->label('Foto Produk'),
                    Hidden::make('toko_id')
                    ->default(auth()->user()->toko_id) // Mengatur nilai default sesuai auth user
                    ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_produk')
                ->label('Nama Produk'),
                TextColumn::make('toko.name')
                ->label('Nama Toko'),
                TextColumn::make('harga')
                ->label('Harga Produk'),
                TextColumn::make('stok')
                ->label('Stok Tersisa'),
                ImageColumn::make('foto')
                ->label('Foto Toko'),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                if (auth() -> user()->role === 'Seller') {
                    return $query->where('toko_id', auth()->user()->toko_id);
                }
            })
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}

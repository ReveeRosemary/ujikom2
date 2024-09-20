<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pesanan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PesananResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PesananResource\RelationManagers;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Display the related product's name
            Select::make('produk_id')
                ->label('Nama Produk')
                ->relationship('produk', 'nama_produk') // Define the relationship and which field to display
                ->disabled(), // Prevent editing since it's fetched from the product model
            TextInput::make('kuantitas')
                ->label('Kuantitas Pembelian')
                ->numeric()
                ->minValue(1)
                ->required(),
            // Display the related product's price
            TextInput::make('harga_produk')
                ->label('Harga Produk')
                ->disabled(), // Price is fixed and not editable
            // Allow the admin/seller to update the order status
            Select::make('status')
                ->label('Status Pesanan')
                ->options([
                    'Packaging' => 'Packaging',
                    'On The Way' => 'On The Way',
                    'Delivered' => 'Delivered',
                    'Canceled' => 'Canceled',
                ])
                ->default('Packaging')
                ->required(),
            // Show the user (customer) who placed the order
            Select::make('user_id')
                ->label('Nama Pemesan')
                ->relationship('user', 'name') // Pull user name from related table
                ->disabled(), // Disable to prevent changing the customer
        ]);
    
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto_produk')
                ->label('Foto Produk'),
                TextColumn::make('nama_produk')
                ->label('Nama Produk')
                ->searchable()
                ->sortable(),
                TextColumn::make('harga_produk')
                ->label('Harga Produk')
                ->searchable()
                ->sortable(),
                TextColumn::make('kuantitas')
                ->label('Kuantitas Pembelian')
                ->searchable()
                ->sortable(),
                TextColumn::make('total')
                ->label('Total Harga')
                ->getStateUsing(function ($record) {
                    return 'Rp ' . number_format($record->harga_produk * $record->kuantitas, 0, ',', '.');
                })
                ->sortable(),
                TextColumn::make('user.name')
                ->label('Nama Pemesan')
                ->searchable()
                ->sortable(),
                SelectColumn::make('status')
                ->label('Status Pesanan')
                ->options([
                    'Packaging' => 'Packaging',
                    'On The Way' => 'On The Way',
                    'Delivered' => 'Delivered',
                    'Canceled' => 'Canceled',
                ])
                ->searchable()
                ->sortable(),
                TextColumn::make('created_at') // Using TextColumn to display date
                ->label('Ordered At')
                ->getStateUsing(fn ($record) => $record->created_at->format('d/m/Y H:i')) // Format the date manually
                ->sortable(),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->role === 'Seller') {
                    return $query->whereHas('produk.toko', function (Builder $query) {
                        $query->where('user_id', auth()->id());
                    });
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
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}

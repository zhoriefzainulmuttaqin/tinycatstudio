<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientInvoiceResource\Pages;
use App\Models\ClientInvoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClientInvoiceResource extends Resource
{
    protected static ?string $model = ClientInvoice::class;

    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static ?string $navigationLabel = 'Tagihan Klien';
    protected static ?string $modelLabel = 'tagihan klien';
    protected static ?string $pluralModelLabel = 'tagihan klien';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Tagihan')
                    ->schema([
                        Forms\Components\Select::make('client_id')
                            ->label('Klien')
                            ->relationship('client', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('invoice_number')
                            ->label('No. Tagihan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('customer_email')
                            ->label('Email Pelanggan')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('issue_date')
                            ->label('Tanggal Terbit')
                            ->required(),
                        Forms\Components\DatePicker::make('due_date')
                            ->label('Jatuh Tempo')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options(ClientInvoice::statusOptions())
                            ->required()
                            ->default('draft'),
                        Forms\Components\TextInput::make('tax_rate')
                            ->label('Tarif Pajak')
                            ->numeric()
                            ->default(0)
                            ->suffix('%'),
                        Forms\Components\Textarea::make('customer_address')
                            ->label('Alamat Pelanggan')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Item Tagihan')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('description')
                                    ->label('Deskripsi')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('quantity')
                                    ->label('Jumlah')
                                    ->required()
                                    ->numeric()
                                    ->default(1),
                                Forms\Components\TextInput::make('unit_price')
                                    ->label('Harga Satuan')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->columns(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Klien')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('No. Tagihan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issue_date')
                    ->label('Tanggal Terbit')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->formatStateUsing(fn ($state): string => ClientInvoice::formatRupiah($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ClientInvoice::statusLabel($state))
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'deposit' => 'warning',
                        'paid' => 'success',
                        'overdue' => 'danger',
                        default => 'primary',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('preview')
                    ->label('Pratinjau')
                    ->icon('heroicon-o-eye')
                    ->url(fn (ClientInvoice $record): string => route('invoices.preview', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('download')
                    ->label('Unduh PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (ClientInvoice $record): string => route('invoices.download', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make()
                    ->label('Ubah'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
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
            'index' => Pages\ListClientInvoices::route('/'),
            'create' => Pages\CreateClientInvoice::route('/create'),
            'edit' => Pages\EditClientInvoice::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Client\Resources;

use App\Filament\Client\Resources\ClientInvoiceResource\Pages;
use App\Models\ClientCustomer;
use App\Models\ClientInvoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClientInvoiceResource extends Resource
{
    protected static ?string $model = ClientInvoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static ?string $navigationLabel = 'Tagihan Saya';
    protected static ?string $modelLabel = 'tagihan';
    protected static ?string $pluralModelLabel = 'tagihan';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('client_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Tagihan')
                    ->description('Lengkapi detail pelanggan yang akan ditagih.')
                    ->schema([
                        Forms\Components\Hidden::make('client_id')
                            ->default(fn () => auth()->id()),
                        Forms\Components\TextInput::make('invoice_number')
                            ->label('No. Tagihan')
                            ->required()
                            ->default(fn () => 'INV-' . strtoupper(str()->random(6)))
                            ->maxLength(255),
                        Forms\Components\Select::make('client_customer_id')
                            ->label('Pilih Pelanggan Tersimpan')
                            ->options(fn () => ClientCustomer::where('client_id', auth()->id())->pluck('name', 'id'))
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if ($state) {
                                    $customer = ClientCustomer::find($state);

                                    if ($customer) {
                                        $set('customer_name', $customer->name);
                                        $set('customer_email', $customer->email);
                                        $set('customer_address', $customer->address);
                                    }
                                }
                            })
                            ->columnSpanFull(),
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
                            ->required()
                            ->default(now()),
                        Forms\Components\DatePicker::make('due_date')
                            ->label('Jatuh Tempo')
                            ->required()
                            ->default(now()->addDays(14)),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options(ClientInvoice::statusOptions())
                            ->required()
                            ->default('draft'),
                    ])->columns(['default' => 1, 'md' => 2]),

                Forms\Components\Section::make('Ringkasan & Penyesuaian')
                    ->schema([
                        Forms\Components\TextInput::make('discount_amount')
                            ->label('Nominal Diskon')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('tax_rate')
                            ->label('Tarif Pajak')
                            ->numeric()
                            ->default(0)
                            ->suffix('%'),
                        Forms\Components\TextInput::make('additional_fee')
                            ->label('Biaya Tambahan (Pengiriman, dll.)')
                            ->numeric()
                            ->default(0),
                    ])->columns(3),

                Forms\Components\Section::make('Otomatisasi')
                    ->description('Atur agar tagihan ini dibuat berulang secara otomatis.')
                    ->schema([
                        Forms\Components\Toggle::make('is_recurring')
                            ->label('Tagihan Berulang')
                            ->live(),
                        Forms\Components\Select::make('recurring_interval')
                            ->label('Periode')
                            ->options(ClientInvoice::recurringIntervalOptions())
                            ->required(fn (Forms\Get $get) => $get('is_recurring'))
                            ->visible(fn (Forms\Get $get) => $get('is_recurring')),
                        Forms\Components\DatePicker::make('next_recurring_date')
                            ->label('Tanggal Tagihan Berikutnya')
                            ->required(fn (Forms\Get $get) => $get('is_recurring'))
                            ->visible(fn (Forms\Get $get) => $get('is_recurring')),
                    ])->columns(3),

                Forms\Components\Section::make('Informasi Pelanggan')
                    ->schema([
                        Forms\Components\Textarea::make('customer_address')
                            ->label('Alamat Pelanggan')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan / Syarat Pembayaran')
                            ->helperText('Tambahkan instruksi pembayaran atau syarat layanan.')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(['default' => 1, 'md' => 2]),

                Forms\Components\Section::make('Item Tagihan')
                    ->description('Tambahkan produk atau layanan yang ingin ditagihkan.')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('description')
                                    ->label('Deskripsi')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(['default' => 1, 'md' => 2]),
                                Forms\Components\TextInput::make('quantity')
                                    ->label('Jumlah')
                                    ->required()
                                    ->numeric()
                                    ->default(1)
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('unit_price')
                                    ->label('Harga Satuan')
                                    ->required()
                                    ->numeric()
                                    ->default(0)
                                    ->columnSpan(1),
                            ])
                            ->columns(['default' => 1, 'md' => 4]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('No. Tagihan')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('issue_date')
                    ->label('Tanggal Terbit')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Jatuh Tempo')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->formatStateUsing(fn ($state): string => ClientInvoice::formatRupiah($state))
                    ->weight('bold')
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
                Tables\Columns\IconColumn::make('is_recurring')
                    ->label('Berulang')
                    ->boolean()
                    ->trueIcon('heroicon-o-arrow-path')
                    ->falseIcon('heroicon-o-minus')
                    ->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('preview')
                        ->label('Pratinjau')
                        ->icon('heroicon-o-eye')
                        ->url(fn (ClientInvoice $record): string => route('invoices.preview', $record))
                        ->openUrlInNewTab(),
                    Tables\Actions\Action::make('share_wa')
                        ->label('Bagikan ke WA')
                        ->icon('heroicon-o-chat-bubble-left-ellipsis')
                        ->color('success')
                        ->url(function (ClientInvoice $record): string {
                            $companyName = auth()->user()->company_name ?? auth()->user()->name;
                            $total = ClientInvoice::formatRupiah($record->total_amount);
                            $link = route('invoices.public', $record->invoice_number);
                            $text = "Halo {$record->customer_name},\n\nBerikut tagihan {$record->invoice_number} dari {$companyName} dengan total {$total}.\n\nAnda bisa melihat dan mengunduh tagihan secara online di sini:\n{$link}\n\nTerima kasih.";

                            return 'https://wa.me/?text=' . urlencode($text);
                        })
                        ->openUrlInNewTab(),
                    Tables\Actions\Action::make('copy_link')
                        ->label('Salin Tautan Publik')
                        ->icon('heroicon-o-link')
                        ->color('info')
                        ->alpineClickHandler(fn (ClientInvoice $record) => "window.navigator.clipboard.writeText('" . route('invoices.public', $record->invoice_number) . "'); \$tooltip('Tautan berhasil disalin!');"),
                    Tables\Actions\Action::make('download')
                        ->label('Unduh PDF')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->url(fn (ClientInvoice $record): string => route('invoices.download', $record))
                        ->openUrlInNewTab(),
                    Tables\Actions\EditAction::make()
                        ->label('Ubah'),
                ]),
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

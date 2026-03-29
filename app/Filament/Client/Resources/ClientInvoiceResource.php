<?php

namespace App\Filament\Client\Resources;

use App\Filament\Client\Resources\ClientInvoiceResource\Pages;
use App\Filament\Client\Resources\ClientInvoiceResource\RelationManagers;
use App\Models\ClientInvoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientInvoiceResource extends Resource
{
    protected static ?string $model = ClientInvoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static ?string $navigationLabel = 'My Invoices';
    protected static ?string $modelLabel = 'Invoice';
    protected static ?string $pluralModelLabel = 'Invoices';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('client_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Invoice Details')
                    ->description('Provide the details of the client you are billing.')
                    ->schema([
                        Forms\Components\Hidden::make('client_id')
                            ->default(fn () => auth()->id()),
                        Forms\Components\TextInput::make('invoice_number')
                            ->required()
                            ->default(fn () => 'INV-' . strtoupper(str()->random(6)))
                            ->maxLength(255),
                        Forms\Components\Select::make('client_customer_id')
                            ->label('Select Existing Customer')
                            ->options(fn () => \App\Models\ClientCustomer::where('client_id', auth()->id())->pluck('name', 'id'))
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if ($state) {
                                    $customer = \App\Models\ClientCustomer::find($state);
                                    if ($customer) {
                                        $set('customer_name', $customer->name);
                                        $set('customer_email', $customer->email);
                                        $set('customer_address', $customer->address);
                                    }
                                }
                            })
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('customer_name')
                            ->label('Billed To (Client Name)')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('customer_email')
                            ->label('Client Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('issue_date')
                            ->required()
                            ->default(now()),
                        Forms\Components\DatePicker::make('due_date')
                            ->required()
                            ->default(now()->addDays(14)),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'deposit' => 'Deposit',
                                'paid' => 'Paid',
                                'overdue' => 'Overdue',
                            ])
                            ->required()
                            ->default('draft'),
                    ])->columns(['default' => 1, 'md' => 2]),

                Forms\Components\Section::make('Totals & Adjustments')
                    ->schema([
                        Forms\Components\TextInput::make('discount_amount')
                            ->numeric()
                            ->default(0)
                            ->label('Discount Amount (Nominal)'),
                        Forms\Components\TextInput::make('tax_rate')
                            ->numeric()
                            ->default(0)
                            ->suffix('%')
                            ->label('Tax Rate'),
                        Forms\Components\TextInput::make('additional_fee')
                            ->numeric()
                            ->default(0)
                            ->label('Additional Fee (Shipping, etc)'),
                    ])->columns(3),
                    
                Forms\Components\Section::make('Automation')
                    ->description('Set this invoice to recur automatically.')
                    ->schema([
                        Forms\Components\Toggle::make('is_recurring')
                            ->label('Recurring Invoice')
                            ->live(),
                        Forms\Components\Select::make('recurring_interval')
                            ->label('Interval')
                            ->options([
                                'weekly' => 'Weekly',
                                'monthly' => 'Monthly',
                                'yearly' => 'Yearly',
                            ])
                            ->required(fn (Forms\Get $get) => $get('is_recurring'))
                            ->visible(fn (Forms\Get $get) => $get('is_recurring')),
                        Forms\Components\DatePicker::make('next_recurring_date')
                            ->label('First Recurrence Date')
                            ->required(fn (Forms\Get $get) => $get('is_recurring'))
                            ->visible(fn (Forms\Get $get) => $get('is_recurring')),
                    ])->columns(3),
                    
                Forms\Components\Section::make('Client Information')
                    ->schema([
                        Forms\Components\Textarea::make('customer_address')
                            ->label('Client Address')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes / Payment Terms')
                            ->helperText('Add any payment instructions or terms of service.')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(['default' => 1, 'md' => 2]),

                Forms\Components\Section::make('Line Items')
                    ->description('Add the products or services you are billing for.')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('description')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(['default' => 1, 'md' => 2]),
                                Forms\Components\TextInput::make('quantity')
                                    ->required()
                                    ->numeric()
                                    ->default(1)
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('unit_price')
                                    ->required()
                                    ->numeric()
                                    ->default(0)
                                    ->columnSpan(1),
                            ])
                            ->columns(['default' => 1, 'md' => 4])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Invoice #')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Billed To')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('issue_date')
                    ->label('Issue Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Due Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->formatStateUsing(fn ($state): string => ClientInvoice::formatRupiah($state))
                    ->weight('bold')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'deposit' => 'warning',
                        'paid' => 'success',
                        'overdue' => 'danger',
                        default => 'primary',
                    }),
                Tables\Columns\IconColumn::make('is_recurring')
                    ->label('Recurring')
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
                        ->label('Preview')
                        ->icon('heroicon-o-eye')
                        ->url(fn (\App\Models\ClientInvoice $record): string => route('invoices.preview', $record))
                        ->openUrlInNewTab(),
                    Tables\Actions\Action::make('share_wa')
                        ->label('Share to WA')
                        ->icon('heroicon-o-chat-bubble-left-ellipsis')
                        ->color('success')
                        ->url(function (\App\Models\ClientInvoice $record): string {
                            $companyName = auth()->user()->company_name ?? auth()->user()->name;
                            $total = 'Rp ' . number_format($record->total_amount, 0, ',', '.');
                            $link = route('invoices.public', $record->invoice_number);
                            $text = "Hello {$record->customer_name},\n\nHere is your invoice {$record->invoice_number} from {$companyName} for the amount of {$total}.\n\nYou can view and download your invoice online here:\n{$link}\n\nThank you!";
                            return 'https://wa.me/?text=' . urlencode($text);
                        })
                        ->openUrlInNewTab(),
                    Tables\Actions\Action::make('copy_link')
                        ->label('Copy Public Link')
                        ->icon('heroicon-o-link')
                        ->color('info')
                        ->alpineClickHandler(fn (\App\Models\ClientInvoice $record) => "window.navigator.clipboard.writeText('".route('invoices.public', $record->invoice_number)."'); \$tooltip('Copied to clipboard!');"),
                    Tables\Actions\Action::make('download')
                        ->label('Download PDF')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->url(fn (\App\Models\ClientInvoice $record): string => route('invoices.download', $record))
                        ->openUrlInNewTab(),
                    Tables\Actions\EditAction::make(),
                ]),
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
            'index' => Pages\ListClientInvoices::route('/'),
            'create' => Pages\CreateClientInvoice::route('/create'),
            'edit' => Pages\EditClientInvoice::route('/{record}/edit'),
        ];
    }
}

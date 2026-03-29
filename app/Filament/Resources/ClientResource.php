<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationGroup = 'Users & Clients';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Client Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('company_name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->helperText('Leave empty to auto-generate a random password and send via email.')
                            ->maxLength(255)
                            ->dehydrated(fn ($state) => filled($state)),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('SaaS Subscription & Access')
                    ->description('Manage client access, billing cycles, and system access.')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Account Active')
                            ->helperText('If disabled, client cannot login regardless of validity.')
                            ->default(true)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('valid_until')
                            ->label('Subscription Valid Until')
                            ->helperText('Date until the client can access the system. Leave empty for lifetime access.')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->closeOnDateSelection(),
                        Forms\Components\Placeholder::make('status')
                            ->label('Current Status')
                            ->content(function (?Client $record) {
                                if (!$record) return 'New Account';
                                if (!$record->is_active) return 'Suspended';
                                if ($record->valid_until && $record->valid_until->endOfDay()->isPast()) return 'Expired';
                                return 'Active';
                            }),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('valid_until')
                    ->label('Valid Until')
                    ->date('d M Y')
                    ->placeholder('Lifetime')
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('SaaS Status')
                    ->boolean()
                    ->getStateUsing(function (Client $record) {
                        return $record->is_active && ($record->valid_until === null || $record->valid_until->endOfDay()->isFuture());
                    })
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('subscription_status')
                    ->label('Subscription Status')
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_active', true)
                                                        ->where(function ($q) {
                                                            $q->whereNull('valid_until')
                                                              ->orWhere('valid_until', '>=', now()->toDateString());
                                                        }),
                        false: fn (Builder $query) => $query->where('is_active', false)
                                                         ->orWhere('valid_until', '<', now()->toDateString()),
                    )
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('add_month')
                        ->label('Renew 1 Month')
                        ->icon('heroicon-o-calendar-days')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Client $record) {
                            $baseDate = $record->valid_until && $record->valid_until->isFuture()
                                ? $record->valid_until->copy()
                                : now();
                            $record->update(['valid_until' => $baseDate->addMonth(), 'is_active' => true]);
                        }),
                    Tables\Actions\Action::make('add_year')
                        ->label('Renew 1 Year')
                        ->icon('heroicon-o-calendar')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Client $record) {
                            $baseDate = $record->valid_until && $record->valid_until->isFuture()
                                ? $record->valid_until->copy()
                                : now();
                            $record->update(['valid_until' => $baseDate->addYear(), 'is_active' => true]);
                        }),
                    Tables\Actions\Action::make('resend_access_email')
                        ->label('Kirim Ulang Akses')
                        ->icon('heroicon-o-envelope')
                        ->color('info')
                        ->form(self::getAccessEmailFormSchema())
                        ->modalHeading('Kirim ulang email akses client')
                        ->modalDescription('Password client akan direset dan OTP baru akan dikirim ke email client ini.')
                        ->modalSubmitActionLabel('Kirim email akses')
                        ->action(fn (Client $record, array $data) => self::resendAccessEmail($record, $data)),
                    Tables\Actions\Action::make('suspend')
                        ->label('Suspend Account')
                        ->icon('heroicon-o-pause')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn (Client $record) => $record->is_active)
                        ->action(fn (Client $record) => $record->update(['is_active' => false])),
                    Tables\Actions\EditAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getAccessEmailFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('password')
                ->label('Password baru client')
                ->password()
                ->revealable()
                ->maxLength(255)
                ->helperText('Kosongkan untuk generate password acak baru yang akan dikirim bersama OTP ke email client.'),
        ];
    }

    public static function resendAccessEmail(Client $client, array $data = []): void
    {
        try {
            $credentials = $client->refreshAccess($data['password'] ?? null);

            $client->sendAccessEmail($credentials['plain_password']);

            Notification::make()
                ->title('Email akses berhasil dikirim')
                ->body("Password baru dan OTP aktivasi telah dikirim ke {$client->email}.")
                ->success()
                ->send();
        } catch (Throwable $throwable) {
            Notification::make()
                ->title('Gagal mengirim email akses client')
                ->body('Periksa konfigurasi SMTP lalu coba kirim ulang lagi.')
                ->danger()
                ->send();
        }
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}

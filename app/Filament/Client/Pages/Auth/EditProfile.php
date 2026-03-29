<?php

namespace App\Filament\Client\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

use Filament\Forms\Components\ColorPicker;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                TextInput::make('company_name')
                    ->label('Workspace / Business Name')
                    ->helperText('This name will appear on your invoices.')
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('Business Phone Number')
                    ->tel()
                    ->maxLength(255),
                Textarea::make('address')
                    ->label('Business Address')
                    ->helperText('Your official business address shown on invoices.')
                    ->maxLength(65535),
                ColorPicker::make('theme_color')
                    ->label('Invoice Theme Color')
                    ->helperText('Select the primary color for your PDF invoices.')
                    ->default('#4f46e5'),
                FileUpload::make('logo_url')
                    ->label('Brand Logo')
                    ->helperText('Upload your logo to be displayed on your invoices.')
                    ->image()
                    ->directory('client-logos')
                    ->maxSize(1024),
                FileUpload::make('signature_url')
                    ->label('Digital Signature / Stamp')
                    ->helperText('Upload an image of your signature or company stamp (PNG with transparent background recommended).')
                    ->image()
                    ->directory('client-signatures')
                    ->maxSize(1024),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
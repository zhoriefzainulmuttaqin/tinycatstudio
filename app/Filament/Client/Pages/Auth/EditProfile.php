<?php

namespace App\Filament\Client\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                TextInput::make('company_name')
                    ->label('Company Name')
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->maxLength(255),
                Textarea::make('address')
                    ->label('Address')
                    ->maxLength(65535),
                FileUpload::make('logo_url')
                    ->label('Company Logo')
                    ->image()
                    ->directory('client-logos')
                    ->maxSize(1024),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSetting extends CreateRecord
{
    protected static string $resource = SettingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $isImage = str_contains($data['key'] ?? '', 'logo') || str_contains($data['key'] ?? '', 'image');
        if ($isImage) {
            $data['value'] = $data['value_image'] ?? null;
        } else {
            $data['value'] = $data['value_text'] ?? null;
        }
        unset($data['value_image']);
        unset($data['value_text']);
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
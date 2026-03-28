<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $isImage = str_contains($data['key'] ?? '', 'logo') || str_contains($data['key'] ?? '', 'image');
        if ($isImage) {
            $data['value_image'] = $data['value'] ?? null;
        } else {
            $data['value_text'] = $data['value'] ?? null;
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
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

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

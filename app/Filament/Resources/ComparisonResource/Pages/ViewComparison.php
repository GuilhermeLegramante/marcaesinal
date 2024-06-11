<?php

namespace App\Filament\Resources\ComparisonResource\Pages;

use App\Filament\Resources\ComparisonResource;
use App\Utils\ArrayHandler;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewComparison extends ViewRecord
{
    protected static string $resource = ComparisonResource::class;

    public $images = [];

    public $result;

    public $perPage = 30;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $json = file_get_contents($data['resultado']);

        $this->result = json_decode($json);

        $imagesFull = array_slice(ArrayHandler::jsonDecodeEncode($this->result), 0, $this->perPage);

        foreach ($imagesFull as $value) {
            array_push($this->images, 'https://comparacao-imagem.hardsoftsfa.com.br/api/public/storage/brands/' . $value['filename']);
        }

        return $data;
    }

    public function loadMore()
    {
        $this->images = [];

        $this->perPage += 30;

        $imagesFull = array_slice(ArrayHandler::jsonDecodeEncode($this->result), 0, $this->perPage);

        foreach ($imagesFull as $value) {
            array_push($this->images, 'https://comparacao-imagem.hardsoftsfa.com.br/api/public/storage/brands/' . $value['filename']);
        }
    }

    public function loadLess()
    {
        $this->images = [];

        if ($this->perPage > 0) {
            $this->perPage -= 30;

            $this->perPage = $this->perPage > 0 ? $this->perPage : 5;

            $imagesFull = array_slice(ArrayHandler::jsonDecodeEncode($this->result), 0, $this->perPage);

            foreach ($imagesFull as $value) {
                array_push($this->images, 'https://comparacao-imagem.hardsoftsfa.com.br/api/public/storage/brands/' . $value['filename']);
            }
        }
    }

    public function teste($uuid)
    {
        $this->dispatch('open-modal', id: 'edit-user');
    }
}

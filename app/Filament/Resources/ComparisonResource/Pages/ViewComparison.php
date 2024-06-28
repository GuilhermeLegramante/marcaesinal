<?php

namespace App\Filament\Resources\ComparisonResource\Pages;

use App\Filament\Resources\ComparisonResource;
use App\Models\BrandGeneral;
use App\Utils\ArrayHandler;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewComparison extends ViewRecord
{
    protected static string $resource = ComparisonResource::class;

    public $images = [];

    public $result;

    public $perPage = 30;

    public $brand = [];

    public $isLoading = false;

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

    public function showDetails($path)
    {
        $this->isLoading = true;

        $array = explode('/', $path);

        $filename = end($array);

        $search = BrandGeneral::where('path', 'like', '%' . $filename . '%')->get()->first();

        $this->brand['number'] = $search->number;
        $this->brand['year'] = $search->year;
        $this->brand['path'] = $search->path;
        $this->brand['farmer_name'] = $search->farmer_name;
        $this->brand['client_name'] = $search->client_name;
        $this->brand['farmer_phone'] = $search->farmer_phone;

        $this->dispatch('open-modal', id: 'brand-details');

        $this->isLoading = false;
    }
}

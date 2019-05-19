<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class RegistryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "when" => $this->when,
            "O3" => (double)$this->O3,
            "NO" => (double)$this->NO,
            "NO2" => (double)$this->NO2,
            "NOx" => (double)$this->NOx,
            "CO" => (double)$this->CO,
            "SO2" => (double)$this->SO2,
            "PM25" => (double)$this->PM25,
        ];
    }
}

<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'manufacturer' => $this->manufacturer,
            'status'       => $this->status,
            'type'         => $this->type,
            'power'        => $this->power,
            'image'        => $this->img ? Storage::url($this->img) : null,
            'created_at'   => $this->created_at?->toISOString(),
        ];
    }
}

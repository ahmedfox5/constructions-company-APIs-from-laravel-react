<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    // public static $wrap = 'about';

    public function toArray($request)
    {
        // return parent::toArray($request);
        
        return  [
                'id' => $this->id,
                'name' => $this->name,
                'title' => $this->title,
                'description' => $this->description,
                'img' => $this->img,
            ];
    }
}

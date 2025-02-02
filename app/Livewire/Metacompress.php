<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Event;
use Livewire\Component;
use Illuminate\support\Facades\Storage;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Drivers\Gd\Driver;


class Metacompress extends Component
{
    use WithFileUploads;
    public $image;
    public $size;
    public $quality;
    public $filetype;

    public function render()
    {
        return view('livewire.metacompress');
    }

    public function compressImage()
    {
        $this->validate([
            'image' => 'required|image',
            'quality' => 'numeric|min:50|max:100'
        ]);

        if ($this->image) {
            $path = $this->image->getRealPath();
            $image = Image::gd()->read($path);
            $quality = !empty($this->quality) ? (int)$this->quality : 90;
            $image->toWebp($quality);
            //$image->encode(new WebpEncoder(quality: $quality));
            //$image->resize(200, 200);
            //$image->scaleDown(400, 300);

            $compressedPath = storage_path('app/public/compressed_image.webp');
            $image->save($compressedPath);

            return response()->download($compressedPath);
        } else {
            session()->flash('error', 'No image uploaded.');
        }
    }
}

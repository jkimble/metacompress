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

    public function render()
    {
        return view('livewire.metacompress');
    }

    public function compressImage()
    {
        $this->validate([
            'image' => 'required|image',
        ]);

        if ($this->image) {
            $path = $this->image->getRealPath();
            //$image = Image::imagick()->read($path);
            $image = Image::gd()->read($path);
            $image->toWebp(70);
            //$image->encode(new WebpEncoder(quality: 65));
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

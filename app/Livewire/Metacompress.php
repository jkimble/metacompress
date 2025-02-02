<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Event;
use Livewire\Component;
use Illuminate\support\Facades\Storage;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;
//use Intervention\Image\Facades\Image as Image;


class Metacompress extends Component
{
    public $image;
    use WithFileUploads;

    public function render()
    {
        return view('livewire.metacompress');
    }

    public function store()
    {
        $this->validate([
            'image' => 'required|image',
        ]);
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
            $image->resize(200, 200);
            //$image = Image::make($path)->encode('jpg', 75); // Adjust the quality here (0-100)

            $compressedPath = storage_path('app/public/compressed_image.jpg');
            $image->save($compressedPath);

            return response()->download($compressedPath);
        } else {
            session()->flash('error', 'No image uploaded.');
        }
    }
}

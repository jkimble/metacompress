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
            'quality' => 'numeric|min:20|max:100'
        ]);

        if ($this->image) {
            $path = $this->image->getRealPath();
            $image = Image::gd()->read($path);
            $quality = !empty($this->quality) ? (int)$this->quality : 90;
            $filetype = !empty($this->filetype) ? $this->filetype : 'webp'; //default webp till I get file type from inpot
            $compressedPath = storage_path('app/public/compressed_image.' . $filetype); //will use dynamic path, delete with cron. need logic, add image ids
            switch ($filetype) {
                case 'webp':
                    $image->toWebp($quality)->save($compressedPath);
                    break;
                case 'png':
                    $image->toPng(interlaced: true)->save($compressedPath);
                    break;
                case 'jpeg':
                    //$image->encodeByExtension('jpeg', progressive: true, quality: $quality);
                    $image->toJpeg($quality, progressive:true)->save($compressedPath); //saving needs better logic, ids
                    break;
                default:
                    $image->encodeByExtension(quality: $quality);
                    break;
            }
            //$image->resize(200, 200);
            //$image->scaleDown(400, 300);
            //$image->save($compressedPath, $quality);

            return response()->download($compressedPath);
        } else {
            session()->flash('error', 'No image uploaded.');
        }
    }
}

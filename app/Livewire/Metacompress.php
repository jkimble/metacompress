<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager as Image;


class Metacompress extends Component
{
    use WithFileUploads;
    public $image;
    public $image_loc;
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

            $clientFileName = $this->image->hashName();
            $clientFileType = $this->image->extension();
            $clientFileOGName = $this->image->getClientOriginalName();
            $nameStripped = substr($clientFileOGName, 0, strrpos($clientFileOGName, '.'));

            $quality = !empty($this->quality) ? (int)$this->quality : 90;
            $inputFileType = !empty($this->filetype) ? $this->filetype : $clientFileType;
            $compressedPath = storage_path('app/public/' . $nameStripped . '.' . $inputFileType);
            $this->image_loc = $compressedPath;

            switch ($inputFileType) {
                case 'webp':
                    $image->toWebp($quality)->save($compressedPath);
                    break;
                case 'png':
                    $image->toPng(indexed: true)->save($compressedPath);
                    break;
                case 'jpeg':
                    $image->toJpeg($quality, progressive: true)->save($compressedPath); //saving needs better logic, ids
                    break;
                default:
                    $image->encodeByExtension($clientFileType, quality: $quality)->save($compressedPath);
                    break;
            }
        } else {
            session()->flash('error', 'No image uploaded.');
        }
    }

    public function downloadImage()
    {
        if (!empty($this->image_loc)) {
            // return response()->streamDownload(function () {
            //     echo file_get_contents(storage_path('app/' . $this->image_loc));
            // }, basename($this->image_loc));
            return response()->download($this->image_loc);
        }

        session()->flash('error', 'No image found.');
    }
}

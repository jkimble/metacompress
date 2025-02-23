<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
//use Intervention\Image\ImageManager as Image;
use Intervention\Image\Laravel\Facades\Image;


class Metacompress extends Component
{
    use WithFileUploads;
    public $image;
    public $image_loc;
    public $quality;
    public $filetype;
    public $ogFilename;
    public $ogHashStrip;
    public $extension;
    public $conversion;

    public function render()
    {
        return view('livewire.metacompress');
    }

    public function compressImage()
    {
        $this->validate([
            'image' => 'required|image',
            'quality' => 'numeric|min:20|max:100',
            'filetype' => 'required'
        ]);

        if ($this->image) {
            $path = $this->image->getRealPath();
            $image = Image::gd()->read($path);

            $this->ogHashStrip = $this->image->hashName();
            $this->ogFilename = $this->image->getClientOriginalName();
            $this->ogFilename = substr($this->ogFilename, 0, strrpos($this->ogFilename, '.'));
            $this->ogHashStrip = substr($this->ogHashStrip, 0, strrpos($this->ogHashStrip, '.'));

            $this->extension = $this->image->extension();

            $quality = !empty($this->quality) ? (int)$this->quality : 90;
            $inputFileType = !empty($this->filetype) ? $this->filetype : $this->extension;
            $this->conversion = $inputFileType;
            $compressedPath = storage_path('app/public/' . $this->ogHashStrip . '.' . $this->conversion);
            $this->image_loc = $compressedPath;


            switch ($inputFileType) {
                case 'webp':
                    $image->toWebp($quality)->save($compressedPath);
                    break;
                case 'png':
                    $image->toPng(indexed: true)->save($compressedPath);
                    break;
                case 'jpeg':
                    $image->toJpeg($quality, progressive: true)->save($compressedPath);
                    break;
                default:
                    $image->encodeByExtension($inputFileType, quality: $quality)->save($compressedPath);
                    break;
            }
        } else {
            session()->flash('error', 'No image uploaded.');
        }
    }

    public function downloadImage()
    {
        if (!empty($this->image_loc)) {
            return response()->download($this->image_loc, $this->ogFilename . '.' . $this->conversion)->deleteFileAfterSend();
        }

        session()->flash('error', 'No image found.');
    }
}

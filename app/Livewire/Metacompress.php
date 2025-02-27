<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
    public $downloaded = false;

    public function render()
    {
        return view('livewire.metacompress');
    }

    public function compressImage()
    {
        $this->validate([
            'image' => 'required|image',
            'quality' => 'numeric|min:20|max:100',
        ]);

        if ($this->image) {
            $path = $this->image->getRealPath();
            $image = Image::read($path);


            $this->ogHashStrip = $this->image->hashName();
            $this->ogFilename = $this->image->getClientOriginalName();
            $this->ogFilename = substr($this->ogFilename, 0, strrpos($this->ogFilename, '.'));
            $this->ogHashStrip = substr($this->ogHashStrip, 0, strrpos($this->ogHashStrip, '.'));

            $this->extension = $this->image->extension();

            $quality = !empty($this->quality) ? (int)$this->quality : 90;
            $inputFileType = !empty($this->filetype) ? $this->filetype : $this->extension;
            $this->conversion = $inputFileType;
            $compressedPath = $this->ogFilename . '.' . $inputFileType;
            $this->image_loc = $compressedPath;


            switch ($inputFileType) {
                case 'webp':
                    Storage::disk('public')->put($compressedPath, $image->toWebp($quality));
                    break;
                case 'jpeg':
                    Storage::disk('public')->put($compressedPath, $image->toJpeg($quality, progressive: true));
                    break;
                default:
                    Storage::disk('public')->put($compressedPath, $image->encodeByExtension($inputFileType, quality: $quality));
                    break;
            }
        } else {
            session()->flash('error', 'No image uploaded.');
        }
    }

    public function downloadImage()
    {
        if (!empty($this->image_loc)) {
            $this->downloaded = true;
            File::cleanDirectory(Storage::disk('local')->path('livewire-tmp'));
            return Response::download(Storage::disk('public')->path($this->image_loc), $this->ogFilename . '.' . $this->conversion)->deleteFileAfterSend(true);
        }

        session()->flash('error', 'No image found.');
    }

    public function deleteImage()
    {
        if (Storage::disk('public')->exists($this->image_loc)) {
            Storage::disk('public')->delete($this->image_loc);
        }

        if (!File::isEmptyDirectory(Storage::disk('local')->path('livewire-tmp'))) {
            File::cleanDirectory(Storage::disk('local')->path('livewire-tmp'));
        }
    }
}

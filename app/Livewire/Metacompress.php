<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;


class Metacompress extends Component
{
    use WithFileUploads;
    public $image;
    public $imgPath;
    public $quality;
    public $filetype;
    public $ogFilename;
    public $ogHashStrip;
    public $extension;
    public $conversion;
    public $downloaded = false;
    public $name_f;

    public function render()
    {
        return view('livewire.metacompress');
    }

    public function compressImage()
    {

        $this->validate([
            'image' => 'required|image|max:5000|mimes:png,jpg,jpeg,webp,avif',
            'quality' => 'numeric|min:20|max:100',
            'name_f' => 'prohibited'
        ]);

        if ($this->image && empty($this->name_f)) {
            $path = $this->image->getRealPath();
            $newImg = Image::read($path);


            $hash = $this->image->hashName();
            $clientName = htmlspecialchars($this->image->getClientOriginalName(), ENT_SUBSTITUTE | ENT_QUOTES);
            $extension = $this->image->extension();
            $this->ogFilename = substr($clientName, 0, strrpos($clientName, '.'));
            $this->ogHashStrip = substr($hash, 0, strrpos($hash, '.'));


            $quality = !empty($this->quality) ? (int)$this->quality : 90;
            $this->conversion = !empty($this->filetype) ? $this->filetype : $extension;
            $imgPath = $this->ogHashStrip . '.' . $this->conversion;


            switch ($this->conversion) {
                case 'webp':
                    Storage::disk('public')->put($imgPath, $newImg->toWebp($quality));
                    break;
                case 'jpeg':
                    Storage::disk('public')->put($imgPath, $newImg->toJpeg($quality, progressive: true));
                    break;
                case 'avif':
                    Storage::disk('public')->put($imgPath, $newImg->toAvif($quality));
                    break;
                default:
                    Storage::disk('public')->put($imgPath, $newImg->encodeByExtension($this->conversion, quality: $quality));
                    break;
            }

            $this->imgPath = $imgPath;
        } else {
            session()->flash('error', 'No image uploaded.');
        }
    }

    public function downloadImage()
    {
        if (!empty($this->imgPath)) {
            $this->downloaded = true;
            File::cleanDirectory(Storage::disk('local')->path('livewire-tmp'));
            return Response::download(Storage::disk('public')->path($this->imgPath), $this->ogFilename . '.' . $this->conversion)->deleteFileAfterSend(true);
        }

        session()->flash('error', 'No image found.');
    }

    public function deleteImage()
    {
        if (Storage::disk('public')->exists($this->imgPath)) {
            Storage::disk('public')->delete($this->imgPath);
        }

        if (!File::isEmptyDirectory(Storage::disk('local')->path('livewire-tmp'))) {
            File::cleanDirectory(Storage::disk('local')->path('livewire-tmp'));
        }
    }
}

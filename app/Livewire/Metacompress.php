<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;


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

    public $rules = [
        'quality' => 'required|numeric|min:10|max:100',
        'image' => 'required|file|image|max:2000|mimes:png,jpg,jpeg,webp,avif|extensions:png,jpg,jpeg,webp,avif',
    ];

    public function updatedQuality()
    {
        $this->validateOnly('quality');
    }

    public function updatedImage() {
        $this->validateOnly('image');
    }

    public function compressImage()
    {

        $this->validate([
            'image' => 'required|image|max:2000|mimes:png,jpg,jpeg,webp,avif',
            'quality' => 'required|numeric|min:10|max:100',
            'name_f' => 'prohibited'
        ]);

        if ($this->image && empty($this->name_f)) {
            $newImg = Image::read($this->image->getRealPath());

            $hash = $this->image->hashName();
            $clientName = htmlspecialchars($this->image->getClientOriginalName(), ENT_SUBSTITUTE | ENT_QUOTES);
            $extension = $this->image->extension();
            $this->ogFilename = substr($clientName, 0, strrpos($clientName, '.'));
            $this->ogHashStrip = substr($hash, 0, strrpos($hash, '.'));

            $quality = !empty($this->quality) ? (int)$this->quality : 90;
            $this->conversion = !empty($this->filetype) ? $this->filetype : $extension;
            $imgPath = 'livewire-tmp/' . $this->ogHashStrip . '.' . $this->conversion;


            switch ($this->conversion) {
                case 'webp':
                    Storage::put($imgPath, $newImg->toWebp($quality));
                    break;
                case 'jpeg':
                    Storage::put($imgPath, $newImg->toJpeg($quality, progressive: true));
                    break;
                case 'avif':
                    Storage::put($imgPath, $newImg->toAvif($quality));
                    break;
                default:
                    Storage::put($imgPath, $newImg->encodeByExtension($this->conversion, quality: $quality));
                    break;
            }

            $this->imgPath = $imgPath;
        } else {
            $this->addError('image', 'The uploaded file exceeds the max allowed size of 5MB.');
        }
    }

    public function downloadImage()
    {
        if (!empty($this->imgPath)) {
            $this->downloaded = true;
            File::delete($this->image->getRealPath());
            return Response::download(Storage::path($this->imgPath), $this->ogFilename . '.' . $this->conversion)->deleteFileAfterSend();
        }

        session()->flash('error', 'No image found.');
    }
}

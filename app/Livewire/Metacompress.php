<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Masmerise\Toaster\Toaster;
use Masmerise\Toaster\ToasterHub;

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
    public $downloaded;
    public $name_f;
    public $alert;
    public $result;

    public function render()
    {
        return view('livewire.metacompress');
    }

    public function compressImage()
    {
        $this->validate([
            'image' => 'required|image|file|max:5000|mimes:png,jpg,jpeg,webp,tiff|extensions:png,jpg,jpeg,webp,tiff',
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
                case 'tiff':
                    Storage::put($imgPath, $newImg->toTiff($quality));
                    break;
                case 'png':
                    Storage::put($imgPath, $newImg->toPng(indexed: true));
                    break;
                case 'avif':
                    Storage::put($imgPath, $newImg->toAvif($quality));
                    break;
                default:
                    Storage::put($imgPath, $newImg->encodeByExtension($this->conversion));
                    break;
            }

            $this->imgPath = $imgPath;

            if (Storage::fileSize($imgPath) >= $this->image->getSize()) {
                File::delete($this->image->getRealPath());
                Storage::delete($imgPath);
                $this->reset();
                Toaster::error('New image larger than original. Both images have been deleted.');
            }
        } else {
            Toaster::error('There was an issue uploading this image.');
        }
    }

    public function downloadImage()
    {
        if (!empty($this->imgPath)) {
            $this->downloaded = true;
            File::delete($this->image->getRealPath());
            Toaster::success('Image compressed and deleted!');
            return Response::download(Storage::path($this->imgPath), $this->ogFilename . '.' . $this->conversion)->deleteFileAfterSend();
        }
        Toaster::error('No image found.');
    }

    public function resetForm() {
        $this->reset();
    }

    public function incompleteReset() {
        if (!empty($this->image) && File::exists($this->image->getRealPath())) {
            File::delete($this->image->getRealPath());
            $message = 'Uploaded image deleted.';
        }

        if (!empty($this->imgPath) && Storage::exists($this->imgPath)) {
            Storage::delete($this->imgPath);
            $message = 'Images deleted.';
        }

        if (isset($message)) {
            Toaster::info($message);
        }

        $this->reset();
    }
}

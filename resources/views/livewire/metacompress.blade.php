<div class="relative isolate font-montserrat">
    <div class="flex items-center justify-center gap-x-6">
        <form class="bg-base-200 px-4 py-6 border border-primary rounded-lg text-primary-content" wire:submit.prevent="compressImage" id="compress">
            <div id="form_body">
                <div class="flex flex-col md:flex-row gap-6 justify-between">
                    <div class="field">
                        <label for="file" class="block">Image</label>
                        <input type="file" wire:model.blur="image" accept=".png,.jpg,.jpeg,.webp" max="100" min="10" id="file" class="file-input file-input-primary file-input-bordered cursor-pointer w-full mb-1">
                        <span class="block text-xs label-text text-white mb-1">Accepted file types: png, jpg, jpeg, webp</span>
                        <span class="block text-xs label-text text-white">Max file size: 5MB</span>
                        @error('image')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="quality" class="block">Image Quality</label>
                        <input id="quality" wire:model.blur='quality' type="number" class="input" placeholder="90%" />
                        @error('quality')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="field">
                    <label>Convert Image To:</label>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <div class="form-control">
                            <label>
                                <input type="radio" value="" wire:model='filetype' name="radio-type" class="radio" checked="checked" />
                                <span class="label-text">Leave as is</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <label>
                                <input type="radio" value="webp" wire:model='filetype' name="radio-type" class="radio" />
                                <span class="label-text">WebP</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <label>
                                <input type="radio" value="jpeg" wire:model='filetype' name="radio-type" class="radio" />
                                <span class="label-text">JPEG</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <label>
                                <input type="radio" value="avif" wire:model='filetype' name="radio-type" class="radio" />
                                <span class="label-text">AVIF</span>
                            </label>
                        </div>
                    </div>
                    @error('filetype')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="field hidden">
                    <label for="name" class="block">Name</label>
                    <input id="name" wire:model='name_f' type="text" class="input hidden" />
                </div>
            </div>
            <div class="flex flex-row items-center gap-4">
                <button type="submit" class="w-fit" {{ $imgPath ? 'disabled' : '' }}>
                    Compress Image
                </button>
                <div wire:loading wire:target='compressImage'>
                    <span class="loading loading-spinner loading-xs"></span>
                </div>
            </div>
            <div class="flex flex-row items-baseline justify-center md:justify-start gap-4 mt-4">
                <button type="button" wire:click='incompleteReset' class="mt-6 group {{ !empty($image) && !$downloaded ? 'block' : 'hidden' }}">
                    <span class="font-semibold flex flex-row flex-nowrap gap-2 group-hover:text-error group-focus:text-error transition-colors">
                        Reset
                    </span>
                </button>

                @if($imgPath && !$downloaded)
                    <button type="button" wire:click='downloadImage' class="btn btn-secondary border-2 border-secondary bg-transparent w-fit {{ $imgPath ? 'opacity-100' : 'opacity-0' }}" {{ $downloaded ? 'disabled' : '' }}>Download Image</button>
                @endif

                @if($downloaded)
                    <button type="button" wire:click='resetForm' class="btn btn-primary border-2 border-primary w-fit">Convert another image</button>
                @endif
            </div>
        </form>
    </div>
</div>

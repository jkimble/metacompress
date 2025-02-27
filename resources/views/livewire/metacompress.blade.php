<div>
    <div>
        <div class="relative isolate font-montserrat">
          <div>
            <div class="text-left">
              <div class="flex items-center justify-center gap-x-6">
                <form class="bg-base-200 px-4 py-6 border border-primary rounded-lg text-primary-content" wire:submit.prevent="compressImage" id="compress">
                  <div id="form_body">
                    <div class="flex flex-col md:flex-row gap-6 justify-between">
                      <div class="field">
                          <label for="file" class="block">Image</label>
                          <input type="file" wire:model="image" accept="image/*" id="file" class="file-input file-input-primary file-input-bordered cursor-pointer w-full">
                          @error('image')
                            <span class="error">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="field">
                          <label for="quality" class="block">Image Quality</label>
                          <input id="quality" wire:model='quality' type="number" class="input" min="0" placeholder="90%" />
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
                      </div>
                      @error('filetype')
                          <span class="error flex-[1_1_100%]">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="flex flex-row gap-4">
                    <button type="submit">
                        Compress Image
                        <div wire:loading>
                        <span class="loading loading-spinner loading-xs"></span>
                        </div>
                    </button>
                </div>
                </form>
              </div>
                <div class="flex flex-row gap-4">
                    @if($image_loc)
                        <button wire:click='downloadImage' class="btn btn-secondary border-2 border-secondary bg-transparent {{ !empty($image_loc) ? 'opacity-100' : 'opacity-0' }}">Download Image</button>
                    @endif
                </div>
            </div>
          </div>
        </div>
    </div>
</div>

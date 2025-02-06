<div>
    <div class="bg-slate-400">
        <div class="relative isolate px-6 lg:px-8">
          <div class="mx-auto max-w-2xl py-12 ">
            <div class="text-left">
              <h1 class="text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">metacompress</h1>
              <p class="mt-4 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">
                Image conversion and compression run locally on your browser.
                <span class="block text-xs font-bold">*dev testing. results are not guaranteed.*</span>
                <span class="block text-xs font-bold">*png does not work well. use at your own discretion.*</span>
              </p>
              <div class="mt-10 flex items-center justify-center gap-x-6">
                <form wire:submit.prevent="compressImage" id="compress">
                    <div id="form_body">
                      <div class="field">
                        <label for="file" class="block">Image Quality</label>
                        <input type="file" wire:model="image" accept="image/*" id="file" class="file-input file-input-bordered cursor-pointer w-full">
                      </div>
                      <div class="field">
                        <label for="quality" class="block">Image Quality</label>
                        <input id="quality" wire:model='quality' type="number" class="input" placeholder="90%" />
                      </div>
                      <div class="field">
                        <label>Convert Image To:</label>
                        <div class="flex flex-col gap-2">
                            <div class="form-control">
                                <label>
                                  <input type="radio" value="same" wire:model='filetype' name="radio-type" class="radio" checked="checked" />
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
                                  <input type="radio" value="png" wire:model='filetype' name="radio-type" class="radio" />
                                  <span class="label-text">PNG</span>
                                </label>
                            </div>
                            <div class="form-control">
                                <label>
                                  <input type="radio" value="jpeg" wire:model='filetype' name="radio-type" class="radio" />
                                  <span class="label-text">JPEG</span>
                                </label>
                            </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="">Compress Image</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

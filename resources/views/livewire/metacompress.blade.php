<div>
    <div class="bg-white">
        <div class="relative isolate px-6 pt-14 lg:px-8">
          <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-1155/678 w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
          </div>
          <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
            <div class="text-left">
              <h1 class="text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">metacompress</h1>
              <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">
                Image editor and compressor run locally on your browser.
              </p>
              <div class="mt-10 flex items-center justify-center gap-x-6">
                <form wire:submit.prevent="compressImage" class="w-full">
                    <div id="form_body" class="flex flex-col gap-4 mb-6">
                        <input type="file" wire:model="image" accept="image/*" class="file-input file-input-bordered">
                        <div class="field">
                            <label for="quality" class="block">Image Quality</label>
                            <input id="quality" wire:model='quality' type="number" class="input" min="50" max="100" placeholder="90" />
                        </div>
                        <div class="field">
                            <label>Convert Image To:</label>
                            <div class="flex flex-row">
                                <div class="form-control">
                                    <label class="label cursor-pointer">
                                      <span class="label-text">Leave as is</span>
                                      <input type="radio" wire:model='filetype' name="radio-type" class="radio" checked="checked" />
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="label cursor-pointer">
                                      <span class="label-text">WebP</span>
                                      <input type="radio" wire:model='filetype' name="radio-type" class="radio" />
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="label cursor-pointer">
                                      <span class="label-text">PNG</span>
                                      <input type="radio" wire:model='filetype' name="radio-type" class="radio" />
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="label cursor-pointer">
                                      <span class="label-text">JPEG</span>
                                      <input type="radio" wire:model='filetype' name="radio-type" class="radio" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Compress Image</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

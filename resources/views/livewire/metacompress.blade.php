<div>
    <h1>Hello, World!</h1>
    <div>
        <form wire:submit.prevent="compressImage">
            <input type="file" wire:model="image" accept="image/*">
            <button type="submit">Compress Image</button>
        </form>
    </div>

</div>

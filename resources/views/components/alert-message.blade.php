<div class="absolute top-1 right-5">
    <div class="flex gap-3">
        <p id="message" class=" px-10 py-2 {{ $attributes['additional'] }} rounded-lg text-white">
            {{ Session::get($attributes['session']) }}
        </p>
    </div>
</div>

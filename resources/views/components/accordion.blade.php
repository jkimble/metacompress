@props(['title', 'checked'])
<div class="collapse collapse-arrow bg-base-200 border border-primary mb-4 last:mb-0">
    <input type="radio" name="faq_accordion" {{ !empty($checked) ? 'checked=' . $checked : '' }} />
    <div class="collapse-title text-xl font-medium">{{ $title ?? 'Accordion Title' }}</div>
    <div class="collapse-content">
      {{ $slot }}
    </div>
</div>

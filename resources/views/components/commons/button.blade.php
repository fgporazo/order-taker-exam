<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-block btn-outline-primary']) }}>
    {{ $slot }}
</button>

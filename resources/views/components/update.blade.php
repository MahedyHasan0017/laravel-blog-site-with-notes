<p> 
    {{ empty(trim($slot)) ? 'Added in ' : $slot }}  {{ $date->diffForHumans() }} 
    @if (isset($name))
        by {{ $name }}
    @endif 
</p>
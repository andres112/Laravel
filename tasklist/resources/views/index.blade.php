{{-- Create a simple Home page template in blade.php file. --}}
<h1>Welcome to the {{ $title }}</h1>

<h2 style="display: inline-flex; gap: 1rem; align-items: center;">
    @if(request()->has('code'))
        <img src="https://flagcdn.com/{{ strtolower(request('code')) }}.svg" alt="{{ strtoupper(request('code')) }} Flag" width="300">
    @else
    Country: {{ $country }}
    @endif
</h2>

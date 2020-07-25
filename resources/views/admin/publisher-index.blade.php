{{-- Just for test --}}
<div class="container">
    @foreach ($publisher as $pub)
        {{ $pub->first_name }}<br>
    @endforeach
</div>

 {{ $publisher  ->links() }}

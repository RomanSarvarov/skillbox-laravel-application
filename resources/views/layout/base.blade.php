@include('layout.template-parts.header')

@include('layout.template-parts.nav')

<main role="main" class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            @yield('content')
        </div>

        @section('sidebar')
            @include('layout.template-parts.sidebar')
        @show
    </div>
</main>

@include('layout.template-parts.footer')

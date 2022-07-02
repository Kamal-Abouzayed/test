@include('partials.header')
@include('partials.messages')
@include('partials.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @include('partials.navbar')
            <div class="container">
                @yield('content')
            </div>    
        </div>

    </div>
    <!-- End of Content Wrapper -->
@include('partials.footer')
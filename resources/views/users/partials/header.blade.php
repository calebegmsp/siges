<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center mt--6" style="text-shadow: 10px 10px 15px white, 0 0 2em white, 0 0 0.5em white ">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                <h1 class="display-2 ">{{ $title }}</h1>
                @if (isset($description) && $description)
                    <p class="mt-0 mb-5">{{ $description }}</p>
                @endif
            </div>
        </div>
    </div>
</div> 
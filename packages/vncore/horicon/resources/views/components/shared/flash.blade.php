@if (session()->has('message'))
    <div class="alert alert-success">
        @lang(session()->get('message'))
    </div>
@endif
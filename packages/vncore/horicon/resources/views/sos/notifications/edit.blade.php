@extends('horicon::layouts.app')

@section('title', __('Chỉnh thông báo'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.sos.notifications.index') }}">
                            <i class="fa fa-home"></i> @lang('Thông báo')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Chỉnh thông báo')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Thông báo')</h1>
        </header>
        <!-- /.page-title-bar -->

        <!-- .page-section -->
        <div class="page-section">
            <!-- .card -->
            <section class="card">
                <!-- .card-body -->
                <div class="card-body">
                    {{ Form::flash() }}
                    {{ Form::wysiwyg() }}

                    <!-- form -->
                    {!! Form::model($notification, ['url' => $notification->url()->update(), 'files' => true, 'class' => '']) !!}
                        @method('PUT')
                        {{ Form::field('text', __('Thông báo'), 'title', ['required']) }}
                        {{ Form::field('text', __('Đường dẫn'), 'link', []) }}
                        {{ Form::field('area', __('Nội dung'), 'text', ['required', 'id' => 'content-container']) }}
                        {{ Form::field('file', __('Ảnh'), 'document', ['id' => 'imageUpload']) }}

                        <div class="form-group row">
                            <label for="document" class="col-form-label text-right col-sm-2"></label>

                            <div class="col-sm-10">
                                <img src="{{ $notification->present()->document }}" style="max-width: 500px"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="text" class="col-form-label text-right col-sm-2"></label>

                            <div class="col-sm-10">
                                <div class="avatar-preview">
                                    <img id="imagePreview" />
                                </div>
                            </div>
                        </div>

                        <hr>
                        <!-- .form-actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                        </div>
                        <!-- /.form-actions -->
                    {!! Form::close() !!}
                    <!-- /form -->
                </div>
                <!-- /.card-body -->
            </section>
            <!-- /.card -->
        </div>
        <!-- /.page-section -->
    </div>
    <!-- /.page-inner -->

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function ($) {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr("src", e.target.result);
                        //$('#imagePreview').hide();
                        //$('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imageUpload").change(function() {
                readURL(this);
            });
        });
    </script>
@endpush

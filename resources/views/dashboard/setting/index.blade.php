@extends('layouts.dashboard.app')
@section('title')
    {{ $title }}
@endsection
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ $title }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active">@lang('site.setting')</li>
            </ol>
        </section><!-- end of content header -->

        <section class="content">

            {{--            @include('partials._errors')--}}

            <div class="box box-primary">
                {{--                <div class="box-header with-border">--}}
                {{--                    <div class="col-md-4">--}}
                {{--                        <a href="{{ route('dashboard.index')}}"--}}
                {{--                           class="btn btn-primary btn-sm" title="@lang('site.back')">--}}
                {{--                            <i class="fa fa-rotate-left"></i></a>--}}
                {{--                    </div>--}}
                {{--                </div><!-- end of box header -->--}}

                <div class="box-body">

                    <form method="POST" action="{{ route('dashboard.settings.update',setting()->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="form-group">
                            <label for="site_name_ar">@lang('site.site_name_ar')</label>
                            <input type="text" name="site_name_ar" id="site_name_ar" class="form-control"
                                   value="{{ old('site_name_ar',setting()->site_name_ar) }}"
                                   placeholder="@lang('site.site_name_ar')" required>
                            @error('site_name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="site_name_en">@lang('site.site_name_en')</label>
                            <input type="text" name="site_name_en" id="site_name_en" class="form-control"
                                   value="{{ old('site_name_en',setting()->site_name_en) }}"
                                   placeholder="@lang('site.site_name_en')" required>
                            @error('site_name_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="email">@lang('site.email')</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   value="{{ old('email',setting()->email) }}" placeholder="@lang('site.email')"
                                   required>
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="logo">@lang('site.logo')</label>
                            <input type="file" name="logo" id="logo" class="form-control">
                            @error('logo')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <img class="img-responsive" style="width:100px" alt="@lang('site.lgo')"
                                 src="{{ setting()->logo_path }}">
                        </div>

                        <div class="form-group">
                            <label for="icon">@lang('site.icon')</label>
                            <input type="file" name="icon" id="icon" class="form-control">
                            @error('icon')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <img class="img-responsive" style="width:100px" alt="@lang('site.icon')"
                                 src="{{ setting()->icon_path }}">
                        </div>

                        <div class="form-group">
                            <label for="description">@lang('site.description')</label>
                            <textarea class="form-control" id="description" name="description"
                                      placeholder="@lang('site.description')">{{ setting()->description }}</textarea>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="keywords">@lang('site.keywords')</label>
                            <textarea class="form-control" id="keywords" name="keywords"
                                      placeholder="@lang('site.keywords')">{{ setting()->keywords }}</textarea>
                            @error('keywords')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="main_lang">@lang('site.main_lang')</label>
                            <select class="form-control" id="main_lang" name="main_lang">
                                <option value="">@lang('site.main_lang')</option>
                                <option value="ar" {{ setting()->main_lang == 'ar' ? 'selected' : '' }}>@lang('site.ar')</option>
                                <option value="en" {{ setting()->main_lang == 'en' ? 'selected' : '' }}>@lang('site.en')</option>
                            </select>
                            @error('main_lang')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="status">@lang('site.status')</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">@lang('site.status')</option>
                                <option value="open" {{ setting()->status == 'open' ? 'selected' : '' }}>@lang('site.open')</option>
                                <option value="close" {{ setting()->status == 'close' ? 'selected' : '' }}>@lang('site.close')</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="message_maintenance">@lang('site.message_maintenance')</label>
                            <textarea class="form-control" id="message_maintenance" name="message_maintenance"
                                      placeholder="@lang('site.message_maintenance')">{{ setting()->message_maintenance }}</textarea>
                            @error('message_maintenance')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <input type="submit" value="@lang('site.update')" class="btn btn-primary btn-block">
                        </div>

                    </form>

                </div><!-- /.box-body -->
            </div><!-- end of box primary -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

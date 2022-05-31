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
                <li><a href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section><!-- end of content header -->

        <section class="content">

            @include('partials._errors')

            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="col-md-4">
                        <a href="{{ route('dashboard.clients.index')}}"
                           class="btn btn-primary btn-sm" title="@lang('site.back')">
                            <i class="fa fa-rotate-left"></i></a>
                    </div>
                </div><!-- end of box header -->

                <div class="box-body">

                    <form method="POST" action="{{ route('dashboard.clients.update',$client->id)}}">
                        @csrf
                        @method('patch')

                        <div class="form-group">
                            <label for="name">@lang('site.name')</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ $client->name }}" placeholder="@lang('site.name')" required>
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        @for($i = 0; $i < 2 ; $i++)
                            <div class="form-group">
                                <label for="phone">@lang('site.phone')</label>
                                <input type="text" name="phone[]" id="phone" class="form-control"
                                       placeholder="@lang('site.phone')" value="{{ $client->phone[$i] ?? '' }}"
                                @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        @endfor

                        <div class="form-group">
                            <label for="email">@lang('site.email')</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   value="{{ $client->email }}" placeholder="@lang('site.email')" required>
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="address">@lang('site.address')</label>
                            <input type="text" name="address" id="address" class="form-control"
                                   value="{{ $client->address }}" placeholder="@lang('site.address')" required>
                            @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            @if(auth()->user()->hasPermission('clients_update'))
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-edit"></i> @lang('site.update')
                                </button>
                            @else
                                <a class="btn btn-primary btn-block disabled"><i class="fa fa-edit"></i> @lang('site.update')</a>
                            @endif
                        </div>

                    </form>

                </div><!-- /.box-body -->
            </div><!-- end of box primary -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

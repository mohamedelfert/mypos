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
                <li><a href="{{ route('dashboard.products.index') }}">@lang('site.products')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section><!-- end of content header -->

        <section class="content">

            @include('partials._errors')

            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="col-md-4">
                        <a href="{{ route('dashboard.products.index')}}"
                           class="btn btn-primary btn-sm" title="@lang('site.back')">
                            <i class="fa fa-rotate-left"></i></a>
                    </div>
                </div><!-- end of box header -->

                <div class="box-body">

                    <form method="POST" action="{{ route('dashboard.products.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="category_id">@lang('site.categories')</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">@lang('site.categories')</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label for="name">@lang('site.' . $locale . '.name')</label>
                                <input type="text" name="{{ $locale }}[name]" id="name" class="form-control"
                                       value="{{ old($locale.'.name') }}"
                                       placeholder="@lang('site.' . $locale . '.name')" required>
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label for="description">@lang('site.' . $locale . '.description')</label>
                                <textarea class="form-control ckeditor" id="description"
                                          name="{{ $locale }}[description]"
                                          placeholder="@lang('site.' . $locale . '.description')"
                                          required>{{ old($locale . '.description') }}</textarea>
                                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label for="image">@lang('site.product_image')</label>
                            <input type="file" name="image" id="image"
                                   class="form-control product_image">
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <img class="img-responsive image_preview" style="width:100px"
                                 alt="@lang('site.product_image')"
                                 src="{{ asset('uploads/products_images/default.png') }}">
                        </div>

                        <div class="form-group">
                            <label for="purchase_price">@lang('site.purchase_price')</label>
                            <input type="number" name="purchase_price" id="purchase_price" class="form-control"
                                   value="{{ old('purchase_price') }}" min="0"
                                   placeholder="@lang('site.purchase_price')" required>
                            @error('purchase_price')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="sale_price">@lang('site.sale_price')</label>
                            <input type="number" name="sale_price" id="sale_price" class="form-control"
                                   value="{{ old('sale_price') }}" min="0"
                                   placeholder="@lang('site.sale_price')" required>
                            @error('sale_price')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="stock">@lang('site.stock')</label>
                            <input type="number" name="stock" id="stock" class="form-control"
                                   value="{{ old('stock') }}" min="0" max="100" step="1"
                                   placeholder="@lang('site.stock')" required>
                            @error('stock')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            @if(auth()->user()->hasPermission('products_create'))
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-plus"></i> @lang('site.add')
                                </button>
                            @else
                                <a class="btn btn-primary btn-block disabled"><i
                                        class="fa fa-plus"></i> @lang('site.add')</a>
                            @endif
                        </div>

                    </form>

                </div><!-- /.box-body -->
            </div><!-- end of box primary -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

@push('js')
    <script type="text/javascript">
        $('.product_image').change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endpush

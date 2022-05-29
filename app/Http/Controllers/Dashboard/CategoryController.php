<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:categories_read'])->only('index');
        $this->middleware(['permission:categories_create'])->only('create');
        $this->middleware(['permission:categories_update'])->only('edit');
        $this->middleware(['permission:categories_delete'])->only('destroy');
    }

    public function index(Request $request)
    {
        $title = trans('site.categories');
        $categories = Category::When($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->latest()->paginate(10);
        return view('dashboard.categories.index', compact('title', 'categories'));
    }

    public function create()
    {
        $title = trans('site.categories');
        return view('dashboard.categories.create', compact('title'));
    }

    public function store(Request $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];
        }

        $request->validate($rules);

        Category::create($request->all());
        session()->flash('success', trans('site.data_added_successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        $title = trans('site.categories');
        return view('dashboard.categories.edit', compact('title', 'category'));
    }

    public function update(Request $request, Category $category)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name' => ['required',
                    Rule::unique('category_translations', 'name')
                        ->ignore($category->id, 'category_id')
                ]
            ];
        }

        $request->validate($rules);

        $category->update($request->all());
        session()->flash('success', trans('site.data_updated_successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', trans('site.data_deleted_successfully'));
        return redirect()->back();
    }
}

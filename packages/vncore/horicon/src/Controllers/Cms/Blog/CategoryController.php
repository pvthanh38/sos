<?php

namespace VNCore\Horicon\Controllers\Cms\Blog;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\BlogCategory;

class CategoryController extends HoriconController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = BlogCategory::query();

        $q = $request->get('q');
        if ($q) {
            $query->search($q);
        }

        $categories = $query->orderUpdated()->paginate(20);

        return view('horicon::blog.categories.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new BlogCategory();
        return view('horicon::blog.categories.create', compact('category'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'bail|required|max:255',
            'slug' => 'required|unique:blog_categories,slug',
            'content' => 'nullable|max:3000',
            'status' => 'sometimes|boolean',
            'meta_description' => 'nullable|max:255',
            'layout' => 'nullable',
        ]);

        $validated['slug'] = str_slug($validated['slug']);
        $validated['status'] = $validated['status'] ?? FALSE;

        $category = new BlogCategory();
        $category->fill($validated);
        $category->save();

        return back()->with('message', 'Created successfully!');
    }

    /**
     * @param BlogCategory $category
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $category)
    {
        return view('horicon::blog.categories.edit', compact('category'));
    }

    /**
     * @param Request      $request
     * @param BlogCategory $category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BlogCategory $category)
    {
        $validated = $request->validate([
            'title' => 'bail|required|max:255',
            'slug' => [
                'required',
                Rule::unique('blog_categories')->where(function ($query) use ($category) {
                    $query->where('id', '!=', $category->id);
                    return $query;
                }),
            ],
            'content' => 'nullable|max:3000',
            'status' => 'sometimes|boolean',
            'meta_description' => 'nullable|max:255',
            'layout' => 'nullable',
        ]);

        $validated['slug'] = str_slug($validated['slug']);
        $validated['status'] = $validated['status'] ?? FALSE;

        $category->fill($validated);
        $category->save();

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param BlogCategory $category
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(BlogCategory $category)
    {
        $category->delete();
        return back()->with('message', 'Deleted successfully!');
    }
}

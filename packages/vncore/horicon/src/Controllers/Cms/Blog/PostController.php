<?php

namespace VNCore\Horicon\Controllers\Cms\Blog;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\BlogCategory;
use VNCore\Horicon\Models\BlogPost;

class PostController extends HoriconController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = BlogPost::query();

        $q = $request->get('q');
        if ($q) {
            $query->search($q);
        }

        $posts = $query->orderUpdated()->paginate(20);

        return view('horicon::blog.posts.index', compact('posts'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new BlogPost();
        $categories = BlogCategory::orderBy('id')->pluck('title', 'id');
        return view('horicon::blog.posts.create', compact('post', 'categories'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:blog_categories,id',
            'title' => 'bail|required|max:60',
            'slug' => 'required|unique:blog_posts,slug',
            'image' => 'file|image|max:5000|dimensions:ratio=3/2',
            'summary' => 'nullable|max:500',
            'content' => 'required|max:3000',
            'status' => 'sometimes|boolean',
            'meta_description' => 'nullable|max:150',
            'layout' => 'nullable',
        ]);

        $validated['slug'] = str_slug($validated['slug']);
        $validated['status'] = $validated['status'] ?? FALSE;

        $post = new BlogPost();
        $post->fill($validated);
        $post->save();

        // Upload image for post
        $post->addImageFromRequest();

        return back()->with('message', 'Created successfully!');
    }

    /**
     * @param BlogPost $post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::orderBy('id')->pluck('title', 'id');
        return view('horicon::blog.posts.edit', compact('post', 'categories'));
    }

    /**
     * @param Request  $request
     * @param BlogPost $post
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BlogPost $post)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:blog_categories,id',
            'title' => 'bail|required|max:60',
            'slug' => [
                'required',
                Rule::unique('blog_posts')->where(function ($query) use ($post) {
                    $query->where('id', '!=', $post->id);
                    return $query;
                }),
            ],
            'image' => 'file|image|max:5000|dimensions:ratio=3/2',
            'summary' => 'nullable|max:500',
            'content' => 'required|max:3000',
            'status' => 'sometimes|boolean',
            'meta_description' => 'nullable|max:150',
            'layout' => 'nullable',
        ]);

        $validated['slug'] = str_slug($validated['slug']);
        $validated['status'] = $validated['status'] ?? FALSE;

        $post->fill($validated);
        $post->save();

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param BlogPost $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(BlogPost $post)
    {
        $post->delete();
        return back()->with('message', 'Deleted successfully!');
    }
}

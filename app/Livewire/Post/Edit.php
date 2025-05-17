<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    #[Validate('required|string|max:255')]
    public $title;

    #[Validate('required|string|max:1000')]
    public $content;

    #[Validate('required|exists:categories,id')]
    public $categoryId;

    public $categories;

    public $post;

    public function mount($slug)
    {
        $this->post = Post::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $this->title = $this->post->title;
        $this->content = $this->post->content;
        $this->categoryId = $this->post->category_id;

        $this->categories = \App\Models\Categories::query()->get();
    }

    public function cancel()
    {
        return redirect()->route('posts.index');
    }

    public function update()
    {
        $this->validate();
        
        $this->post->update([
            'title' => $this->title,
            'slug' => \Illuminate\Support\Str::slug($this->title) . '-' . \Illuminate\Support\Str::uuid(),
            'excerpt' => \Illuminate\Support\Str::limit($this->content, 100),
            'category_id' => $this->categoryId,
            'user_id' => request()->user()->id,
            'content' => $this->content,
        ]);

        $this->reset(['title', 'content', 'categoryId']);

        Toaster::success('Post updated successfully!');

        return redirect()->route('posts.index');
    }
    public function render()
    {
        return view('livewire.post.edit');
    }
}

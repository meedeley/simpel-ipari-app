<?php

namespace App\Livewire\Post;

use App\Models\Categories;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    #[Validate('required|string|max:255')]
    public $title;

    #[Validate('required|string|max:1000')]
    public $content;

    #[Validate('required|exists:categories,id')]
    public $categoryId;

    public ?Collection $categories = null;

    public function mount()
    {
        $this->categories = Categories::query()->get();
    }
    public function cancel()
    {
        return redirect()->route('posts.index');
    }

    public function save()
    {
        $this->validate();

        \App\Models\Post::create([
            'title' => $this->title,
            'slug' => \Illuminate\Support\Str::slug($this->title) . '-' . \Illuminate\Support\Str::uuid(),
            'excerpt' => \Illuminate\Support\Str::limit($this->content, 100),
            'category_id' => $this->categoryId,
            'user_id' => request()->user()->id,
            'content' => $this->content,
        ]);

        $this->reset(['title', 'content', 'categoryId']);

        Toaster::success('Post created successfully!');

        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.post.create');
    }
}

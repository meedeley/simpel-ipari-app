<?php

namespace App\Livewire\Post;

use Livewire\Component;

class Detail extends Component
{
    public $post;

    public $title;
    public $content;

    public function mount($slug)
    {
        $this->post = \App\Models\Post::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $this->title = $this->post->title;
        $this->content = $this->post->content;
    }
    public function render()
    {
        return view('livewire.post.detail');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\News as ModelsNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class News extends Component
{
    use WithFileUploads;

    public $ids;
    public $news;
    public $title;
    public $body;
    public $image;
    public $updateMode = \false;

    public function resetInput()
    {
        $this->title = null;
        $this->body = null;
        $this->image= null;
    }

    public function store(Request $request)
    {
        $data = $this->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image|max:1024'
        ]);

        $data['image'] = $this->image->store('images', 'public');

        ModelsNews::create($data);

        session()->flash('message', 'News Created Successfully.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $news = ModelsNews::where('id',$id)->first();
        $this->ids = $news->id;
        $this->title = $news->title;
        $this->body = $news->body;
        $this->image = $news->image;
        $this->updateMode = \true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'sometimes|required|image|max:1024'
        ]);


        if ($this->ids) {
            $news = ModelsNews::find($this->ids);
            $news->update([
                'title' => $this->title,
                'body' => $this->body,
                'image' => $this->image->store('images', 'public'),
            ]);

            \session()->flash('message', 'News Updated Successfully.');
            $this->resetInput();
            $this->updateMode = \false;
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $news = ModelsNews::where('id', $id);
            $news->delete();
        }
    }

    public function render()
    {
        $this->news = ModelsNews::orderBy('id', 'DESC')->get();
        return view('livewire.news');
    }

}

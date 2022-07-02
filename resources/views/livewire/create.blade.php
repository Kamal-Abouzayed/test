<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">News Title</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" wire:model="title">
        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">News Body</label>
        <textarea type="text" cols="30" rows="10" class="form-control" id="exampleFormControlInput2" wire:model="body"></textarea>
        @error('body') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
      <input type="file" wire:model="image">

    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <button wire:click.prevent="store()" class="btn btn-primary btn-lg">Create</button>
    <hr>
  </form>

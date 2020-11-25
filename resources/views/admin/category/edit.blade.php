
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        
        {{-- <x-jet-welcome /> --}}
        
        <div class="container">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible show" role="alert">
                <strong>{{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Edit Category</h5>
                        <div class="card-body">
                            <form action="{{ route('category.update', $category->id) }}" method="POST" >
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                  <label for="category_name">Category Name</label>
                                  <input type="text" class="form-control rounded-0 @error('category_name') border border-danger @enderror" name="category_name" id="category_name" value="{{ $category->category_name }}">
                                  @error('category_name')
                                  <small id="categoryHelp" class="form-text text-danger">{{ $message }} </small>
                                  @enderror
                                </div>
                                <button type="submit" class="btn btn-sm btn-secondary rounded-0">Update Category</button>
                            </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

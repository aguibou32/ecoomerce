
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
                        <h5 class="card-header">Add Brand</h5>
                        <div class="card-body">
                            <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                  <label for="category_name">Brand Name</label>
                                  <input type="text" class="form-control rounded-0 @error('brand_name') border border-danger @enderror" name="brand_name" id="brand_name" value="{{ $brand->brand_name }}"">
                                  @error('brand_name')
                                  <small id="BrandNameHelp" class="form-text text-danger">{{ $message }} </small>
                                  @enderror
                                </div>

                                <div class="form-group">
                                    <label for="category_name">Brand Image</label>
                                    <input type="file" class="form-control rounded-0 @error('brand_image') border border-danger @enderror" name="brand_image" id="brand_image">
                                    @error('brand_image')
                                    <small id="BrandImageHelp" class="form-text text-danger">{{ $message }} </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset('/storage/' . $brand->brand_image)}}" />
                                </div>
                                <button type="submit" class="btn btn-sm btn-secondary rounded-0">Add Brand</button>
                            </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

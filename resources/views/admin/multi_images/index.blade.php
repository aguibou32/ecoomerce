<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Product Brands ') }}
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
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">Add Images</h5>
                        <div class="card-body">
                            <form action="{{ route('multi_image.store') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-group">
                                    <label for="image">Brand Images</label>
                                    <input type="file" class="form-control rounded-0 @error('image') border border-danger @enderror" name="image[]" id="image" multiple="multiple">
                                    @error('image')
                                    <small id="BrandImageHelp" class="form-text text-danger">{{ $message }} </small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-sm btn-secondary rounded-0">Add Images</button>
                            </form>
                        </div>
                      </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                          Images
                          {{-- <a href="{{ route('moveAllCategoriesToBin') }}" class="btn btn-sm btn-danger pull-right rounded-0">Move all to Trash bin</a> --}}
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Images</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    @if (count($images)>0)
                                        @foreach ($images as $image)
                                            <tr>
                                                <td>{{ $image->image }}</td>
                                                <td>
                                                    <form method="POST">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button class="fa fa-trash fa-lg text-info" ></button>
                                                  </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td>No data</td>
                                    @endif
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                          Product Brands 
                          {{-- <a href="{{ route('moveAllCategoriesToBin') }}" class="btn btn-sm btn-danger pull-right rounded-0">Move all to Trash bin</a> --}}
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Brand Name </th>
                                        <th scope="col">Brand Image </th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Last Updated</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    @if (count($brands)>0)
                                        @foreach ($brands as $brand)
                                            <tr>
                                                <td>{{ $brand->id }}</td>
                                                <td>{{ $brand->brand_name }}</td>
                                                <td><img src="{{ asset('/storage/' . $brand->brand_image)}}" width="70px" height="100px" /> </td>
                                                <td>{{ $brand->created_at->diffForHumans()}}</td>
                                                <td>{{ $brand->updated_at->diffForHumans() }}</td>
                                                <td>
                                                    <form method="POST" action="{{ route('brand.destroy', $brand->id) }}">
                                                    <a href="{{ route('brand.edit', $brand->id) }}" class="fa fa-edit fa-lg mr-2 text-info" ></a>
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
                            {{ $brands->links() }}
                        </div>
                    </div>

                    {{-- Trashed files --}}
                    <br>
                    <br>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">Add Brand</h5>
                        <div class="card-body">
                            <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-group">
                                  <label for="brand_name">Brand Name</label>
                                  <input type="text" class="form-control rounded-0 @error('brand_name') border border-danger @enderror" value = "{{ old('brand_name') }}"name="brand_name" id="brand_name">
                                  @error('brand_name')
                                  <small id="BrandNameHelp" class="form-text text-danger">{{ $message }} </small>
                                  @enderror
                                </div>

                                <div class="form-group">
                                    <label for="brand_name">Brand Image</label>
                                    <input type="file" class="form-control rounded-0 @error('brand_image') border border-danger @enderror" name="brand_image" id="brand_image">
                                    @error('brand_image')
                                    <small id="BrandImageHelp" class="form-text text-danger">{{ $message }} </small>
                                    @enderror
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


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
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                          Product Categories 
                          <a href="{{ route('moveAllCategoriesToBin') }}" class="btn btn-sm btn-danger pull-right rounded-0">Move all to Trash bin</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category name </th>
                                        <th scope="col">Added By </th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Last Updated</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    @if (count($categories)>0)
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->category_name }}</td>
                                                <td>{{ $category->user->name }}</td>
                                                <td>{{ $category->created_at->diffForHumans()}}</td>
                                                <td>{{ $category->updated_at->diffForHumans() }}</td>
                                                <td>
                                                    <form method="POST" action="{{ route('category.destroy', $category->id) }}">
                                                    <a href="{{ route('category.edit', $category->id) }}" class="fa fa-edit fa-lg mr-2 text-info" ></a>
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
                            {{ $categories->links() }}
                        </div>
                    </div>

                    {{-- Trashed files --}}
                    <br>
                    <br>
                    <div class="card">
                        <div class="card-header">
                          Trashed categories
                          <a href="{{ route('deleteAllCategoriesPermanently') }}" class="btn btn-sm btn-danger pull-right rounded-0">Empty Trash</a>
                          <a href="{{ route('restoreAllCategories') }}" class="btn btn-sm btn-info pull-right rounded-0">Restore All Categories</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category name </th>
                                        <th scope="col">Added By </th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Last Updated</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                    @if (count($trashedCategoryFiles)>0)
                                        @foreach ($trashedCategoryFiles as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->category_name }}</td>
                                                <td>{{ $category->user->name }}</td>
                                                <td>{{ $category->created_at->diffForHumans()}}</td>
                                                <td>{{ $category->updated_at->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{ route('restoreCategory', $category->id) }}" class="btn btn-sm btn-primary rounded-0" fa-lg mr-2 text-info" >restore</a>
                                                    <a href="{{ route('deleteCategoryPermanently', $category->id) }}" class="btn btn-sm btn-danger rounded-0" fa-lg mr-2 text-info" onclick="return confirm('Do you want to permanenently remove this category?')" >Delete</a>
                                                  </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td>No data</td>
                                    @endif
                                </thead>
                            </table>
                            {{ $trashedCategoryFiles->links() }}
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card">
                        <h5 class="card-header">Add Category</h5>
                        <div class="card-body">
                            <form action="{{ route('category.store') }}" method="POST" >
                                @csrf
                                <div class="form-group">
                                  <label for="category_name">Category Name</label>
                                  <input type="text" class="form-control rounded-0 @error('category_name') border border-danger @enderror" name="category_name" id="category_name">
                                  @error('category_name')
                                  <small id="categoryHelp" class="form-text text-danger">{{ $message }} </small>
                                  @enderror
                                </div>
                                <button type="submit" class="btn btn-sm btn-secondary rounded-0">Add Category</button>
                            </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

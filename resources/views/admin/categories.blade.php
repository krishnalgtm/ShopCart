@extends('layouts.admin')

@section('content')
<style>
    .table-striped th:nth-child(1), .table-striped td:nth-child(1) {
        width: 100px;
    }
    .table-striped th:nth-child(2), .table-striped td:nth-child(2) {
        width: 250px;
    }
    .image {
        width: 50px;
        height: 50px;
    }
</style>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Categories</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.index') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">All Category</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="{{ route('admin.category.add') }}"><i class="icon-plus"></i> Add new</a>
            </div>

            <div class="wg-table table-all-user">
                @if(Session::has('status'))
                    <p class="alert alert-success">{{ Session::get('status') }}</p>
                @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Products</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="" class="image">
                                </div>
                                <div class="name">
                                    {{ $category->name }}
                                </div>
                            </td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <a href="{{ route('admin.category.products', ['category_slug' => $category->slug]) }}" target="_blank">
                                    {{ $category->products()->count() }}
                                </a>
                            </td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>

                                    <form action="{{ route('admin.category.delete', ['id' => $category->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="item text-danger delete">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(function () {
        $(".delete").on('click', function (e) {
            e.preventDefault();
            var selectedForm = $(this).closest('form');
            swal({
                title: "Are you sure?",
                text: "You want to delete this record?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    selectedForm.submit();
                }
            });
        });
    });
</script>
@endpush

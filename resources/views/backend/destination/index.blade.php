@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Destination <a href="{{ route('destination.create') }}"
                                class="btn btn-primary">Add Destination</a></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Destination</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="col-sm-12">
                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="col-sm-12">
                        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Status<th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (count($destinations) == 0)
                                            <tr>
                                                <td colspan="5">
                                                    <p class="text-center">
                                                        No any records.
                                                    </p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($destinations as $destination_item)
                                                <tr>
                                                    @if (isset($destination_item->image))
                                                        <td>
                                                            <img src="{{ Storage::disk('uploads')->url($destination_item->image) }}"
                                                                alt="{{ $destination_item->title }}"
                                                                style="height: 90px; width: 150px;">
                                                        </td>
                                                    @else
                                                        <td>
                                                            <img id="image_output" style="height: 100px;"
                                                                src="{{ Storage::disk('uploads')->url('noimage.jpg') }}">
                                                        </td>
                                                    @endif

                                                    <td>
                                                        {{ $destination_item->title }}
                                                    </td>
                                                    <td>
                                                        @if ($destination_item->publish_status == '1')
                                                            Active
                                                        @else
                                                            Inactive
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('destination.edit', $destination_item->id) }}"
                                                            class="btn btn-primary" title="Edit"><i
                                                                class="fas fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deletionservice{{ $destination_item->id }}"
                                                            data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                                class="fa fa-trash"></i></button>
                                                        <!-- Modal -->
                                                        <div class="modal fade text-left"
                                                            id="deletionservice{{ $destination_item->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Delete Confirmation</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <form
                                                                            action="{{ route('destination.delete', $destination_item->id) }}"
                                                                            method="POST" style="display:inline-block;">
                                                                            @csrf
                                                                            @method("POST")
                                                                            <label for="reason">Are you sure you want to
                                                                                delete??</label><br>
                                                                            <input type="hidden" name="_method"
                                                                                value="DELETE" />
                                                                            <button type="submit" class="btn btn-danger"
                                                                                title="Delete">Confirm Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            ";
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-sm">
                                                Showing <strong>{{ $destinations->firstItem() }}</strong> to
                                                <strong>{{ $destinations->lastItem() }} </strong> of <strong>
                                                    {{ $destinations->total() }}</strong>
                                                entries
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <span class="pagination-sm m-0 float-right">{{ $destinations->links() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')

@endpush

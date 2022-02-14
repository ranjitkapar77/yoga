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
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Extra</li>
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
                                            <th>Title</th>
                                            <th>key</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (count($extra) == 0)
                                            <tr>
                                                <td colspan="5">
                                                    <p class="text-center">
                                                        No any records.
                                                    </p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($extra as $destination_item)
                                                <tr>

                                                    <td>
                                                        {{ $destination_item->value }}
                                                    </td>
                                                    <td>
                                                        {{ $destination_item->value_1 }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('extra.edit', $destination_item->id) }}"
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
                                                Showing <strong>{{ $extra->firstItem() }}</strong> to
                                                <strong>{{ $extra->lastItem() }} </strong> of <strong>
                                                    {{ $extra->total() }}</strong>
                                                entries
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <span class="pagination-sm m-0 float-right">{{ $extra->links() }}</span>
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

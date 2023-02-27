@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Top Users</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#topupModal">Run Top User Finding Job</button>

            <div class="modal fade" id="topupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are You Sure ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            This process will take some time. Are you sure you want to run this job ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="{!! route('generate-top-users') !!}" class="btn btn-primary">Run Job</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{!! route('search-user') !!}" method="get" class="card-header">
            <div class="form-row">
                <div class="col-md-3">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search user by:id, name, email" class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <div>
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($topTopupUsers as $user)
                    <tr>
                        <th scope="row">{{ $user->user->id }}</th>
                        <td>{{ $user->user->name }}</td>
                        <td>{{ $user->count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
                @if($topTopupUsers->total() > 0)
                    <div class="cols-12 col-md-4">
                        <p class="mb-0">Showing {{$topTopupUsers->firstItem()}} to {{$topTopupUsers->lastItem()}} out
                            of {{$topTopupUsers->total()}}</p>
                    </div>
                @else
                    <div class="col-md-4">
                        <p>No Product Found</p>
                    </div>
                @endif

                <div class="cols-12 col-md-8">
                    {{ $topTopupUsers->links()}}
                </div>
            </div>
        </div>
    </div>
{{--    alert--}}
    @if (Session::has('success'))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-success mt-1">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (Session::has('error'))
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-danger">
                        <p>{{ Session::get('error') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


@extends('admin.Layout.layout')

@section('title', 'Notification')

@section('content')
    <div class="container-fluid" style="overflow-x: auto">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bolder">Notification</h4>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#notiModal">Add <i
                    class="bi bi-plus"></i></button>
        </div>

        @if (session('message'))
            <div class="alert alert-{{session('message')['type']}} m-2">
                {{session('message')['msg']}}
            </div>
        @endif

        <table class="table table-hover table-responsive mt-3" id="table">
            <thead>
                <tr class="table-dark">
                    <th scope="col">No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Notification</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notifications as $notification)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$notification->title}}</td>
                        <td>{{$notification->notification}}</td>
                        <td>
                            <span class="p-1" style="cursor: pointer"><i class="bi bi-pencil"></i></span>
                            <i class="bi bi-trash text-danger ms-3" style="cursor: pointer"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal  --}}
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="notiModal" tabindex="-1" aria-labelledby="notiModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="notiModal">Add Notification</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="notification/create" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="mt-2">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class='form-control' id="title" name="title">
                            @error('title')
                                <span class="text-danger">{{ $message }}}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="noti" class="form-label">Notification</label>
                            <textarea name="notification" id="noti" cols="30" rows="10" class="form-control" >
                            </textarea>
                            @error('notification')
                                <span class="text-danger">{{ $message }}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


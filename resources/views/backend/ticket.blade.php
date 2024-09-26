@extends('backend.layouts.app')

@section('content')

@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    
@endif

@if (session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    
@endif

<script>
    var alertList = document.querySelectorAll(".alert");
    alertList.forEach(function (alert) {
        new bootstrap.Alert(alert);
    });
</script>


<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4 class="card-title">Ticket List</h4>
        @if (auth()->user()->role == 'user')
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ticket create
        </button>
        @endif
       
    </div>
    <div class="card-body p-3">
        <table class="table table-dark table-striped">
            <tr>
                <th>Sl</th>
                @if (auth()->user()->role == 'admin')
                <th>User Name</th>
                @endif
                <th>Ticket No</th>
                <th>Tricket title</th>
                <th>Details</th>
                <th>Status</th>
                @if (auth()->user()->role == 'admin')
                <th>Action</th>
                @endif
               
            </tr>
            @foreach ($tickets as $key => $ticket)
            <tr>
                <td>{{ $key+1 }}</td>
                @if (auth()->user()->role == 'admin')
                <td>{{ $ticket->user->name }}</td>
                @endif
                <td>{{ $ticket->ticket_no }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ $ticket->description }} </td>
                <td>
                    @if ($ticket->status == 'open')
                        <span class="badge bg-danger">Open</span>
                    @else
                        <span class="badge bg-success">Closed</span>
                    @endif
                </td>
                @if (auth()->user()->role == 'admin')
                <td>
                    <a href="{{ route('tickets.close',$ticket->id) }}" 
                        class="btn btn-primary btn-sm {{ $ticket->status == 'close' ? 'disabled' : '' }}" 
                        onclick="return confirm('Are you sure you want to close this ticket?')">Close</a>
                </td>
                @endif
            </tr>
            @endforeach
        
        </table>
        {{ $tickets->links() }}
    </div>
</div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                <div class="modal-body">
                
                    <div class="mb-3">
                        <label for="title" class="form-label">Ticket Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
                </div>
            </div>
            </div>
        </div>

        
@endsection
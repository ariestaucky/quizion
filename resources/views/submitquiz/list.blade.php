@extends('layouts.app')

@section('content') 
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">My Quiz List</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="/submitquiz">
                    <button type="button" class="btn btn-sm btn-outline-secondary no-padding"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Catagory</th>
                        <th>Subject</th>
                        <th>Title</th>
                        <th>Num. of Question</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quiz_list as $list)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$list->catagory}}</td>
                            <td>{{$list->subject}}</td>
                            <td>{{$list->title}}</td>
                            <td>{{$list->quantity}}</td>
                            <td>{{$list->created_at->diffforHumans()}}</td>
                            <td>
                                <div class="row">
                                    <a href="/submitquiz/{{$list->id}}">
                                        <button type="button" class="btn btn-sm btn-primary no-padding"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                                    </a>
                                    <a href="/submitquiz/{{ $list->id }}/edit">
                                        <button type="button" class="btn btn-sm btn-alert no-padding"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$quiz_list->links()}}
        </div>
    </main>
@endsection

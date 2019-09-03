@extends('layouts.app')

@section('content') 
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Your Profile</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="#">
                    <button type="button" class="btn btn-sm btn-outline-secondary no-padding"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                </a>
            </div>
        </div>
        
        <div class="row my-4 w-100">
            <div class="col-xs-6 col-sm-6">
                <fieldset>
                    <legend>Detail Info
                    </legend>
                    <table class="table" >
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>
                                <p>{{$user->name}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><p>{{$user->email}}</p></td>
                        </tr>
                        <tr>
                            <td>Join Since</td>
                            <td>:</td>
                            <td><p>{{$user->created_at->diffforHumans()}}</p></td>
                        </tr>
                    </table>
                </fieldset>
            </div>
        </div>
    </main>
@endsection
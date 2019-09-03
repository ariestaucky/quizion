@extends('layouts.app')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Quiz Detail</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="/list">
				<button type="button" class="btn btn-sm btn-outline-secondary no-padding"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</button>
			</a>
			<a href="/submitquiz/{{ $quiz_detail['id'] }}/edit" class="padding-left">
				<button type="button" class="btn btn-sm btn-danger no-padding"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h1>
				{{ $quiz_detail['title'] }}
			</h1>
			<p>
			    Quiz's author: {{ auth()->user()->name }}
			</p>
			@include('include.flash')
			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th scope="col">
							No
						</th>
						<th scope="col">
							Question
						</th>
						<th scope="col">
							Option
						</th>
						<th scope="col">
							Answer
						</th>
					</tr>
				</thead>
				<tbody>               
                    @foreach ($q1 as $que)
					<tr>
						<th scope="row" class="align-table">
							{{$loop->index +1}}
						</th>
						<td class="align-table">
							{{$que['question']}}
						</td>
						<td class="align-table">
                            @if ($quiz_detail['catagory'] == 1)
								<div class="col-md-12 no-padding-left">A. {{$que['op1']}}</div>
								<div class="col-md-12 no-padding-left">B. {{$que['op2']}}</div>
								<div class="col-md-12 no-padding-left">C. {{$que['op3']}}</div>
								<div class="col-md-12 no-padding-left">D. {{$que['op4']}}</div>
                            @endif
						</td>
						<td class="align-table">
							{{$que['answer']}}
						</td>
					</tr>
					<tr>
						<td></td>
					<td colspan="3" class="align-table">
						EXPLENATION : 
						@if($que['exp'] == null)
							No Explenation Provided
						@else
							{{$que['exp']}}
						@endif
					</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</main>
@endsection
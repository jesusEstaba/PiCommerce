@extends('sections.main')

@section('title', 'My Account')
@section('content')

<style type="text/css">
	.title-register{
	}
	.space{
		margin-bottom: 2em;
	}
	.bg-white{
		background: white;
		padding: 1em;
		border-radius: 3px;
		box-shadow: 0 2px 5px rgba(0,0,0,.26);
	}
</style>


<div class="container space">
@if( Session::has('message-correct') )
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Done!</strong> {{Session::get('message-correct')}}.
		@if(isset($nameUpdates))
			<ul>
				@foreach($nameUpdates as $name)
					<li>{{$name}}</li>
				@endforeach
			</ul>
		@endif
	</div>
@endif
	<div class="row">
		<div class="col-xs-12 col-md-6 col-md-offset-3">

<div class="bg-white">


<form action="{{url('/account')}}" method="post">

			<h2>My Account</h2>

<div class="input-form">
	<label>Name: {{$user->Cs_Name}}</label>
	<input type="text" class="form-control" name="name" placeholder="Name" />
</div>

<div id="from-datepicker">
	<label>Birthdate: {{$user->Cs_Birthday}}</label>
	<div style="width: auto;" class="form-group">
		<select name="month_birthday" style="width: auto;display: inline-block;" class="form-control">
			<option>Month</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select>
		<select name="day_birthday" style="width: auto;display: inline-block;" class="form-control">
			<option>Day</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
		</select>
		<select name="year_birthday" style="width: auto;display: inline-block;" class="form-control">
			<option>Year</option>
		</select>
	</div>
</div>


<div class="input-form">
	<label>Password:</label>
	<input type="password" class="form-control" name="password" placeholder="Password" />
</div>


<div class="input-form">
	<label>Zip Code: {{$user->Cs_ZipCode}}</label>
	<input type="text" name="zip_code" placeholder="Zipe Code" class="form-control"/>
</div>

<div class="input-form">
	<label>Street Number: {{$user->Cs_Number}}</label>
	<input type="text" name="street_number" placeholder="eg. 2400" class="form-control"/>
</div>

<div class="input-form">
	<label>Street Name: {{$user->Cs_Street}}</label>
	<input type="text" name="street_name" placeholder="eg. Forsyth Rd" class="form-control" id="tags" />
</div>

<div class="input-form">
	<label>Aparment/Suite #: {{$user->Cs_Ap_Suite}}</label>
	<input type="text" name="aparment" placeholder="Aparment or Suite Number" class="form-control"/>
</div>

<div class="input-form">
	<label>Special Directions: </label>
	<input type="text" name="special_directions" placeholder="eg. Enter gate code 555" class="form-control"/>
</div>



{{ csrf_field() }}
<br>

<button type="submit" class="btn btn-primary">Update</button>
</form>
</div>


		</div>
	</div>
</div>



<script type="text/javascript">
	var fecha_act = new Date();
var anno_actual = fecha_act.getFullYear();
var anno_cien = anno_actual - 150;
var option_years;

for (var i = anno_actual; i > anno_cien; i--) {
    option_years += '<option value="'+ i +'">' + i + '</option>';
}

$('[name=year_birthday]').append(option_years);
</script>
@stop
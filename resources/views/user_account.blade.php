@extends('sections.main')

@section('title', 'My Account')
@section('content')

<style type="text/css">
	.title-register{
		background: #104071;
	}
</style>



<div class="container space">
	<div class="row">
		<div class="col-xs-12">
			<h2>My Account</h2>








<h3 class="title-register">Your Personal or Business Contact Information</h3>
<div class="input-form">
	<label>Name:</label>
	<input type="text" class="form-control" value="{{Input::old('name')}}" name="name" placeholder="Name" />
</div>
<div class="input-form">
	<label>Email:</label>
	<input type="email" class="form-control" value="{{Input::old('email')}}" name="email" placeholder="Email" />
</div>
<div class="input-form">
	<label>Phone:</label>
	<input type="text" value="{{Input::old('phone')}}" name="phone" placeholder="Phone" class="form-control" />
</div>
<div id="from-datepicker">
	<label>Birthdate: <span class="optional">Optional</span></label>
	<div style="width: auto;" class="form-group">
		<select value="{{Input::old('month_birthday')}}" name="month_birthday" style="width: auto;display: inline-block;" class="form-control">
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
		<select value="{{Input::old('day_birthday')}}" name="day_birthday" style="width: auto;display: inline-block;" class="form-control">
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
		<select value="{{Input::old('year_birthday')}}" name="year_birthday" style="width: auto;display: inline-block;" class="form-control">
			<option>Year</option>
		</select>
	</div>
	<div class="hide input-group">
		<input placeholder="Birthdate(optional)" aria-describedby="basic-addon1" class="form-control" data-format="dd/MM/yyyy" type="text" name="birthday"></input>
		<span class="input-group-addon add-on" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
	</div>
</div>
<h3 class="title-register">Your Password</h3>
<div class="input-form">
	<label>Password:</label>
	<input type="password" class="form-control" name="password" placeholder="Password" />
</div>
<div class="input-form">
	<label>Repeat Password:</label>
	<input type="password" class="form-control" name="confirm" placeholder="Confirm Password" />
</div>
<h3 class="title-register">
Company Information (Office Delivery Only)
</h3>
<div class="input-form">
	<label>Company: <span class="optional">Optional</span></label>
	<input type="text" value="{{Input::old('company')}}" name="company" placeholder="Company" class="form-control" />
</div>
</div>

<div class="col-md-6">
<h3 class="title-register">Your Address</h3>
<div class="input-form">
	<label>Zip Code:</label>
	<input type="text" value="{{Input::old('zip_code')}}" name="zip_code" placeholder="Zipe Code" class="form-control"/>
</div>
<div class="input-form">
	<label>Street Number:</label>
	<input type="text" value="{{Input::old('street_number')}}" name="street_number" placeholder="eg. 2400" class="form-control"/>
</div>
<div class="input-form">
	<label>Street Name:</label>
	<input type="text" value="{{Input::old('street_name')}}" name="street_name" placeholder="eg. Forsyth Rd" class="form-control" id="tags" />
</div>
<div class="input-form">
	<label>Aparment/Suite #: </label>
	<input type="text" value="{{Input::old('aparment')}}" name="aparment" placeholder="Aparment or Suite Number" class="form-control"/>
</div>
<div class="input-form">
	<label>Aparment Complex: </label>
	<input type="text" value="{{Input::old('aparment_complex')}}" name="aparment_complex" placeholder="Aparment Complex" class="form-control"/>
</div>
<div class="input-form">
	<label>City:</label>
	<input type="text" value="{{Input::old('city')}}" name="city" placeholder="City" class="form-control"/>
</div>
<div class="input-form">
	<label>Special Directions: <span class="optional">Optional</span></label>
	<input type="text" value="{{Input::old('special_directions')}}" name="special_directions" placeholder="eg. Enter gate code 555" class="form-control"/>
</div>














		</div>
	</div>
</div>
@stop
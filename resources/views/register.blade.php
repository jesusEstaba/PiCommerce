@extends('sections.main')

@section('title', 'Register')
@section('content')

<div class="container space">
    @if(Session::has('message') || Session::has('message-error'))
        <div class="row">
            <div class="col-xs-12">
                @if( Session::has('message') )
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> {{Session::get('message')}}.
                    </div>
                @elseif( Session::has('message-error') )
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error!</strong> {!!Session::get('message-error')!!}
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="row bg-white">
        <div class="col-xs-12">
            <h2>Register</h2>
            {!!Form::open(['url'=>'register'])!!}
            <div class="row">

                <div class="col-md-6">
                    <h3 class="title-register">Your Personal or Business Contact Information</h3>
                    <div class="input-form">
                        <label>Full Name:</label>
                        <input type="text" class="form-control" value="{{Input::old('name')}}" name="name" placeholder="Full Name" />
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
                                <option value="0">Month</option>
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
                                <option value="0">Day</option>
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
                                <option value="0">Year</option>
                            </select>
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
                <div class="row">
                    <div class="col-xs-12">
                        <div class="reCAPTCHA">
                            <div class="g-recaptcha" data-sitekey="{{$publicApiKey}}"></div>
                        </div>

                    </div>
                </div>
                <div class="reg-data-check">
                    <div class="row">
                        <div class="col-xs-12">
                            <p>
                                Receive special offers & coupons by email:
                                <input name="offers" type="checkbox">
                            </p>
                        </div>
                        <div class="col-xs-12">
                            <p>
                                <b>
                                I have read the terms and conditions notice and I agree to it:
                                </b>
                                <input name="terms" type="checkbox">
                            </p>
                            <a class="activate_terms">Terms and Conditions.</a>
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-offset-4 col-xs-4">
                    <div class="input-form">
                        <a class="send form-control btn btn-primary">Register</a>
                        
                    </div>
                </div>
            </div>
            
            <input type="submit" class="hide sending" value="reg" />
            <script src='https://www.google.com/recaptcha/api.js'></script>
            
            {!!Form::close()!!}
        </div>
    </div>
</div>



<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="terms" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Terms and Services</h4>
      </div>
      <div class="modal-body">
        @if($termsAndServices)
            {!! $termsAndServices !!}
        @else
            <em>No Terms for now.</em>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<style type="text/css">
    .activate_terms{
        cursor: pointer;
    }
    .input-form{
        margin-bottom: .5em;
    }
    .input-group input{
        max-width: 100% !important;
        border-radius: 3px !important;
    }
    .bg-white{
        background: white;
    }
    h3.title-register{
        background: #10713B;
        color: white;
        padding: .2em;
        border-radius: 3px;
        box-shadow: 0 0 3px rgba(0,0,0,.26);
    }
    .reg-data-check{
        padding: 1em;
    }
    .send{
        margin-bottom: 3em;
    }
    .optional{
        font-size: .8em;
        color: #ccc;
        font-style: italic;
    }
    .reCAPTCHA{
        padding: 1em;
    }
</style>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    
    <script src="{{url('assets/datetimepicker/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{url('assets/datetimepicker/bootstrap-datetimepicker.min.css')}}">


<script type="text/javascript">
    function getPositionFields() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(getDistance, function(){
              $('.sending').click();  
            });
        } else {
            $('.sending').click();
        }
    }

    function getDistance(position) {
        position = position.coords;
        if ($('[name=latitude]').length==0) {
            $('form').append(
                '<input type="hidden" value="' + position.latitude + '" name="latitude">' +
                '<input type="hidden" value="' + position.longitude.toFixed(7) + '" name="longitude">'
            );
        }

        $('.sending').click();
    }

    String.prototype.capitalizeFirstLetter = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }

    function validateFields(namesArray) {
        var message = '';

        namesArray.forEach(function(name){
            if (!$('[name='+ name +']').val()){
                message += '<li>' + name.capitalizeFirstLetter().replace("_", " ")  +' is required</li>';
            }
        });

        return message;
    }

    var streets = [
        @foreach($streets as $tab => $table)
            "{{strtolower($table->St_ZipCode)}}",
        @endforeach
    ];
    var availableTags = [
        @foreach($codes as $tab => $table)
            "{{strtolower($table->St_Name)}}",
        @endforeach
    ];

    var fecha_act = new Date();
    var anno_actual = fecha_act.getFullYear();
    var anno_cien = anno_actual - 150;
    var option_years='';

    for (var i = anno_actual; i > anno_cien; i--) {
        option_years += '<option value="'+ i +'">' + i + '</option>';
    }

    $('[name=year_birthday]').append(option_years);


    $(document).ready(function() {
        $('select option').each(function(index, el) {
            if ($(this).parent().attr('value')==$(this).val()) {
                $(this).attr('selected', true);
            }
        });


        $('[name=zip_code]').autocomplete({
            source: streets,
            search: function(oEvent, oUi) {
                var sValue = $(oEvent.target).val();
                var aSearch = [];
                $(streets).each(function(iIndex, sElement) {
                    if (sElement.substr(0, sValue.length) == sValue) {
                        aSearch.push(sElement);
                    }
                });
                $(this).autocomplete('option', 'source', aSearch);
            }
        });

        $("#tags").autocomplete({
            source: availableTags,
            search: function(oEvent, oUi) {
                var sValue = $(oEvent.target).val();
                var aSearch = [];
                $(availableTags).each(function(iIndex, sElement) {
                    if (sElement.substr(0, sValue.length) == sValue) {
                        aSearch.push(sElement);
                    }
                });
                $(this).autocomplete('option', 'source', aSearch);
            }
        });

        $('.send').click(function() {
            var message = '';
            message += validateFields([
                'password',
                'email',
                'phone',
                'name',
                'street_number',
                'street_name',
                'zip_code',
            ]);

            if (!$("[name=terms]:checked").length) {
                message += "<li>Accept the Terms and Conditions</li>";
            }

            if ($('[name=password]').val() != $('[name=confirm]').val()){
                message += "<li>Passwords do not match</li>";
            }

            if (message) {
                $("#myModal .modal-title").html('<h4>Error</h4>');
                $("#myModal .modal-body").html('<ul>' + message + '</ul>');
                $('#myModal').modal('show');
            } else {
                getPositionFields();
            }
        });

        $('.activate_terms').click(function(){
            $('#terms').modal('show');
        });
    });
</script>

@stop
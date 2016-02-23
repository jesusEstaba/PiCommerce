@extends('builder.product')


@section('head-data')

<div class="toppings">
	<div class="row">
		<div class="col-xs-4">
			<h4>Dressing And Sauces:</h4>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>House Italian</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Italian</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Ranch</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Blue Cheese</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Honey Mustard</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Caesar</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>1000 Island</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>French</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Oil + Vin.</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>No Dressing </span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Hot Sauces</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Med Sauces</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Mild Sauces</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>BBQ Sauces</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Teriyaki</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Jamaican Jerk</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Garlic Parm</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Plain</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Blue CH</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Ranch</span>
				</label>
			</div>
		</div>
		
		<div class="col-xs-4">
			<h4>Kitchen Toppings:</h4>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Onions</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Green Peppers</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>BLK. Olives</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Cucumber</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Lettuce</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Tomatoes</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Oregano</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Salt + Pepper</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Mayo</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Mustard</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Honey Mustard</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Parm</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Parsley</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Cajun</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Oil + Vin.</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Butter</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Ketchup</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Pickles</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Mushrooms</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Ban Pepp</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Lite Onions</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Lite Green Peppers</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Hot</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"/>
					<span>Cold</span>
				</label>
			</div>
		</div>
		
		<div class="col-xs-4">
			<h4>Cooking Instructions</h4>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>No Pasta</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>No Sauce</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>No Cheese</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Crispy</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Extra Crispy</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Lite Pasta</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Lite Sauce</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Lite Cheese</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Lite Cook</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Well Done</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Extra Sauce</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>No Parm</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Pasta on Side</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Sauce on Side</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Double Cut</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Square Cut</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Cold</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Hot</span>
				</label>
			</div>
		</div>
	</div>
</div>

@stop
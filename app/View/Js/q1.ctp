<div class="alert  ">
<button class="close" data-dismiss="alert"></button>
Question: Advanced Input Field</div>

<p>
1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

<?php echo htmlentities('<input name="data[1][quantity]" class="">')?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
<button class="close" data-dismiss="alert"></button>
The table you start with</div>

<table class="table table-striped table-bordered table-hover">
<thead>
	<th class="text-center">
		<span data-table="tbody-container" id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
			<!-- <i class="icon-plus"></i> -->
			<i class="fa fa-plus"></i>
		</span>
	</th>
	<th width="55%">Description</th>
	<th width="20%">Quantity</th>
	<th width="20%">Unit Price</th>
</thead>

<tbody id="tbody-container">
	<tr>
		<td></td>
		<td onclick="editDescription(1)">
			<label id="description_label_1"></label>
			<textarea name="data[1][description]" class="m-wrap form-control description required" rows="2" style="display:none;"></textarea>
		</td>
		<td onclick="editQuantity(1)">
			<label id="quantity_label_1"></label>
			<input type="number" name="data[1][quantity]" class="form-control" style="display: none;">
		</td>
		<td onclick="editUnitPrice(1)">
			<label id="unit_price_label_1"></label>
			<input type="number" name="data[1][unit_price]"  class="form-control" style="display: none;">
		</td>
	</tr>

</tbody>

</table>


<p></p>
<div class="alert alert-info ">
<button class="close" data-dismiss="alert"></button>
Video Instruction</div>

<p style="text-align:left;">
<video width="78%"   controls>
  <source src="../app/webroot/video/q3_2.mov">
Your browser does not support the video tag.
</video>
</p>





<?php $this->start('script_own');?>
<script>
let ctr = 1;
$(document).ready(function(){

	$("#add_item_button").click(function(e){
		ctr++;

		// Create additional row
        var markup = '<tr id="row_' + ctr + '">'
						+ '<td class="text-center">'
							+ '<i class="fa fa-times" onclick="removeRow(' + ctr + ')"></i>'
						+ '</td>'
						+ '<td onclick="editDescription(' + ctr + ')">'
							+ '<label id="description_label_' + ctr + '"></label>'
							+ '<textarea name="data[' + ctr + '][description]" class="m-wrap form-control description required" rows="2" style="display:none;"></textarea>'
						+ '</td>'
						+ '<td onclick="editQuantity(' + ctr + ')">'
							+ '<label id="quantity_label_' + ctr + '"></label>'
							+ '<input type="number" name="data[' + ctr + '][quantity]" class="form-control" style="display: none;">'
						+ '</td>'
						+ '<td onclick="editUnitPrice(' + ctr + ')">'
							+ '<label id="unit_price_label_' + ctr + '"></label>'
							+ '<input type="number" name="data[' + ctr + '][unit_price]" class="form-control" style="display: none;">'
						+ '</td>'
					+ '</tr>';
        $("table tbody").append(markup); // append the variable to tbody to display the new row


	});
});

function editDescription(ctr){
	description_label = $('#description_label_' + ctr);
	description_textarea = $('textarea[name="data[' + ctr + '][description]');

	description_label.hide();
	description_textarea.show().focus();


	// When focus is lost from TextBox, hide TextBox and show Label.
	description_textarea.focusout(function () {
		description_textarea.hide();
		description_label.text(description_textarea.val()).show();
	});
}

function editQuantity(ctr){
	quantity_label = $('#quantity_label_' + ctr);
	quantity_input = $('input[name="data[' + ctr + '][quantity]');

	quantity_label.hide();
	quantity_input.show().focus();


	// When focus is lost from Input, hide Input and show Label.
	quantity_input.focusout(function () {
		quantity_input.hide();
		quantity_label.text(quantity_input.val()).show();
	});
}

function editUnitPrice(ctr){
	unit_price = $('#unit_price_label_' + ctr);
	unit_price_input = $('input[name="data[' + ctr + '][unit_price]');

	unit_price.hide();
	unit_price_input.show().focus();


	// When focus is lost from Input, hide Input and show Label.
	unit_price_input.focusout(function () {
		unit_price_input.hide();
		unit_price.text(unit_price_input.val()).show();
	});
}

function removeRow(ctr){
	// alert();
	$('#row_' + ctr).remove();
}

</script>
<?php $this->end();?>

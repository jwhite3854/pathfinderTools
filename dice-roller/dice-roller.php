<?php

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function render_pft_sidebar_content() {
	$dice_roller_nonce = wp_create_nonce("dice_roller_nonce");
?>
<style>

.dice_roller_tabs .tab_content {
	margin-bottom: 12px;
}


.dice_roller_tabs > ul > li {
    padding: 10px 15px;
    float: left;
    border: 1px solid #eee;
    border-width: 3px 1px 0 1px;
    border-radius: 5px 5px 0 0;
    margin-right: 1px;
	margin-bottom: 0;
    background-color: #f4f4f4;
}

.dice_roller_tabs > ul li.active {
    background-color: #fff;
    border-top-color: #003374;
}

.dice_roller_tabs .tab_content {
    padding: 15px;
    border: 1px solid #eee;
    box-shadow: 0 1px 2px #eee;
    background-color: #fff;
}

</style>
	<h4 class="widget-title">Dice Selection</h4>
	
		<div class="dice_roller_tabs">
			<ul>
				<li id="tab_standard" class="tab_selector"><a href="javascript:void(0)">Standard (XdY)</a></li>
				<li id="tab_rollkeep" class="tab_selector active"><a href="javascript:void(0)">Roll/Keep (XkY)</a></li>
			</ul>
			<div style="font-size: 0; display: block; clear: both; line-height: 0; height: 0; overflow: hidden;"></div>
			<form action="" method="post" id="dice_roller_form">
			<div class="tab_content" id="tab_standard_contents" style="display: none;">    
				<div>
					<strong>Number of Dice</strong>
					<input type="number" name="dice_qty" id="dice_qty" value="1" />
				</div>
				<div>
					<strong>Number of Sides</strong><br/>
					<select name="dice_type" id="dice_type" >
						<option value="2">2</option>
						<option value="4">4</option>
						<option value="6">6</option>
						<option value="8">8</option>
						<option value="10">10</option>
						<option value="12">12</option>
						<option value="20" selected>20</option>
						<option value="100">100</option>
						<option value="0">Other</option>
					</select>
					<div style="display:none;">
						<input type="number" name="dice_type_other"/>
					</div>
				</div>
			</div>
			<div class="tab_content" id="tab_rollkeep_contents" style="display: block;">
				<div>
					<input type="number" name="dice_roll_qty" style="width: 120px" value="1" />
					K
					<input type="number" name="dice_keep" style="width: 120px" value="1" />
				</div>
				<div>
					<input type="checkbox" name="tens_explode" id="tens_explode" style="width: 16px;" /> 10's Explode
				</div>
			</div>
			<input type="hidden" name="action" value="pft_dice_roller" />
			<input type="hidden" name="dice_roller_nonce" value="<?php echo $dice_roller_nonce ?>" />
			</form>
		</div>
		<a href="javascript:;" onclick="rollIt();" class="button" style="text-align:center">Roll</a>
		<a href="javascript:;" onClick="clearIt();">Reset</a>
	
	<script type="text/javascript">
		function clearIt() {
			document.getElementById("dice_table").innerHTML = '<div id="empty_table">Roll the dice...</div>';
		}

		function rollIt() {
			
			var httpRequest = new XMLHttpRequest();
			var formData = new FormData();
			var formInputs = document.getElementById("dice_roller_form").querySelectorAll("input"); 
	
			for( var i=0; i < formInputs.length; i++ ){
				formData.append(formInputs[i].name, formInputs[i].value); // Add all inputs inside formData().
			}

			var dice_type = document.getElementById("dice_type");
			formData.append("dice_type", dice_type.value);
		
			var tab_selected = document.getElementsByClassName("tab_selector active")[0];
			formData.append("roll_type", tab_selected.id);

			var tens_explode = document.getElementById("tens_explode").checked;
			formData.append("tens_explode", tens_explode);

			httpRequest.onreadystatechange = function(){
				if ( this.readyState == 4 && this.status == 200 ) {
					div = document.getElementById("dice_table").innerHTML;
					document.getElementById("dice_table").innerHTML = div+this.responseText; // Display the result inside result element.
				}
			};

        	httpRequest.open("POST", "<?php echo admin_url('admin-ajax.php') ?>");
        	httpRequest.send(formData);
		}
	</script>
	<?php
}

function render_pft_dice_roller_page() {

?>
	<div id="dice_table" style="min-height: 360px;">
		<div id="empty_table">Roll the dice...</div>
	</div>
	<?php
}
add_shortcode('pft_dice_roller', 'render_pft_dice_roller_page');
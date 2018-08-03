<?php

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function render_pft_sidebar_content() {
	$data = pft_magic_item_parameters();
	if(isset($_POST['filter_search'])){        
        set_search_parameters( $data, $_POST );
    }
?>
	<h4 class="widget-title">Spell Parameters</h4>
	<form action="" method="post">
		<div style="margin-bottom:8px">            
			<strong>Price Range</strong><br/>
			<input type="text" name="price_min" value="<?php echo $data['price_min'] ?>" style="width:45%"/> - 
			<input type="text" name="price_max" value="<?php echo $data['price_max'] ?>" style="width:45%;"/>
		</div>
		<strong>Slot</strong>
		<a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a>            
		<br/>
		<select name="slot[]" multiple size=6 style="margin-bottom:8px">
		<?php foreach ($data['slots'] as $slot => $set): ?>
			<option value="<?php echo $slot ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($slot) ?></option>
		<?php endforeach; ?>
		</select>
		<strong>Item Group</strong><a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a><br/>
		<select name="group[]" multiple size=6 style="margin-bottom:8px">
		<?php foreach ($data['groups'] as $group => $set): ?>
			<option value="<?php echo $group ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($group) ?></option>
		<?php endforeach; ?>
		</select>
		<input type="submit" value="Filter" name="filter_search" style="width:100%"/>
		<a href="<?php echo get_the_permalink() ?>">Reset</a>
	</form>
	<?php
}

function set_search_parameters( &$data, $post ) {

	$data['price_min'] = (int)$post["price_min"];
	$data['price_max'] = (int)$post["price_max"];

	$parameters = array(
		'price_min' => $data['price_min'],
		'price_max' => $data['price_max'],
		'slots'  	=> array(),
		'groups'  	=> array()
	);

	$slots_sel = $post["slot"];
	if(count($slots_sel)){
		foreach ($slots_sel as $key => $slot) {
			$data['slots'][$slot] = 1;
			$parameters['slots'][] = $slot;
		}
	}

	$groups_sel = $post["group"];
	if (count($groups_sel)) {
		foreach ($groups_sel as $key => $group) {
			$data['groups'][$group] = 1;
			$parameters['groups'][] = $slot;
		}
	}
	
	return $parameters;
}

function render_magic_item_search_page() {
	$items = array();

	$data = pft_magic_item_parameters();
	if(isset($_POST['filter_search'])){        
		$parameters = set_search_parameters( $data, $_POST );
		$items = pft_search_items($parameters);
    }
?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
	<table id="tableid" class="display">
		<thead>
			<tr>
				<th style="display:none"></th>
				<th>Name</th>
				<th>Slot</th>
				<th>Group</th>
				<th style="text-align:right">Price</th>
			</tr>
		</thead>
		<tbody>
			<?php $ct = 1; foreach ($items as $item): ?>
			<tr>
				<td style="display:none">
					<div id="item_<?php echo $ct ?>_desc"><?php echo $item["item_desc"] ?></div>
					<div id="item_<?php echo $ct ?>_source"><?php echo $item["item_source"] ?></div>
				</td>
				<td><a rel="item_<?php echo $ct ?>"><?php echo $item["item_name"] ?></a></td>
				<td><?php echo $item["item_slot"] ?></td>
				<td><?php echo $item["item_group"] ?></td>
				<td style="text-align:right"><?php echo number_format($item["price"]) ?></td>
			</tr>
			<?php $ct++; endforeach; ?>
		</tbody>
	</table>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" >
	jQuery(document).ready(function($){
		var table = $('#tableid').DataTable();
		$('#tableid_length select').width('64px');
		$('#tableid_filter input').width("50%");

		$('#tableid').on('click', 'a', function () {
			var tr = $(this).closest('tr');
			var desc = $('#'+$(this).attr('rel')+'_desc').html();
			var source = $('#'+$(this).attr('rel')+'_source').html();
			var row = table.row(tr);
		
			if (row.child.isShown()) {
				row.child.hide();
				tr.removeClass('shown');
			}
			else {
				row.child(format(desc,source)).show();
				tr.addClass('shown');
			}
		} );
		
		function format(desc,source) {
			return '<p style="font-size:.85em; line-height:1.4em;margin-bottom:10px">'+desc+'</p><div style="font-size:.7em;color:#888">'+source+'</div>';
		}
		
	});
	</script>
	<?php
}
add_shortcode('pft_magic_item_search', 'render_magic_item_search_page');

function pft_magic_item_parameters() {
	$data = array();
	$data['price_min'] = 0;
    $data['price_max'] = 500000;

    $data['slots'] = array(
		'Amulet' => 0,
		'Armor' => 0,
		'Belt' => 0,
		'Body' => 0,
		'Chest' => 0,
		'Cloak' => 0,
		'Eyes' => 0,
		'Face' => 0,
		'Feet' => 0,
		'Hands' => 0,
		'Head' => 0,
		'Headband' => 0,
		'Neck' => 0,
		'None' => 0,
		'Ring' => 0,
		'Rod' => 0,
		'Shield' => 0,
		'Shoulders' => 0,
		'Varies' => 0,
		'Waist' => 0,
		'Weapon' => 0,
		'Wrists' => 0
	);

    $data['groups'] = array(
		'Ammunition' => 0,
		'Armor' => 0,
		'Magical Tattoo' => 0,
		'Potion' => 0,
		'Ring' => 0,
		'Rod' => 0,
		'Staff' => 0,
		'Wand' => 0,
		'Weapon' => 0,
		'Wondrous Item' => 0
	);

	return $data;
}


function pft_search_items( $parameters ) {
	global $wpdb;
	
	$price_min = ( $parameters['price_min'] ? $parameters['price_min'] : 0 );
	$price_max = ( $parameters['price_max'] ? $parameters['price_max'] : 500000 );
	$slots = $parameters['slots'];
	$groups = $parameters['groups'];

    $sql = 'SELECT * from mtb_magic_items';
    
    $where = ' WHERE price >= '.$price_min.' AND price <= '.$price_max;

    $string = '';
    if(count($slots)) {    
        foreach ($slots as $slot) {
            $string .= "'".$slot."',";
        }
        $slot_string = rtrim($string,",");
        $where .= ' AND item_slot in ('.$slot_string.')';
    }

    $string = '';
    if(count($groups)) {
        foreach ($groups as $group) {
            $string .= "'".$group."',";
        }
        $group_string = rtrim($string,",");
        $where .= ' AND item_group in ('.$group_string.')';
	}
	
	$sql_full = $sql.$where.' ORDER BY item_name limit 5000';

    $items = $wpdb->get_results($sql_full, ARRAY_A);
    
    return $items;
}

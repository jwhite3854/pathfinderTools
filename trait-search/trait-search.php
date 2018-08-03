<?php

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function render_pft_sidebar_content() {
	$data = pft_feat_parameters();
	if(isset($_POST['filter_search'])){        
        set_search_parameters( $data, $_POST );
    }
?>
	<h4 class="widget-title">Trait Parameters</h4>
	<form action="" method="post" id="spell_search_form">
		<strong>Type</strong>
		<a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a>            
		<br/>
		<select name="type[]" multiple size=4 style="margin-bottom:8px">
		<?php foreach ($data['types'] as $type => $set): ?>
			<option value="<?php echo $type ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($type) ?></option>
		<?php endforeach; ?>
		</select>

		<strong>Category</strong>
		<a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a>            
		<br/>
		<select name="category[]" multiple size=4 style="margin-bottom:8px">
		<?php foreach ($data['categories'] as $category => $set): ?>
			<option value="<?php echo $category ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($category) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Keywords</strong>
		<br/>
		<input type="text" name="keywords" style="width:100%;margin-bottom:8px" value="<?php echo $data['keywords'] ?>" />

		<input type="submit" value="Filter" name="filter_search" style="width:100%;"/>
		<a href="<?php echo get_the_permalink() ?>">Reset</a>
	</form>
	<?php
}

function set_search_parameters( &$data, $post ) {

	$data['keywords'] = sanitize_text_field($post['keywords']);

	$parameters = array(
		'types'  	=> array(),
		'categories'  	=> array(),
		'keywords'	=> $data['keywords']
	);

	$types_sel = $post["type"];
	if(count($types_sel)){
		foreach ($types_sel as $key => $type) {
			$data['types'][$type] = 1;
			$parameters['types'][] = $type;
		}
	}

	$categories_sel = $post["category"];
	if(count($categories_sel)){
		foreach ($categories_sel as $key => $category) {
			$data['categories'][$category] = 1;
			$parameters['categories'][] = $category;
		}
	}

	return $parameters;
}

function render_pft_trait_search_page() {
	$traits = array();

	$data = pft_feat_parameters();
	if(isset($_POST['filter_search'])){        
		$parameters = set_search_parameters( $data, $_POST );
		$traits = pft_search_traits($parameters);
    }
?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
	<table id="tableid" class="display">
		<thead>
			<tr>
				<th>Name</th>
				<th style="display:none"></th>
				<th style="text-align:right">Type</th>
			</tr>
		</thead>
		<tbody>
			<?php $ct = 1; foreach ($traits as $trait): ?>
			<tr>
				<td style="white-space:nowrap;">
					<a rel="item_<?php echo $ct ?>"><?php echo $trait["name"] ?></a>
				</td>
				<td style="display:none">
					<div id="item_<?php echo $ct ?>">
						<p style="font-size:16px; line-height: 1.4em; margin-bottom: 4px">
							<?php if( !empty($trait["trait_cat"]) ): ?><strong>Category: </strong> <?php echo $trait["trait_cat"] ?><br/><?php endif; ?>
							<?php if( !empty($trait["trait_req"]) ): ?><strong>Requirements: </strong> <?php echo $trait["trait_req"] ?><br/><?php endif; ?>
						</p>
						<p style="line-height:1.4em;margin-bottom:10px"><?php echo $trait["desc"] ?></p>
					</div>
				</td>
				<td style="text-align:right"><?php echo $trait["type"] ?></td>
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
			var desc_full = $('#'+$(this).attr('rel')).html();
			var row = table.row(tr);
		
			if (row.child.isShown()) {
				row.child.hide();
				tr.removeClass('shown');
			}
			else {
				row.child(format(desc_full)).show();
				tr.addClass('shown');
			}
		} );
		
		function format(desc_full) {
			return '<div>'+desc_full+'</div>';
		}

		$('.clear_all').click( function(e) {
			e.preventDefault();
			var sel = $(this).find('select option');
			$(sel).attr('selected', 'selected');
		});
		
		  $('#spell_search_form').on('click', '.clear_all', function (e) {
		      e.preventDefault();
		      $(this).find('select').prop('selected', false);
		  });
			
	});
	</script>
	<?php
}
add_shortcode('pft_trait_search', 'render_pft_trait_search_page');

function pft_feat_parameters() {
	$data = array(
		'keywords' => ''
	);
	
	$data['types'] = array(
		'Basic' => 0, 
		'Campaign' => 0,
		'Combat' => 0,
		'Equipment' => 0,
		'Faction' => 0, 
		'Magic' => 0, 
		'Race' => 0, 
		'Racial' => 0, 
		'Regional' => 0, 
		'Religion' => 0
	);

	$data['categories'] = array(
		'Bloodline' => 0, 
		'Carrion Crown' => 0,
		'Combat' => 0,
		'Council of Thieves' => 0,
		'Curse of the Crimson Throne' => 0, 
		'Faith' => 0, 
		'Jade Regent' => 0, 
		'Kingmaker' => 0, 
		'Legacy of Fire' => 0, 
		"Mummy's Mask" => 0, 
		'Regional' => 0, 
		'Rise of the Runelords' => 0, 
		'Second Darkness' => 0, 
		"Serpent's Skull" => 0, 
		'Shattered Star' => 0, 
		'Skull & Shackles' => 0, 
		'Social' => 0
	);

	return $data;
}


function pft_search_traits( $parameters ) {
	global $wpdb;

	$types = $parameters['types'];
	$categories = $parameters['categories'];
	
	$sql = 'SELECT * from mtb_traits';
    
	$type_string = ''; $category_string = ''; $where = ' WHERE id > 0';
	
    if(count($types)) {    
        foreach ($types as $type) {
            $type_string .= "'".$type."',";
        }
        $type_string = rtrim($type_string,",");
        $where .= ' AND trait_type in ('.$type_string.')';
	}

	if(count($categories)) {    
        foreach ($categories as $category) {
            $category_string .= "'".$category."',";
        }
        $category_string = rtrim($category_string,",");
        $where .= ' AND trait_cat in ('.$category_string.')';
	}
	
	if ( !empty($parameters['keywords']) ) {
		$search_query = preg_replace("/[^A-Za-z0-9]/", '|', $parameters['keywords']);
		$keywords = explode('|', $search_query);

		$where .= ' AND (';
		$wheres = array();
		foreach ( $keywords as $keyword ) {
			$wheres[] = "trait_desc LIKE '%".$keyword."%'";
		}
		$where .= implode(' AND ', $wheres);
		$where .= ')';
	}

	$sql_full = $sql.$where.' ORDER BY trait_name limit 5000';

//	var_dump($sql_full);
//	die();

    $raw_traits = $wpdb->get_results($sql_full,ARRAY_A);    

	$i = 0;
	$traits = array();
    foreach ($raw_traits as $raw) {
        $traits[$i]['name'] = $raw['trait_name'];
		$traits[$i]['type'] = $raw['trait_type'];
		$traits[$i]['cat'] = $raw['trait_cat'];
        $traits[$i]['trait_req'] = $raw['trait_req'];
        $traits[$i]['desc'] = $raw['trait_desc'];
        $i++;
    }

    return $traits;
}
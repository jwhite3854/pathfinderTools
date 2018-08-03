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
	<h4 class="widget-title">Feat Parameters</h4>
	<form action="" method="post" id="spell_search_form">
		<strong>Type</strong>
		<a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a>            
		<br/>
		<select name="type[]" multiple size=3 style="margin-bottom:8px">
		<?php foreach ($data['types'] as $type => $set): ?>
			<option value="<?php echo $type ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($type) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Feat Prerequisite</strong>
		<a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a>            
		<br/>
		<select name="feat[]" style="margin-bottom:8px">
		<?php foreach ($data['feat'] as $skill => $set): ?>
			<option value="<?php echo $skill ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($skill) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Skill Prerequisite</strong>
		<a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a>            
		<br/>
		<select name="skill[]" style="margin-bottom:8px">
		<?php foreach ($data['skill'] as $skill => $set): ?>
			<option value="<?php echo $skill ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($skill) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Prerequisite Keywords</strong>
		<br/>
		<input type="text" name="prereq_keywords" style="width:100%;margin-bottom:8px" value="<?php echo $data['prereq_keywords'] ?>" />

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Benefit Keywords</strong>
		<br/>
		<input type="text" name="keywords" style="width:100%;margin-bottom:8px" value="<?php echo $data['keywords'] ?>" />

		<input type="submit" value="Filter" name="filter_search" style="width:100%;"/>
		<a href="<?php echo get_the_permalink() ?>">Reset</a>
	</form>
	<?php
}

function set_search_parameters( &$data, $post ) {

	$data['keywords'] = sanitize_text_field($post['keywords']);
	$data['prereq_keywords'] = sanitize_text_field($post['prereq_keywords']);

	$parameters = array(
		'types'  	=> array(),
		'keywords'	=> $data['keywords'],
		'prereq_keywords'	=> $data['prereq_keywords']
	);

	$types_sel = $post["type"];
	if(count($types_sel)){
		foreach ($types_sel as $key => $type) {
			$data['types'][$type] = 1;
			$parameters['types'][] = $type;
		}
	}

	$skills_sel = $post["skill"];
	if(count($skills_sel)){
		foreach ($skills_sel as $key => $skill) {
			$data['skill'][$skill] = 1;
			$parameters['skill'][] = $skill;
		}
	}

	$feats_sel = $post["feat"];
	if(count($feats_sel)){
		foreach ($feats_sel as $key => $feat) {
			$data['feat'][$feat] = 1;
			$parameters['feat'][] = $feat;
		}
	}

	return $parameters;
}

function render_pft_feat_search_page() {
	$feats = array();

	$data = pft_feat_parameters();
	if(isset($_POST['filter_search'])){        
		$parameters = set_search_parameters( $data, $_POST );
		$feats = pft_search_feats($parameters);
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
			<?php $ct = 1; foreach ($feats as $feat): ?>
			<tr>
				<td style="white-space:nowrap;">
					<a rel="item_<?php echo $ct ?>"><?php echo $feat["name"] ?></a>
				</td>
				<td style="display:none">
					<div id="item_<?php echo $ct ?>">
						<p style="font-size:16px; line-height: 1.4em; margin-bottom: 4px">
							<?php if( !empty($feat["prereq"]) ): ?><strong>Prerequisites: </strong> <?php echo rtrim($feat["prereq"],'.') ?><br/><?php endif; ?>
						</p>
						<p style="line-height:1.4em;margin-bottom:10px"><strong>Benefit: </strong><?php echo $feat["benefit"] ?></p>
						<?php if( !empty($feat["normal"]) ): ?><p style="font-size:.85em; line-height:1.4em;margin-bottom:10px"><strong>Normal: </strong><?php echo $feat["normal"] ?></p><?php endif; ?>
						<?php if( !empty($feat["special"]) ): ?><p style="font-size:.85em; line-height:1.4em;margin-bottom:10px"><strong>Special: </strong><?php echo $feat["special"] ?></p><?php endif; ?>
						<div style="font-size:.7em;color:#888"><?php echo $feat["source"] ?></div>
					</div>
				</td>
				<td style="text-align:right"><?php echo $feat["type"] ?></td>
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

		$('#spell_search_form').on('click', '.clear_all', function (e) {
			e.preventDefault();
			var werwer = $(this).find('select');
			console.log($(this).next('select').attr());
		});
			
	});
	</script>
	<?php
}
add_shortcode('pft_feat_search', 'render_pft_feat_search_page');

function pft_feat_parameters() {
	$data = array(
		'keywords' => '',
		'prereq_keywords' => ''
	);
	
	$data['types'] = array(
		'General' => 0, 
		'Combat' => 0,
		'Achievement' => 0,
		'Familiar' => 0,
		'Grit' => 0, 
		'Item Creation' => 0,
		'Item Mastery' => 0,
		'Metamagic' => 0, 
		'Monster' => 0, 
		'Mythic' => 0, 
		'Story' => 0, 
		'Teamwork' => 0
	);

	$data['skill'] = array(
		'No Preference Selected' => 0, 
		'No Skill Prerequisite' => 0, 
		'Acrobatics' => 0, 
		'Appraise' => 0,
		'Bluff' => 0,
		'Climb' => 0, 
		'Craft' => 0,
		'Diplomacy' => 0,
		'Disable Device' => 0, 
		'Disguise' => 0, 
		'Escape Artist' => 0, 
		'Fly' => 0, 
		'Handle Animal' => 0,
		'Heal' => 0, 
		'Intimidate' => 0, 
		'Knowledge' => 0, 
		'Linguistics' => 0, 
		'Perception' => 0, 
		'Perform' => 0, 
		'Perception' => 0, 
		'Profession' => 0, 
		'Ride' => 0, 
		'Sense Motive' => 0, 
		'Sleight of Hand' => 0, 
		'Spellcraft' => 0, 
		'Stealth' => 0, 
		'Survival' => 0, 
		'Swim' => 0, 
		'Use Magic Device' => 0
	);

	$data['feat'] = array(
		'No Preference Selected' => 0, 
		'No Feat Prerequisite' => 0, 
		'Blind-Fight' => 0, 
		'Cleave' => 0,
		'Combat Expertise' => 0,
		'Combat Reflexes' => 0,
		'Critical Focus' => 0, 
		'Dodge' => 0,
		'Elemental Fist' => 0,
		'Exotic Weapon Proficiency' => 0, 
		'Improved Bull Rush' => 0, 
		'Improved Dirty Trick' => 0, 
		'Improved Feint' => 0, 
		'Improved Grapple' => 0,
		'Improved Trip' => 0, 
		'Improved Unarmed Strike' => 0, 
		'Mobility' => 0, 
		'Point-Blank Shot' => 0, 
		'Power Attack' => 0, 
		'Precise Shot' => 0, 
		'Rapid Shot' => 0, 
		'Skill Focus' => 0, 
		'Spell Focus' => 0, 
		'Stunning Fist' => 0, 
		'Two-Weapon Fighting' => 0, 
		'Vital Strike' => 0, 
		'Weapon Finesse' => 0, 
		'Weapon Focus' => 0
	);

	return $data;
}


function pft_search_feats( $parameters ) {
	global $wpdb;

	$types = $parameters['types'];
	
	$sql = 'SELECT * from mtb_feats';
    
	$where = ' WHERE id > 0';
	
    if(count($types)) {    
        foreach ($types as $type) {
            $type_string .= "'".$type."',";
        }
        $type_string = rtrim($type_string,",");
        $where .= ' AND feat_type in ('.$type_string.')';
	}
	
	if ( !empty($parameters['keywords']) ) {
		$search_query = preg_replace("/[^A-Za-z0-9]/", '|', $parameters['keywords']);
		$keywords = explode('|', $search_query);

		$where .= ' AND (';
		$wheres = array();
		foreach ( $keywords as $keyword ) {
			$wheres[] = "benefit LIKE '%".$keyword."%'";
		}
		$where .= implode(' AND ', $wheres);
		$where .= ')';
	}

	if ( !empty($parameters['prereq_keywords']) ) {
		$search_query = preg_replace("/[^A-Za-z0-9]/", '|', $parameters['prereq_keywords']);
		$prereq_keywords = explode('|', $search_query);

		$where .= ' AND (';
		$wheres = array();
		foreach ( $prereq_keywords as $keyword ) {
			$wheres[] = "feat_prereq LIKE '%".$keyword."%'";
		}
		$where .= implode(' AND ', $wheres);
		$where .= ')';
	}

	if(count($parameters['skill'])) {    
        foreach ($parameters['skill'] as $id => $skill) {
			if ( $skill == 'No Skill Prerequisite' ) {
				$where .= " AND prereq_skills = ''";
			} elseif ( $skill != 'No Preference Selected' ) {
				$where .= " AND prereq_skills LIKE '%".$skill."%'";
			} 
        }
	}

	if(count($parameters['feat'])) {    
        foreach ($parameters['feat'] as $id => $feat) {
			if ( $feat == 'No Feat Prerequisite' ) {
				$where .= " AND prereq_feats = ''";
			} elseif ( $feat != 'No Preference Selected' ) {
				$where .= " AND prereq_feats LIKE '%".$feat."%'";
			} 
        }
	}

	$sql_full = $sql.$where.' ORDER BY feat_name limit 5000';

//	var_dump($sql_full);
//	die();

    $raw_feats = $wpdb->get_results($sql_full,ARRAY_A);    

	$i = 0;
	$feats = array();
    foreach ($raw_feats as $raw) {
        $feats[$i]['name'] = $raw['feat_name'];
        $feats[$i]['type'] = $raw['feat_type'];
        $feats[$i]['desc'] = $raw['feat_desc'];
        $feats[$i]['prereq'] = ucfirst($raw['feat_prereq']);
        $feats[$i]['prereq_feats'] = ucfirst($raw['prereq_feats']);
        $feats[$i]['prereq_skills'] = ucfirst($raw['prereq_skills']);
        $feats[$i]['spell_range'] = ucfirst($raw['spell_range']);
        $feats[$i]['benefit'] = ucfirst($raw['benefit']);
        $feats[$i]['normal'] = ucfirst($raw['normal']);
        $feats[$i]['special'] = ucfirst($raw['special']);
        $feats[$i]['source'] = ucfirst($raw['feat_source']);

        $i++;
    }

    return $feats;
}
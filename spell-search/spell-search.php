<?php

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function render_pft_sidebar_content() {
	$data = pft_spell_parameters();
	if(isset($_POST['filter_search'])){        
        set_search_parameters( $data, $_POST );
    }
?>
	<h4 class="widget-title">Spell Parameters</h4>
	<form action="" method="post" id="spell_search_form">
		<strong>Class</strong>
		<a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a>            
		<br/>
		<select name="class[]" multiple size=3 style="margin-bottom:8px">
		<?php foreach ($data['classes'] as $class => $set): ?>
			<option value="<?php echo $class ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($class) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Level</strong>
		<a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a>
		<br/>
		<select name="level[]" multiple size=3 style="margin-bottom:8px">
		<?php foreach ($data['levels'] as $level => $set): ?>
			<option value="<?php echo $level ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($level) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>School</strong>
		<a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a>            
		<br/>
		<select name="school[]" multiple size=3 style="margin-bottom:8px">
		<?php foreach ($data['schools'] as $school => $set): ?>
			<option value="<?php echo $school ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($school) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Subschool</strong>
		<a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a>
		<br/>
		<select name="subschool[]" multiple size=3 style="margin-bottom:8px">
		<?php foreach ($data['subschools'] as $subschool => $set): ?>
			<option value="<?php echo $subschool ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($subschool) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Descriptor</strong>
		<a href="#" class="clear_all" style="font-size:0.8em;float:right;padding-top: 4px;">Clear</a>
		<br/>
		<select name="descriptor[]" multiple size=3 style="margin-bottom:8px">
		<?php foreach ($data['descriptors'] as $descriptor => $set): ?>
			<option value="<?php echo $descriptor ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($descriptor) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Range</strong>
		<br/>
		<select name="range" style="margin-bottom:8px">
		<?php foreach ($data['range'] as $range => $set): ?>
			<option value="<?php echo $range ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($range) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Verbal Component</strong>
		<br/>
		<select name="verbal" style="margin-bottom:8px">
		<?php foreach ($data['verbal'] as $verbal => $set): ?>
			<option value="<?php echo $verbal ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($verbal) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Somatic Component</strong>
		<br/>
		<select name="somatic" style="margin-bottom:8px">
		<?php foreach ($data['somatic'] as $somatic => $set): ?>
			<option value="<?php echo $somatic ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($somatic) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Material Component</strong>
		<br/>
		<select name="material" style="margin-bottom:8px">
		<?php foreach ($data['material'] as $material => $set): ?>
			<option value="<?php echo $material ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($material) ?></option>
		<?php endforeach; ?>
		</select>

		<hr style="padding:0;margin:8px 0 4px"/>
		<strong>Divine Focus</strong>
		<br/>
		<select name="divine" style="margin-bottom:8px">
		<?php foreach ($data['divine'] as $divine => $set): ?>
			<option value="<?php echo $divine ?>" <?php echo ($set ? 'selected' : '' )?> ><?php echo ucfirst($divine) ?></option>
		<?php endforeach; ?>
		</select>

		<input type="submit" value="Filter" name="filter_search" style="width:100%;"/>
		<a href="<?php echo get_the_permalink() ?>">Reset</a>
	</form>
	<?php
}

function set_search_parameters( &$data, $post ) {

	$parameters = array(
		'schools'  	=> array(),
		'subschools'  	=> array(),
		'classes'  	=> array(),
		'levels'  	=> array(),
		'descriptors'  	=> array(),
		'base_classes' => array('adept' => 0, 'alchemist' => 0, 'antipaladin' => 0,
        	'bard' => 0, 'bloodrager' => 0, 'cleric' => 0, 'druid' => 0, 'hunter' => 0,
        	'inquisitor' => 0, 'investigator' => 0, 'magus' => 0, 'medium' => 0,
        	'mesmerist' => 0, 'occultist' => 0, 'oracle' => 0, 'paladin' => 0,
        	'psychic' => 0, 'ranger' => 0, 'shaman' => 0, 'skald' => 0, 'sorceror' => 0,
        	'spiritualist' => 0, 'summoner' => 0, 'witch' => 0, 'wizard' => 0)
	);

	$schools_sel = $post["school"];
	if(count($schools_sel)){
		foreach ($schools_sel as $key => $school) {
			$data['schools'][$school] = 1;
			$parameters['schools'][] = $school;
		}
	}

	$subschools_sel = $post["subschool"];
	if(count($subschools_sel)){
		foreach ($subschools_sel as $key => $subschool) {
			$data['subschools'][$subschool] = 1;
			$parameters['subschools'][] = $subschool;
		}
	}

	$classes_sel = $post["class"];
	if(count($classes_sel)){
		foreach ($classes_sel as $key => $class) {
			$data['classes'][$class] = 1;
			$parameters['classes'][] = $class;
		}
	}

	$levels_sel = $post["level"];
	if(count($levels_sel)){
		foreach ($levels_sel as $key => $level) {
			$data['levels'][$level] = 1;
			$parameters['levels'][] = $level;
		}
	}

	$descriptors_sel = $post["descriptor"];
	if(count($descriptors_sel)) {
		foreach ($descriptors_sel as $key => $descriptor) {
			$data['descriptors'][$descriptor] = 1;
			$parameters['descriptors'][] = $descriptor;
		}
	}

	$range = $post["range"];
	$data['range'][$range] = 1;
	$parameters['range'] = $range;

	$verbal = $post["verbal"];
	$data['verbal'][$verbal] = 1;
	$parameters['verbal'] = $verbal;

	$somatic = $post["somatic"];
	$data['somatic'][$somatic] = 1;
	$parameters['somatic'] = $somatic;
	
	$material = $post["material"];
	$data['material'][$material] = 1;
	$parameters['material'] = $material;

	$divine = $post["divine"];
	$data['divine'][$divine] = 1;
	$parameters['divine'] = $divine;

	return $parameters;
}

function render_pft_spell_search_page() {
	$spells = array();

	$data = pft_spell_parameters();
	if(isset($_POST['filter_search'])){        
		$parameters = set_search_parameters( $data, $_POST );
		$spells = pft_search_spells($parameters);
    }
?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
	<table id="tableid" class="display">
		<thead>
			<tr>
				<th>Name</th>
				<th style="display:none"></th>
				<th style="text-align:right">Class Level</th>
			</tr>
		</thead>
		<tbody>
			<?php $ct = 1; foreach ($spells as $spell): ?>
			<tr>
				<td style="white-space:nowrap;">
					<a rel="item_<?php echo $ct ?>"><?php echo $spell["name"] ?></a>
				</td>
				<td style="display:none">
					<div id="item_<?php echo $ct ?>">
						<p style="font-size:16px; line-height: 1.2em; margin-bottom: 4px">
							<strong>School</strong> <?php echo $spell["school"] ?>
							<?php echo (strlen($spell["subschool"]) > 2 ? ' ('.$spell["subschool"] .')' : '') ?>
							<?php echo ($spell["descriptors"] ? ' ['.$spell["descriptors"] .']' : '') ?>
							<br/> 
							<strong>Level</strong> <?php echo $spell["levels"] ?><br/>
							<strong>Casting Time</strong> <?php echo $spell["casting_time"] ?><br/>
							<strong>Components</strong> <?php echo $spell["components"] ?><br/>
							<strong>Range</strong> <?php echo $spell["spell_range"] ?><br/>
							<?php echo ($spell["area"] ? '<strong>Area</strong> '.$spell["area"] .'<br/>' : '') ?>
							<?php echo ($spell["targets"] ? '<strong>Targets</strong> '.$spell["targets"] .'<br/>' : '') ?>
							<?php echo ($spell["effect"] ? '<strong>Effect</strong> '.$spell["effect"] .'<br/>' : '') ?>
							<strong>Duration</strong> <?php echo $spell["duration"] ?><br/>
							<strong>Saving Throw</strong> <?php echo $spell["saving_throw"] ?>; <strong>Spell Resistance</strong> <?php echo $spell["spell_resistence"] ?>
						</p>
						<p style="font-size:.85em; line-height:1.4em;margin-bottom:10px"><?php echo $spell["spell_desc"] ?></p>
						<div style="font-size:.7em;color:#888"><?php echo $spell["source"] ?></div>
					</div>
				</td>
				<td style="text-align:right"><?php echo $spell["levels"] ?></td>
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
add_shortcode('pft_spell_search', 'render_pft_spell_search_page');

function pft_spell_parameters() {
	$data = array();
	
	$data['schools'] = array('abjuration' => 0, 'conjuration' => 0, 'divination' => 0,
        'enchantment' => 0, 'evocation' => 0, 'illusion' => 0, 'necromancy' => 0,
        'transformation' => 0, 'transmutation' => 0, 'universal' => 0,);

    $data['subschools'] = array('creation' => 0, 'calling' => 0, 'charm' => 0,
        'compulsion' => 0, 'figment' => 0, 'glamer' => 0, 'healing' => 0,
        'light' => 0, 'pattern' => 0, 'phantasm' => 0, 'polymorph' => 0,
        'scrying' => 0, 'shadow' => 0, 'summoning' => 0, 'teleportation' => 0);

    $data['classes'] = array('adept' => 0, 'alchemist' => 0, 'antipaladin' => 0,
        'bard' => 0, 'bloodrager' => 0, 'cleric' => 0, 'druid' => 0, 'hunter' => 0,
        'inquisitor' => 0, 'investigator' => 0, 'magus' => 0, 'medium' => 0,
        'mesmerist' => 0, 'occultist' => 0, 'oracle' => 0, 'paladin' => 0,
        'psychic' => 0, 'ranger' => 0, 'shaman' => 0, 'skald' => 0, 'sorceror' => 0,
		'spiritualist' => 0, 'summoner' => 0, 'witch' => 0, 'wizard' => 0);

    $data['descriptors'] = array('acid' => 0, 'air' => 0, 'chaotic' => 0, 'cold' => 0, 'curse' => 0,
        'darkness' => 0, 'death' => 0, 'disease' => 0, 'earth' => 0, 'electricity' => 0,
        'emotion' => 0, 'evil' => 0, 'fear' => 0, 'fire' => 0, 'force' => 0, 'good' => 0,
        'language_dependent' => 0, 'lawful' => 0, 'light' => 0, 'mind_affecting' => 0,
        'pain' => 0, 'poison' => 0, 'shadow' => 0, 'sonic' => 0, 'water' => 0);

	$data['levels'] = array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0);

	$data['range'] = array( 'No Preference' => 0, 'Touch' => 0, 'Personal' => 0, 'Close' => 0, 'Medium' => 0, 'Long' => 0, 'Unlimited' => 0);
	
	$data['verbal'] = array('No Preference' => 0, 'No' => 0, 'Yes' => 0);
	$data['somatic'] = array('No Preference' => 0, 'No' => 0, 'Yes' => 0);
	$data['material'] = array('No Preference' => 0, 'No' => 0, 'Yes' => 0);
	$data['divine'] = array('No Preference' => 0, 'No' => 0, 'Yes' => 0);
		

	return $data;
}


function pft_search_spells( $parameters ) {
	global $wpdb;

	$schools = $parameters['schools'];
	$subschools = $parameters['subschools'];
	$classes = $parameters['classes'];
	$subschools = $parameters['subschools'];
	$descriptors = $parameters['descriptors'];
	$levels = $parameters['levels'];
	$base_classes = $parameters['base_classes'];

	$range = $parameters['range'];

	$verbal = $parameters['verbal'];
	$somatic = $parameters['somatic'];
	$material = $parameters['material'];
	$divine = $parameters['divine'];

	$sql = 'SELECT * from mtb_magic_spells';
    
	$schools_string = ''; $where = ' WHERE id > 0';
	
    if(count($schools)) {    
        foreach ($schools as $school) {
            $schools_string .= "'".$school."',";
        }
        $schools_string = rtrim($schools_string,",");
        $where .= ' AND spell_school in ('.$schools_string.')';
    }

    $subschools_string = '';
    if(count($subschools)) {    
        foreach ($subschools as $subschool) {
            $subschools_string .= "'".$subschool."',";
        }
        $subschools_string = rtrim($subschools_string,",");
        $where .= ' AND spell_subschool in ('.$subschools_string.')';
    }

    $cl_string = array();
    if(count($classes) > 0 && count($levels) > 0) {    
        foreach ($classes as $class) {
            foreach ($levels as $level) {
                $cl_string[] = $class.' = '.$level;
            }        
        }
        $where .= ' AND ('.implode(" OR ",$cl_string).')';
    } elseif(count($classes) > 0 && count($levels) == 0) {    
        foreach ($classes as $class) {
            $cl_string[] = $class.' is not NULL';
        }
        $where .= ' AND ('.implode(" OR ",$cl_string).')';
    } elseif(count($classes) == 0 && count($levels) > 0) {    
        foreach ($base_classes as $class => $val) {
            foreach ($levels as $level) {     
                $cl_string[] = $class.' = '.$level;
            }
        }
        $where .= ' AND ('.implode(" OR ",$cl_string).')';
    }

    $desc_string = array();
    if(count($descriptors)) {    
        foreach ($descriptors as $descriptor) {
            $desc_string[] = $descriptor.' = 1';
        }
        $where .= ' AND ('.implode(" OR ",$desc_string).')';
	}
	

	if ( $verbal == 'No' ) {
		$where .= ' AND verbal = 0';
	} elseif ( $verbal == 'Yes' ) {
		$where .= ' AND verbal = 1';
	}

	if ( $somatic == 'No' ) {
		$where .= ' AND somatic = 0';
	} elseif ( $verbal == 'Yes' ) {
		$where .= ' AND somatic = 1';
	}

	if ( $material == 'No' ) {
		$where .= ' AND material = 0';
	} elseif ( $verbal == 'Yes' ) {
		$where .= ' AND material = 1';
	}

	if ( $divine == 'No' ) {
		$where .= ' AND divine_focus = 0';
	} elseif ( $verbal == 'Yes' ) {
		$where .= ' AND divine_focus = 1';
	}

	if ( $range != 'No Preference' ) {
		$where .= " AND spell_range LIKE '%".$range."%'";
	} 

	$sql_full = $sql.$where.' ORDER BY spell_name limit 5000';

//	var_dump($sql_full);
//	die();


    $raw_spells = $wpdb->get_results($sql_full,ARRAY_A);    

	$i = 0;
	$spells = array();
    foreach ($raw_spells as $raw) {
        $spells[$i]['name'] = $raw['spell_name'];
        $spells[$i]['spell_desc'] = $raw['spell_desc'];
        $spells[$i]['source'] = $raw['spell_source'];
        $spells[$i]['school'] = ucfirst($raw['spell_school']);
        $spells[$i]['subschool'] = ucfirst($raw['spell_subschool']);
        $spells[$i]['casting_time'] = ucfirst($raw['casting_time']);
        $spells[$i]['spell_range'] = ucfirst($raw['spell_range']);
        $spells[$i]['components'] = ucfirst($raw['components']);
        $spells[$i]['area'] = ucfirst($raw['area']);
        $spells[$i]['targets'] = ucfirst($raw['targets']);
        $spells[$i]['effect'] = ucfirst($raw['effect']);
        $spells[$i]['duration'] = ucfirst($raw['duration']);
        $spells[$i]['saving_throw'] = ( $raw['saving_throw'] ? ucfirst($raw['saving_throw']) : 'None');
        $spells[$i]['spell_resistence'] = ( $raw['spell_resistence'] ? ucfirst($raw['spell_resistence']) : 'No' );

        $cl = array();
        $desc = array();

        if(count($classes) > 0) {    
            foreach ($classes as $class) {
                if (count($levels)) {
                    if (in_array($raw[$class],$levels)) {
                        $cl[] = ucfirst($class).' '.$raw[$class];
                    }
                } else {
                    if (!is_null($raw[$class])) {
                        $cl[] = ucfirst($class).' '.$raw[$class];
                    }
                }
            }
        } else {
            foreach ($base_classes as $class => $val) {
                if (!is_null($raw[$class])) {
                    $cl[] = ucfirst($class).' '.$raw[$class];
                }
            }
        }
        $spells[$i]['levels'] = implode(', ',$cl);
        $i++;
    }

    return $spells;
}
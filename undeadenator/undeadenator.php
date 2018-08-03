<?php

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function render_pft_undeadenator_page() {

?>
    <div id="writeroot" ><div id="monsterDiv" style="min-height: 360px;">&nbsp;</div></div>
    <script type="text/javascript" src="/toolbox/wp-content/plugins/pathfinder-tools/undeadenator/undead.js"></script>
	<script type="text/javascript" >
        clearform();
        importXML();
	</script>
	<?php
}
add_shortcode('pft_undeadenator', 'render_pft_undeadenator_page');


function render_pft_sidebar_content() {
    ?>
    <h4 class="widget-title">Base Template</h4>
    <div>
        <form id="undeadenator_form">
            <div>
                <select name="MonsterChooser">
                    <option value='-1'>...</option>
                </select>
            </div>
            <div>
                <input name="Skeleton" type="checkbox" /> Skeleton
        	    <input name="Zombie" type="checkbox" /> Zombie
		        <input name="ShowMultiple" type="checkbox" checked /> Show Multiple
		        <input name="RacialHitDice" type="text" size="1" value="1" maxlength="2" style="text-align:center;" /> Racial Hit Dice
            </div>
            <div>
                <input name="Go" type="button" value="Go" onClick="doIt();"> 
                <input name="Reset" type="button" value="Reset" onClick="clearform();">
            </div>
        </form>
    </div>
    <?php 
}
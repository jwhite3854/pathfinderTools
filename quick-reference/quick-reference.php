<?php

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function render_pft_sidebar_content() {
?>
	<h4 class="widget-title">Quick Find</h4>
    <ol id="reference_list">
		<li>
			<a href="#Skill-Checks">Skill Checks</a>
			<ol>
				<li>
					<a href="#Acrobatics">Acrobatics (Dex; ACP)</a>
				</li>
				<li>
					<a href="#Bluff">Bluff (Cha)</a>
				</li>
				<li>
					<a href="#Climb">Climb (Str; ACP)</a>
				</li>
				<li>
					<a href="#Diplomacy">Diplomacy (Cha)</a>
				</li>
				<li>
					<a href="#Disable-Device">Disable Device (Dex; ACP; Trained)</a>
				</li>
				<li>
					<a href="#Disguise">Disguise (Cha)</a>
				</li>
				<li>
					<a href="#Escape-Artist">Escape Artist (Dex; ACP)</a>
				</li>
				<li>
					<a href="#Fly">Fly (Dex; ACP)</a>
				</li>
				<li>
					<a href="#Handle-Animal">Handle Animal (Cha; Trained)</a>
				</li>
				<li>
					<a href="#Heal">Heal (Wis)</a>
				</li>
				<li>
					<a href="#Knowledge">Knowledge (Int; Trained)</a>
				</li>
				<li>
					<a href="#Linguistics">Linguistics (Int; Trained)</a>
				</li>
				<li>
					<a href="#Perception">Perception (Wis)</a>
				</li>
				<li>
					<a href="#Ride">Ride (Dex; ACP)</a>
				</li>
				<li>
					<a href="#Spellcraft">Spellcraft (Int; Trained)</a>
				</li>
				<li>
					<a href="#Survival">Survival (Wis)</a>
				</li>
				<li>
					<a href="#Swim">Swim (Str; ACP)</a>
				</li>
				<li>
					<a href="#Use-Magic-Device">Use Magic Device (Cha; Trained)</a>
				</li>
			</ol>
		</li>
		<li>
			<a href="#Combat">Combat</a>
			<ol>
				<li>
					<a href="#Actions-in-Combat">Actions in Combat</a>
				</li>
				<li>
					<a href="#Attack-Roll-Modifiers">Attack Roll Modifiers</a>
				</li>
				<li>
					<a href="#Armor-Class-Modifiers">Armor Class Modifiers</a>
				</li>
				<li>
					<a href="#Size-Bonuses-and-Penalties">Size Bonuses and Penalties</a>
				</li>
				<li>
					<a href="#Combat-Maneuver-Summary">Combat Maneuver Summary</a>
				</li>
				<li>
					<a href="#Grapple-Guide">Grapple Guide</a>
				</li>
				<li>
					<a href="#Equipment-Hardness-and-Hit-Points">Equipment Hardness and Hit Points</a>
				</li>
				<li>
					<a href="#Substance-Hardness-and-Hit-Points">Substance Hardness and Hit Points</a>
				</li>
				<li>
					<a href="#Common-Object-Hardness-and-Hit-Points">Common Object Hardness and Hit Points</a>
				</li>
				<li>
					<a href="#DCs-to-Break-or-Burst-Items">DCs to Break or Burst Items</a>
				</li>
				<li>
					<a href="#Concentration-Check-DCs">
					Concentration Check DCs</a>
				</li>
				<li>
					<a href="#Underwater-Combat">Underwater Combat</a>
				</li>
				<li>
					<a href="#Splash-Weapons">Splash Weapons</a>
				</li>
			</ol>
		</li>
		<li>
			<a href="#Conditions">Conditions</a>
		</li>
	</ol>

	<?php
}
function render_pft_quick_reference_page() {
?>
	<h2 style="font-size:18px" id="Combat"></a>Combat</h2>
    <h3 style="font-size:14px"><a name="Actions-in-Combat"></a>Actions in Combat</h3>
	<table border="0" cellpadding="3" style="border-collapse:collapse;width:100%;margin:2px">
	<tbody>
		<tr>
			<td>Standard Action</td>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">Attack of Opportunity</a><sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td>Attack (melee)</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Attack (ranged)</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Attack (unarmed)</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Activate-Magic-Item">Activate</a> a magic item other than a <a target="_blank" href="http://www.d20pfsrd.com/magic-items/potions" style="font-style:italic">potion</a> or oil</td>
			<td>No</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Aid-Another">Aid another</a></td>
			<td>Maybe<sup style="font-size:10px">2</sup></td>
		</tr>
		<tr>
			<td>Cast a spell (1 <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Standard-Actions">standard action</a> <a target="_blank" href="http://www.d20pfsrd.com/magic#TOC-Casting-Time">casting time</a>)</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Channel energy</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Concentrate to maintain an active spell</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Dismiss a spell</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Draw a hidden weapon (see <a target="_blank" href="http://www.d20pfsrd.com/skills/sleight-of-hand">Sleight of Hand</a> skill)</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Drink a <a target="_blank" href="http://www.d20pfsrd.com/magic-items/potions" style="font-style:italic">potion</a> or apply an oil</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Escape a <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Grapple">grapple</a></td>
			<td>No</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Feint">Feint</a></td>
			<td>No</td>
		</tr>
		<tr>
			<td>Light a torch with a tindertwig</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Lower <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/special-abilities#TOC-Spell-Resistance">spell resistance</a></td>
			<td>No</td>
		</tr>
		<tr>
			<td>Read a <a target="_blank" href="http://www.d20pfsrd.com/magic-items/scrolls" style="font-style:italic">scroll</a></td>
			<td>Yes</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Ready">Ready</a> (triggers a <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Standard-Actions">standard action</a>)</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Stabilize a <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Dying">dying</a> friend (see <a target="_blank" href="http://www.d20pfsrd.com/skills/heal">Heal</a> skill)</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Total defense</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Use extraordinary ability</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Use skill that takes 1 action</td>
			<td>Usually</td>
		</tr>
		<tr>
			<td>Use <a target="_blank" href="http://www.d20pfsrd.com/magic#TOC-Spell-Like-Abilities-Sp-">spell-like ability</a></td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Use <a target="_blank" href="http://www.d20pfsrd.com/magic#TOC-Supernatural-Abilities-Su-">supernatural</a> ability</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Move Action</td>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">Attack of Opportunity</a><sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td>Move</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Control a <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Frightened">frightened</a> mount</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Direct or redirect an active spell</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Draw a weapon<sup style="font-size:10px">3</sup></td>
			<td>No</td>
		</tr>
		<tr>
			<td>Load a hand crossbow or light crossbow</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Open or close a door</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Mount/dismount a steed</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Move a heavy object</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Pick up an item</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Sheathe a weapon</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Stand up from <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Prone">prone</a></td>
			<td>Yes</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Ready">Ready</a> or drop a shield<sup style="font-size:10px">3</sup></td>
			<td>No</td>
		</tr>
		<tr>
			<td>Retrieve a stored item</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Full-Round Action</td>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">Attack of Opportunity</a><sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td>Full attack</td>
			<td>No</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Charge">Charge</a><sup style="font-size:10px">4</sup></td>
			<td>No</td>
		</tr>
		<tr>
			<td>Deliver <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#coup-de-grace">coup de grace</a></td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Escape from a <a target="_blank" href="http://www.d20pfsrd.com/equipment---final/weapons/weapon-descriptions/net">net</a></td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Extinguish flames</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Light a torch</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Load a heavy or repeating crossbow</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Lock or unlock weapon in locked <a target="_blank" href="http://www.d20pfsrd.com/equipment---final/weapons/weapon-descriptions/gauntlet">gauntlet</a></td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Prepare to throw <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Throw-Splash-Weapon">splash weapon</a></td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Run</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Use skill that takes 1 round</td>
			<td>Usually</td>
		</tr>
		<tr>
			<td>Use a touch spell on up to six friends</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Withdraw<sup style="font-size:10px">4</sup></td>
			<td>No</td>
		</tr>
		<tr>
			<td>Free Action</td>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">Attack of Opportunity</a><sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td>Cease <a target="_blank" href="http://www.d20pfsrd.com/magic#TOC-Concentration">concentration</a> on a spell</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Drop an item</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Drop to the floor</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Prepare spell <a target="_blank" href="http://www.d20pfsrd.com/magic#TOC-Components">components</a> to cast a spell<sup style="font-size:10px">5</sup></td>
			<td>No</td>
		</tr>
		<tr>
			<td>Speak</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Swift Action</td>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">Attack of Opportunity</a><sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td>Cast a <a target="_blank" href="http://www.d20pfsrd.com/feats/metamagic-feats/quicken-spell-metamagic---final">quickened</a> spell</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Immediate Action</td>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">Attack of Opportunity</a><sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td>Cast <a target="_blank" href="http://www.d20pfsrd.com/magic/all-spells/f/feather-fall" style="font-style:italic">feather fall</a></td>
			<td>No</td>
		</tr>
		<tr>
			<td>No Action</td>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">Attack of Opportunity</a><sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Delay">Delay</a></td>
			<td>No</td>
		</tr>
		<tr>
			<td>5-foot step</td>
			<td>No</td>
		</tr>
		<tr>
			<td>Action Type Varies</td>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">Attack of Opportunity</a><sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/skills/perform">Perform</a> a <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Combat-Maneuvers">combat maneuver</a><sup style="font-size:10px">6</sup></td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Use feat<sup style="font-size:10px">7</sup></td>
			<td>Varies</td>
		</tr>
		<tr>
			<td colspan="2" style="font-size:12px"><sup style="font-size:10px">1</sup> Regardless of the action, if you move out of a <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Threatened-Squares">threatened</a> square, you usually provoke an <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">attack of opportunity</a>. This column indicates whether the action itself, not moving, provokes an <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">attack of opportunity</a>.</td>
		</tr>
		<tr>
			<td colspan="2" style="font-size:12px"><sup style="font-size:10px">2</sup> If you aid someone performing an action that would normally provoke an <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">attack of opportunity</a>, then the act of aiding another provokes an <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">attack of opportunity</a> as well.</td>
		</tr>
		<tr>
			<td colspan="2" style="font-size:12px"><sup style="font-size:10px">3</sup> If you have a <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attack-Bonus">base attack bonus</a> of +1 or higher, you can combine one of these actions with a regular move. If you have the <a target="_blank" href="http://www.d20pfsrd.com/feats/combat-feats/two-weapon-fighting-combat---final">Two-Weapon Fighting</a> feat, you can draw two light or one-handed weapons in the time it would normally take you to draw one.</td>
		</tr>
		<tr>
			<td colspan="2" style="font-size:12px"><sup style="font-size:10px">4</sup> May be taken as a <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Standard-Actions">standard action</a> if you are limited to taking only a single action in a round.</td>
		</tr>
		<tr>
			<td colspan="2" style="font-size:12px"><sup style="font-size:10px">5</sup> Unless the component is an extremely large or awkward item.</td>
		</tr>
		<tr>
			<td colspan="2" style="font-size:12px"><sup style="font-size:10px">6</sup> Some <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Combat-Maneuvers">combat maneuvers</a> substitute for a melee attack, not an action. As melee attacks, they can be used once in an attack or <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Charge">charge</a> action, one or more times in a full-attack action, or even as an <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">attack of opportunity</a>. Others are used as a separate action.</td>
		</tr>
		<tr>
			<td colspan="2" style="font-size:12px"><sup style="font-size:10px">7</sup> The description of a feat defines its effect.</td>
		</tr>
	</tbody>
	</table>

	<h3 style="font-size:14px"><a name="Attack-Roll-Modifiers"></a>Attack Roll Modifiers</h3>
	<table border="0" cellpadding="3" style="border-collapse:collapse;width:100%;margin:2px">
	<tbody>
		<tr>
			<td>Attacker is:</td><td>Melee</td><td>Ranged</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Dazzled">Dazzled</a></td><td>–1</td><td>–1</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Entangled">Entangled</a> or <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Grappled">grappled</a></td><td>–2<sup style="font-size:10px">1</sup></td><td>–2<sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Flanking">Flanking</a> defender</td><td>+2</td><td>—</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Invisible">Invisible</a></td><td>+2<sup style="font-size:10px">2</sup></td><td>+2<sup style="font-size:10px">2</sup></td>
		</tr>
		<tr>
			<td>On higher ground</td><td>+1</td><td>+0</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Prone">Prone</a></td><td>–4</td><td>—<sup style="font-size:10px">3</sup></td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Shaken">Shaken</a> or <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Frightened">frightened</a></td><td>–2</td><td>–2</td>
		</tr>
		<tr>
			<td>Squeezing through a space</td><td>–4</td><td>–4</td>
		</tr>
		<tr>
			<td colspan="3" style="font-size:12px"><sup style="font-size:10px">1</sup> Character also takes a –4 penalty to <a target="_blank" href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dexterity</a>, which may affect his <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attack-Roll">attack roll</a>.</td>
		</tr>
		<tr>
			<td colspan="3" style="font-size:12px"><sup style="font-size:10px">2</sup> The defender loses any <a target="_blank" href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dexterity</a> bonus to AC.</td>
		</tr>
		<tr>
			<td colspan="3" style="font-size:12px"><sup style="font-size:10px">3</sup> Most ranged weapons can't be used while the attacker is <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Prone">prone</a>, but you can use a crossbow or <a target="_blank" href="http://www.d20pfsrd.com/equipment---final/weapons/weapon-descriptions/ammunition/ammunition-thrown-shuriken">shuriken</a> while <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Prone">prone</a> at no penalty.</td>
		</tr>
	</tbody>
	</table>

	<h3 style="font-size:14px"><a name="Armor-Class-Modifiers"></a>Armor Class Modifiers</h3>
	<table border="0" cellpadding="3" style="border-collapse:collapse;width:100%;margin:2px">
	<tbody>
		<tr>
			<td>Defender is:</td><td>Melee</td><td>Ranged</td>
		</tr>
		<tr>
			<td>Behind <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Cover">cover</a></td><td>+4</td><td>+4</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Blinded">Blinded</a></td><td>–2<sup style="font-size:10px">1</sup></td><td>–2<sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td>Concealed or <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Invisible">invisible</a></td>
			<td colspan="2" >See <a target="_blank" href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Concealment">Concealment</a></td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Cowering">Cowering</a></td><td>–2<sup style="font-size:10px">1</sup></td><td>–2<sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Entangled">Entangled</a></td><td>+0<sup style="font-size:10px">2</sup></td><td>+0<sup style="font-size:10px">2</sup></td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Flat-Footed">Flat-footed</a></td><td>+0<sup style="font-size:10px">1</sup></td><td>+0<sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Grappled">Grappled</a> (but attacker is not)</td><td>+0<sup style="font-size:10px">2</sup></td><td>+0<sup style="font-size:10px">2</sup></td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Helpless">Helpless</a></td><td>–4<sup style="font-size:10px">1</sup></td><td>+0<sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td>Kneeling or sitting</td><td>–2</td><td>+2</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Pinned">Pinned</a></td><td>–4<sup style="font-size:10px">1</sup></td><td>+0<sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Prone">Prone</a></td><td>–4</td><td>+4</td>
		</tr>
		<tr>
			<td>Squeezing through a space</td><td>–4</td><td>–4</td>
		</tr>
		<tr>
			<td><a target="_blank" href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Stunned">Stunned</a></td><td>–2<sup style="font-size:10px">1</sup></td><td>–2<sup style="font-size:10px">1</sup></td>
		</tr>
		<tr>
			<td colspan="3" style="font-size:12px">1 The defender loses any <a target="_blank" href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dexterity</a> bonus to AC.</td>
		</tr>
		<tr>
			<td colspan="3" style="font-size:12px">2 An entangled or grappled character takes a –4 penalty to <a target="_blank" href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dexterity</a>.</td>
		</tr>
	</tbody>
	</table>

	<h3 style="font-size:14px"><a name="TOC-Size-Bonuses-and-Penalties"></a>Size Bonuses and Penalties</h3>
	<table border="0" cellpadding="3" style="border-collapse:collapse;width:100%;margin:2px">
	<tbody>
		<tr>
			<td>Size</td><td>AC/Attack</td><td>CMB/CMD</td><td><a href="http://www.d20pfsrd.com/skills/fly">Fly</a> Skill</td><td><a href="http://www.d20pfsrd.com/skills/stealth">Stealth</a> Skill</td>
		</tr>
		<tr>
			<td>Fine</td><td>+8</td><td>–8</td><td>+8</td><td>+16</td>
		</tr>
		<tr>
			<td>Diminutive</td><td>+4</td><td>–4</td><td>+6</td><td>+12</td>
		</tr>
		<tr>
			<td>Tiny</td><td>+2</td><td>–2</td><td>+4</td><td>+8</td>
		</tr>
		<tr>
			<td>Small</td><td>+1</td><td>–1</td><td>+2</td><td>+4</td>
		</tr>
		<tr>
			<td>Medium</td><td>+0</td><td>+0</td><td>+0</td><td>+0</td>
		</tr>
		<tr>
			<td>Large</td><td>–1</td><td>+1</td><td>–2</td><td>–4</td>
		</tr>
		<tr>
			<td>Huge</td><td>–2</td><td>+2</td><td>–4</td><td>–8</td>
		</tr>
		<tr>
			<td>Gargantuan</td><td>–4</td><td>+4</td><td>–6</td><td>–12</td>
		</tr>
		<tr>
			<td>Colossal</td><td>–8</td><td>+8</td><td>–8</td><td>–16</td>
		</tr>
	</tbody>
	</table>

	<hr/>

	<h2 style="font-size:18px" id="Conditions"></a>Conditions</h2>
    <table border="0" cellpadding="3" style="border-collapse:collapse;width:100%;margin:2px">
	<tbody>
		<tr>
			<td>Condition</td>
			<td>Description</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Blinded">Blinded</a></td>
			<td>Creature takes a -2 penalty to AC, loses <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dex</a> bonus to AC, and takes a -4 penalty on most <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Strength-Str-">Str</a>- and <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dex</a>-based skill checks and on opposed <a href="http://www.d20pfsrd.com/skills/perception">Perception</a> skill checks. All opponents are considered to have total <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Concealment">concealment</a> (50% miss chance) against the <a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Blinded">blinded</a> character. Creatures must make a DC 10 <a href="http://www.d20pfsrd.com/skills/acrobatics">Acrobatics</a> skill check to move faster than half speed or fall <a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Prone">prone</a>.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Broken">Broken</a></td>
			<td>Weapons suffer a -2 penalty on attack and damage rolls and only score a <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Critical-Hits">critical hit</a> on a natural 20 and only deal X2 damage. Armor and shields grant half AC bonus and double armor check penalty. Broken wands or staves use twice as many chages.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Confused">Confused</a></td>
			<td>01-25: Act normally, 26-50: Babble for one round, 51-75: Deal 1d8 + <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Strength-Str-">Str</a> damage to self, 76-100: Attack nearest creature.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Dazed">Dazed</a></td>
			<td>Can take no actions (no penalties to AC)</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Dazzled">Dazzled</a></td>
			<td>-1 to attack and sight-based checks</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Deafened">Deafened</a></td>
			<td>–4 penalty on <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Initiative">initiative</a>, opposed <a href="http://www.d20pfsrd.com/skills/perception">Perception</a> checks (automatically fails checks based on sound), and 20% chance of spell failure (verbal)</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Disabled">Disabled</a></td>
			<td>Typically at or below 0 hp. Take only standard <b>or</b> <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Move-Actions">move action</a>. Standard action causes 1 pt of damage (typically causes <a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Dying">dying</a> condition)</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Entangled">Entangled</a></td>
			<td>No movement if bonds are anchored, otherwise move at half speed. Creature takes a -2 penalty on all <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attack-Roll">attack rolls</a> and a -4 penalty to <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dex</a>. Must make <a href="http://www.d20pfsrd.com/magic#TOC-Concentration">concentration</a> check to cast spells.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Exhausted">Exhausted</a></td>
			<td>Creature moves at half speed. -6 penalty to <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Strength-Str-">Str</a> and <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dex</a>. Rest 1 hour to become <a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Fatigued">fatigued</a>.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Fascinated">Fascinated</a></td>
			<td>Takes no actions. -4 to checks made as reactions. Potential threats allow new save, obvious threats break effect.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Fatigued">Fatigued</a></td>
			<td>Creature cannot run or <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Charge">charge</a>. -2 penalty to <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Strength-Str-">Str</a> and <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dex</a>. Rest 8 hours to remove.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Flat-Footed">Flat-Footed</a></td>
			<td>Loses <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dex</a> bonus to AC and <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Combat-Maneuver-Defense">CMD</a>.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Frightened">Frightened</a></td>
			<td>As <a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Shaken">shaken</a>, except creature must flee from source.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Grappled">Grappled</a></td>
			<td>Creature cannot move or take action that requires 2 hands. -4 penalty to <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dex</a>. -2 penalty to attacks and <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Combat-Maneuvers">combat maneuvers</a> (except checks made to maintain or escape). Must make <a href="http://www.d20pfsrd.com/magic#TOC-Concentration">concentration</a> check to cast spells. Cannot take <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attacks-of-Opportunity">attacks of opportunity</a>.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Helpless">Helpless</a></td>
			<td>Typically <a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Paralyzed">paralyzed</a>, held, bound, <a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Pinned">pinned</a>, sleeping, <a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Unconscious">unconscious</a>, etc. Effective <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dex</a> = 0, melee attacks get +4. Allows <a href="http://www.d20pfsrd.com/gamemastering/combat#coup-de-grace">coup de grace</a>.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Nauseated">Nauseated</a></td>
			<td>Creature can only take a <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Move-Actions">move action</a> and cannot attack, cast spells, or concentrate.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Panicked">Panicked</a></td>
			<td>As Frightened, except creature drops held items.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Paralyzed">Paralyzed</a></td>
			<td>Creature's <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Strength-Str-">Str</a> and <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dex</a> reduced to 0. Fliers using wings fall. Creature is <a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Helpless">helpless</a>.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Pinned">Pinned</a></td>
			<td>As <a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Grappled">grappled</a>, except creature is <a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Flat-Footed">flat-footed</a>, takes a -4 penalty to AC, and can only take verbal or mental actions (except checks made to escape).</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Prone">Prone</a></td>
			<td>On ground. -4 to melee attacks (can't use ranged except crossbows). -4 to melee AC, +4 to ranged AC. Move + AoO to stand.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Shaken">Shaken</a></td>
			<td>Creature takes a -2 penalty on <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Attack-Roll">attack rolls</a>, saving throws, skill checks, and ability checks.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Sickened">Sickened</a></td>
			<td>Creature takes a -2 penalty on all attack rolls, weapon damage rolls, saving throws, skill checks, and ability checks.</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Staggered">Staggered</a></td>
			<td>Creature can only take a <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Move-Actions">move action</a> or <a href="http://www.d20pfsrd.com/gamemastering/combat#TOC-Standard-Actions">standard action</a> (plus swift and immediate).</td>
		</tr>
		<tr>
			<td><a href="http://www.d20pfsrd.com/gamemastering/conditions#TOC-Stunned">Stunned</a></td>
			<td>Creature cannot take actions, drops everything held, takes a -2 penalty to AC, and loses its <a href="http://www.d20pfsrd.com/basics-ability-scores/ability-scores#TOC-Dexterity-Dex-">Dex</a> bonus to AC (if any).</td>
		</tr>
	</tbody>
</table>
	<?php
}
add_shortcode('pft_quick_reference', 'render_pft_quick_reference_page');
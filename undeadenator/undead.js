var Monsters;
var MonsterListOptions;
var xmlDoc;
var xmlObj;
var doneLoad = false;
var IE = false;

var Name
var CR
var XP
var Race
var Class
var Alignment
var Size
var Type
var SubType
var Init
var Senses
var Aura
var AC
var AC_Mods
var HP
var HD
var HP_Mods
var Saves
var Fort
var Ref
var Will
var Save_Mods
var DefensiveAbilities
var DR
var Immune
var Resist
var SR
var Weaknesses
var Speed
var Speed_Mod
var Melee
var Ranged
var Space
var Reach
var SpecialAttacks
var SpellLikeAbilities
var SpellsKnown
var SpellsPrepared
var SpellDomains
var AbilitiyScores
var AbilitiyScore_Mods
var BaseAtk
var CMB
var CMD
var Feats
var Skills
var RacialMods
var Languages
var SQ
var Environment
var Organization
var Treasure
var Group
var Source
var IsTemplate
var SpecialAbilities
var Gender
var Bloodline
var ProhibitedSchools
var BeforeCombat
var DuringCombat
var Morale
var Gear
var OtherGear
var Vulnerability
var Note
var CharacterFlag
var CompanionFlag
var Fly
var Climb
var Burrow
var Swim
var Land
var TemplatesApplied                  
var Str
var Dex
var Con
var Int
var Wis
var Cha
var Advancement
var HDAdv
var AC_DexAdv
var AC_NatAdv
var AC_SizeAdv
var DCAdv    
var SkillAdv 
var HitDice

var StrSkills = [ 'Climb', 'Swim' ];            
var DexSkills = [ 'Acrobatics', 'Disable Device', 'Escape Artist', 'Ride', 'Sleight of Hand', 'Stealth', 'Fly' ];
var IntSkills = [ 'Appraise', 'Craft', 'Knowledge', 'Linguistics', 'Spellcraft' ];  
var WisSkills = [ 'Heal', 'Perception', 'Profession', 'Sense Motive', 'Survival' ];
var ChaSkills = [ 'Bluff', 'Diplomacy', 'Disguise', 'Handle Animal', 'Intimidate', 'Perform', 'Use Magic Device' ];

var whichPanel=0
var manualLoad=false;

// IE stuff
function verify()
{
  // 0 Object is not initialized
  // 1 Loading object is loading data
  // 2 Loaded object has loaded data
  // 3 Data from object can be worked with
  // 4 Object completely initialized
  if (xmlDoc.readyState != 4)
  {
      return false;
  }
  MonsterList();
}
    
function importXML( type )
{
    xmlfile = "/toolbox/wp-content/plugins/pathfinder-tools/undeadenator/monsters.xml";
    var xmlloaded = false;
    try
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", xmlfile, false);
    }
    catch (Exception)
    {
        xmlDoc = document.implementation.createDocument("", "", null);
        xmlDoc.onload = MonsterList;
        xmlDoc.load(xmlfile);
        xmlloaded = true;
    }


    if (!xmlloaded)
    {
        xmlhttp.setRequestHeader('Content-Type', 'text/xml')
        xmlhttp.send("");
        xmlDoc = xmlhttp.responseXML;
        MonsterList();
        xmlloaded = true;
    }
}

function getText( node )
{
    return node.textContent;
}

function MonsterList ()
{
    var m = 1;
    var it = "";
    var names = new Array();
    var namesi = new Array();

    undeadenator_form = document.getElementById('undeadenator_form');
    
    Monsters = xmlDoc.getElementsByTagName("Monster");
    // find all the monster names
    for (i=0;i<Monsters.length;i++)
    {
        for (j=0;j<Monsters[i].childNodes.length;j++)
        {
            if (Monsters[i].childNodes[j].nodeType == 1) 
                if (Monsters[i].childNodes[j].nodeName == "Name")
                {
                    name = getText(Monsters[i].childNodes[j]);
                    undeadenator_form.MonsterChooser.options[m] = new Option(name, i);
                    names[m]=name;
                    namesi[m]=i;
                    m += 1;
                    break;
                }
        }
    }
    undeadenator_form.MonsterChooser.options[0] = new Option("Human", 975);
    undeadenator_form.MonsterChooser.selectedIndex = 0;
    whichPanel = 0;
    
    // add source on duplicate monster names
    warning=" ";
    for (m=1;m<names.length-1; m++)
    {
        if (names[m] == names[m+1])
        {
            i = namesi[m];
            i2 = namesi[m+1];
            for (j=0;j<Monsters[m].childNodes.length;j++)
            {
                if (Monsters[m].childNodes[j].nodeType == 1) 
                {
                    if (Monsters[m].childNodes[j].nodeName == "Source")
                    {
                        name = names[m] + "   (" + getText(Monsters[i].childNodes[j]) + ")";
                        undeadenator_form.MonsterChooser.options[m] = new Option(name, i);
                        name2 = names[m+1] + "   (" + getText(Monsters[i2].childNodes[j]) + ")";
                        undeadenator_form.MonsterChooser.options[m+1] = new Option(name2, i2);
                        // comment out next line to disable warnings of duplicate name/source
                        //if (name == name2) warning += "<br>"+name;
                        break;
                    }
                }
            }
        }
    }

    status(warning);

}

function trimAll(sString)
{
    while (sString.substring(0,1) == ' ')
    {
        sString = sString.substring(1, sString.length);
    }
    while (sString.substring(sString.length-1, sString.length) == ' ')
    {
        sString = sString.substring(0,sString.length-1);
    }
    return sString;
} 

function doIt()
{ 
    undeadenator_form = document.getElementById('undeadenator_form');
    var id = undeadenator_form.MonsterChooser.value;
    if ( id < 0 ) return;
  
    status(" Working... ");
    var newdiv;
    var twidth;
    if ( !undeadenator_form.ShowMultiple.checked ) {
        whichPanel = 0;
        olddiv = document.getElementById('monsterDiv');
        document.getElementById('writeroot').removeChild(olddiv);
        newdiv = document.createElement('div');
        newdiv.setAttribute('id','monsterDiv');
        newdiv.innerHTML="";
        twidth="100%";
    } else {
        whichPanel = 0;
        newdiv = document.getElementById('monsterDiv');
        twidth = "100%";
    }
  
    var s="";

    for (j=0; j<Monsters[0].childNodes.length; j++) {
        switch (Monsters[0].childNodes[j].nodeName) {
            case "Name":  Name=getText(Monsters[id].childNodes[j]); break;
            case "CR":  CR=getText(Monsters[id].childNodes[j]); break;
            case "XP":  XP=getText(Monsters[id].childNodes[j]); break;
            case "Race":  Race=getText(Monsters[id].childNodes[j]); break;
            case "Class":  Class=getText(Monsters[id].childNodes[j]); break;
            case "Alignment":  Alignment=getText(Monsters[id].childNodes[j]); break;
            case "Size":  Size=getText(Monsters[id].childNodes[j]); break;
            case "Type":  Type=getText(Monsters[id].childNodes[j]); break;
            case "SubType":  SubType=getText(Monsters[id].childNodes[j]); break;
            case "Init":  Init=getText(Monsters[id].childNodes[j]); break;
            case "Senses":  Senses=getText(Monsters[id].childNodes[j]); break;
            case "Aura":  Aura=getText(Monsters[id].childNodes[j]); break;
            case "AC":  AC=getText(Monsters[id].childNodes[j]); break;
            case "AC_Mods":  AC_Mods=getText(Monsters[id].childNodes[j]); break;
            case "HP":  HP=getText(Monsters[id].childNodes[j]); break;
            case "HD":  HD=getText(Monsters[id].childNodes[j]); break;
            case "HP_Mods":  HP_Mods=getText(Monsters[id].childNodes[j]); break;
            case "Saves":  Saves=getText(Monsters[id].childNodes[j]); break;
            case "Fort":  Fort=getText(Monsters[id].childNodes[j]); break;
            case "Ref":  Ref=getText(Monsters[id].childNodes[j]); break;
            case "Will":  Will=getText(Monsters[id].childNodes[j]); break;
            case "Save_Mods":  Save_Mods=getText(Monsters[id].childNodes[j]); break;
            case "DefensiveAbilities":  DefensiveAbilities=getText(Monsters[id].childNodes[j]); break;
            case "DR":  DR=getText(Monsters[id].childNodes[j]); break;
            case "Immune":  Immune=getText(Monsters[id].childNodes[j]); break;
            case "Resist":  Resist=getText(Monsters[id].childNodes[j]); break;
            case "SR":  SR=getText(Monsters[id].childNodes[j]); break;
            case "Weaknesses":  Weaknesses=getText(Monsters[id].childNodes[j]); break;
            case "Speed":  Speed=getText(Monsters[id].childNodes[j]); break;
            case "Speed_Mod":  Speed_Mod=getText(Monsters[id].childNodes[j]); break;
            case "Melee":  Melee=getText(Monsters[id].childNodes[j]); break;
            case "Ranged":  Ranged=getText(Monsters[id].childNodes[j]); break;
            case "Space":  Space=getText(Monsters[id].childNodes[j]); break;
            case "Reach":  Reach=getText(Monsters[id].childNodes[j]); break;
            case "SpecialAttacks":  SpecialAttacks=getText(Monsters[id].childNodes[j]); break;
            case "SpellLikeAbilities":  SpellLikeAbilities=getText(Monsters[id].childNodes[j]); break;
            case "SpellsKnown":  SpellsKnown=getText(Monsters[id].childNodes[j]); break;
            case "SpellsPrepared":  SpellsPrepared=getText(Monsters[id].childNodes[j]); break;
            case "SpellDomains":  SpellDomains=getText(Monsters[id].childNodes[j]); break;
            case "AbilitiyScores":  AbilitiyScores=getText(Monsters[id].childNodes[j]); break;
            case "AbilitiyScore_Mods":  AbilitiyScore_Mods=getText(Monsters[id].childNodes[j]); break;
            case "BaseAtk":  BaseAtk=getText(Monsters[id].childNodes[j]); break;
            case "CMB":  CMB=getText(Monsters[id].childNodes[j]); break;
            case "CMD":  CMD=getText(Monsters[id].childNodes[j]); break;
            case "Feats":  Feats=getText(Monsters[id].childNodes[j]); break;
            case "Skills":  Skills=getText(Monsters[id].childNodes[j]); break;
            case "RacialMods":  RacialMods=getText(Monsters[id].childNodes[j]); break;
            case "Languages":  Languages=getText(Monsters[id].childNodes[j]); break;
            case "SQ":  SQ=getText(Monsters[id].childNodes[j]); break;
            case "Environment":  Environment=getText(Monsters[id].childNodes[j]); break;
            case "Organization":  Organization=getText(Monsters[id].childNodes[j]); break;
            case "Treasure":  Treasure=getText(Monsters[id].childNodes[j]); break;
            case "Group":  Group=getText(Monsters[id].childNodes[j]); break;
            case "Source":  Source=getText(Monsters[id].childNodes[j]); break;
            case "IsTemplate":  IsTemplate=getText(Monsters[id].childNodes[j]); break;
            case "SpecialAbilities":  SpecialAbilities=getText(Monsters[id].childNodes[j]); break;
            case "Gender":  Gender=getText(Monsters[id].childNodes[j]); break;
            case "Bloodline":  Bloodline=getText(Monsters[id].childNodes[j]); break;
            case "ProhibitedSchools":  ProhibitedSchools=getText(Monsters[id].childNodes[j]); break;
            case "BeforeCombat":  BeforeCombat=getText(Monsters[id].childNodes[j]); break;
            case "DuringCombat":  DuringCombat=getText(Monsters[id].childNodes[j]); break;
            case "Morale":  Morale=getText(Monsters[id].childNodes[j]); break;
            case "Gear":  Gear=getText(Monsters[id].childNodes[j]); break;
            case "OtherGear":  OtherGear=getText(Monsters[id].childNodes[j]); break;
            case "Vulnerability":  Vulnerability=getText(Monsters[id].childNodes[j]); break;
            case "Note":  Note=getText(Monsters[id].childNodes[j]); break;
            case "CharacterFlag":  CharacterFlag=getText(Monsters[id].childNodes[j]); break;
            case "CompanionFlag":  CompanionFlag=getText(Monsters[id].childNodes[j]); break;
            case "Fly":  Fly=getText(Monsters[id].childNodes[j]); break;
            case "Climb":  Climb=getText(Monsters[id].childNodes[j]); break;
            case "Burrow":  Burrow=getText(Monsters[id].childNodes[j]); break;
            case "Swim":  Swim=getText(Monsters[id].childNodes[j]); break;
            case "Land":  Land=getText(Monsters[id].childNodes[j]); break;
            case "TemplatesApplied":  TemplatesApplied=getText(Monsters[id].childNodes[j]); break;
        }
    }
    AC_DexAdv=0;
    AC_NatAdv=0;
    AC_SizeAdv=0;
    HDAdv     =0;
    DCAdv     =0;
    SkillAdv  =0;
    HitDice   =0;
  
    changeHitDice( 0 ); // get the HitDice variable filled in
  
    if ( Save_Mods == "NULL" ) Save_Mods="";
    if ( AbilitiyScores == "" ) AbilitiyScores="Str 0, Dex 0, Con 0, Int 0, Wis 0, Cha 0"
    scores = AbilitiyScores.split(" ");
    Str = scores[1].replace(",","");
    Dex = scores[3].replace(",","");
    Con = scores[5].replace(",","");
    Int = scores[7].replace(",","");
    Wis = scores[9].replace(",","");
    Cha = scores[11].replace(",","");
    if ( AC != "" )   {
        ACComponents=AC.split(",")
        ACBase=ACComponents[0];
        ACTouch=trimAll(ACComponents[1]).split(" ")[1];
        ACFlatFooted=trimAll(ACComponents[2]).split(" ")[1];
    } else {
        ACBase=0;
        ACTouch=0;
        ACFlatFooted=0;
    } 
  
    // do the advancements
    Advancement="";
    OriginalCR = CR;
    RacialHitDice = safeParseInt(undeadenator_form.RacialHitDice.value);
    if ( RacialHitDice != 0 ) racialHitDice( RacialHitDice ); 
    if ( undeadenator_form.Skeleton.checked ) skeleton();
    if ( undeadenator_form.Zombie.checked ) zombie();
  
    if ( CR != OriginalCR )
        XP = getXP(CR);
    
    // do the stat block
    if ( Advancement != "" ) NewName = Name+" ( "+Advancement+") ";
    else NewName = Name;
  
    s+="<font style='color: white; background-color: black'><b>"+NewName+
    Array(80 - NewName.length).join("&nbsp;")+" CR "+CR+"</b></font><br>"
  s+="<b>XP "+XP+"</b><br>"
  if ( Race != "" || Class != "") s += Race+" "+Class+"<br>"
  s+=Alignment+" "+Size+" "+Type+" "+SubType+"<br>"
  s+="<b>Init</b> "+addplus(Init)+"; <b>Senses</b> "+Senses+"<br>"
  if ( Aura != "" ) s+="<b>Aura</b> "+Aura+"<br>"
  
  s+="<font size='-2'><hr align='left' width='70%'><b>DEFENSE</b><hr align='left' width='70%'></font>"
  if ( AC != "" ) 
    s+="<b>AC</b> "+ACBase+", <B>touch</b> "+ACTouch+", <B>flat-footed</b> "+ACFlatFooted+" ";
  AC_Mods = changeAPreValue(AC_NatAdv, "natural", AC_Mods, true);
  AC_Mods = changeAPreValue(AC_DexAdv, "Dex", AC_Mods, true);
  AC_Mods = changeAPreValue(AC_SizeAdv, "size", AC_Mods, true);
  s+=AC_Mods
  s+="<br>"
  addHpToHD(HDAdv);
  s+="<b>hp</b> "+HP+" "+HD
  s+=" "+HP_Mods+"<br>"
  s+="<b>Fort</b> "+addplus(Fort)+", <b>Ref</b> "+addplus(Ref)+", <b>Will</b> "+addplus(Will)+"; "+Save_Mods+"<br>"
  if ( DefensiveAbilities != "" ) s+="<b>Defensive Abilities</b> "+DefensiveAbilities+"; "
  if ( DR != "" ) s+="<b>DR</b> "+DR+"; "
  if ( Immune != "" ) s+="<b>Immune</b> "+Immune+"; "
  if ( Resist != "" ) s+="<b>Resist</b> "+Resist+"; "
  if ( SR != "" ) s+="<b>SR</b> "+SR+";"
  if (( SR != "" ) || ( DefensiveAbilities != "" ) || ( Immune != "" ) || ( DR != "" )) s+="<br>";
  
   if ( Weaknesses != "" ) s+="<b>Weaknesses</b> "+Weaknesses+"<br>"
 
  s+="<font size='-2'><hr align='left' width='70%'><b>OFFENSE</b><hr align='left' width='70%'></font>"
  s+="<b>Speed</b> "+Speed+" "+Speed_Mod+"<br>"
  if ( Melee != "" ) 
  {
    s+="<b>Melee</b> "+Melee+"<br>";
  }
  if ( Ranged != "" ) 
  {
    s+="<b>Ranged</b> "+Ranged+"<br>";
  }
  s+="<b>Space</b> "+Space+"<b>Reach</b> "+Reach+"<br>"
  if ( SpecialAttacks != "" ) s+="<b>Special Attacks</b> "+SpecialAttacks+"<br>"
  if ( SpellLikeAbilities != "" ) s+="<b>Spell-Like Abilities</b> "+SpellLikeAbilities.substr(21)+"<br>"
  
  s+="<font size='-2'><hr align='left' width='70%'><b>STATISTICS</b><hr align='left' width='70%'></font>"
  s+="<b>Str</b> "+Str+", <b>Dex</b> "+Dex+", <b>Con</b> "+Con
  s+=", <b>Int</b> "+Int+", <b>Wis</b> "+Wis+", <b>Cha</b> "+Cha+"; "+AbilitiyScore_Mods+"<br>"
  s+="<b>Base Atk</b> "+BaseAtk+"; <b>CMB</b> "+CMB+"; <b>CMD</b> "+CMD+"<br>"
  if ( Feats != "" ) s+="<b>Feats</b> "+Feats+"<br>"
  if ( Skills != "" ) 
  {
        s+="<b>Skills</b> "+Skills
        if ( RacialMods != "" )
            s+="; <b>Racial Modifiers</b> "+RacialMods
        s+="<br>"
  }
  if ( Languages != "" ) s+="<b>Languages</b> "+Languages+"<br>"
  if ( SQ != "" ) s+="<b>SQ</b> "+SQ+"<br>"
  
  if ( Environment != "" )
  {
    s+="<font size='-2'><hr align='left' width='70%'><b>ECOLOGY</b><hr align='left' width='70%'></font>"
    s+="<b>Environment</b> "+Environment+"<br>"
    s+="<b>Organization</b> "+Organization+"<br>"
    s+="<b>Treasure</b> "+Treasure+"<br>"
  }
  
  if ( SpecialAbilities != "" )
  {
    s+="<font size='-2'><hr align='left' width='70%'><b>SPECIAL ABILITIES</b><hr align='left' width='70%'></font>"
    var regexp = new RegExp(/\.\s([\w\s]*\((Ex|Su|Sp)\))/g);
    var SpecialAbilitiesBR = SpecialAbilities.replace(regexp,".<br/><br/>$1");
    s+=SpecialAbilitiesBR+"<br>";
  }

  if ( Source != "" )
  {
    s+="<font size='-2'>Source: "+Source+"</font><br>"
  }
  
  rowstr="";
  if (IE)
  {
    if ( newdiv.innerHTML == "&nbsp;" ) 
    {
        newdiv.innerHTML = '<tr><td></td></tr>'
    }
    if ( whichPanel == 0 ) 
    {
        newdiv.innerHTML = "<tr><td width='"+twidth+"'><hr>"+s+"</td></tr>" + newdiv.innerHTML; 
    }
    else
    {
        if ( newdiv.innerHTML.substr( 0,4 ) == "<tr>" )
            oldinner = newdiv.innerHTML.substr( 4, newdiv.innerHTML.length );
        else
            oldinner = newdiv.innerHTML;
        newdiv.innerHTML = "<tr><td width='"+twidth+"'><hr>"+s+"</td><td width='2%'> </td>"+oldinner; 
    }
  } 
  else 
    {
        if ( newdiv.innerHTML == "&nbsp;" ) 
    {
        newdiv.innerHTML = '<table><tbody><tr valign="top"></tr></tbody></table>'
    }
    if ( whichPanel == 0 ) 
    {
        newdiv.innerHTML = "<table><tbody><tr valign=\"top\"><td width='"+twidth+"'><hr>"+s+"</td></tr><tr valign=\"top\">" + newdiv.innerHTML.substr(31,newdiv.innerHTML.length); 
    }
    else
    {
        if ( newdiv.innerHTML.substr( 0,31 ) == "<table><tbody><tr valign=\"top\">" )
            oldinner = newdiv.innerHTML.substr( 31, newdiv.innerHTML.length );
        else
            oldinner = newdiv.innerHTML;
        newdiv.innerHTML = "<table><tbody><tr valign=\"top\"><td width='"+twidth+"'><hr>"+s+"</td><td width='2%'> </td>"+oldinner; 
    }
  }
  document.getElementById('writeroot').appendChild(newdiv);
  if ( document.form.ShowMultiple.checked )
  {
    whichPanel = (whichPanel + 1) % 2;
  } 
  
  status(" ");

}

function addplus( str )
{
    trimed = trimAll(str+"");
    if (( trimed.substr(0,1) != "+" ) && ( trimed.substr(0,1) != "-" ))
        return "+"+trimed;
    return str;
}

function clearform()
{
    undeadenator_form = document.getElementById('undeadenator_form');
    undeadenator_form.RacialHitDice.value=0;
    undeadenator_form.Skeleton.checked=false;  
    undeadenator_form.Zombie.checked=false; 
    whichPanel=0;
    div = document.getElementById('monsterDiv');
    div.innerHTML="&nbsp;";
}

function status( str )
{
    if ( document.getElementById('Status') != null )
        document.getElementById('Status').innerHTML = "<i>"+str+"</i>";
}

function getHDType()
{
  var hdType = 0;
  if ( HD != "" ) 
  {
    start = HD.search( "[d]" );
    end = HD.search( "[+)]" );
    if ( (end > start) && (start >= 0) )
    {
        hdType = safeParseInt(HD.substring(start+1,end));
        if ( hdType < 1 ) hdType = 1;
        if ( isNaN(hdType) ) hdType = 0;
    }
  }
  return hdType;
}

function isNull(anode)
{
  if (anode.toString()=='undefined'){ return true;} 
  else if (anode.toString()=='NULL'){ return true;} 
  else return false;
}

function isEmpty(str)
{
  if ( typeof(str) == 'undefined') return true;
  if (str == null) return true;
  if (str == "") return true;
  return false;
}

function changeHitDice( amount )
{
  if ( !isEmpty(HD) ) 
  {
    start = HD.search( "[(]" );
    end = HD.search( "[d]" );
    if ( (end > start) && (start >= 0) )
    {
        HitDice = safeParseInt(HD.substring(start+1,end))+amount;
        if ( HitDice < 1 ) HitDice = 1;
        if ( amount != 0 ) 
            HD = "("+HitDice+HD.substring(end);
    }
  } else HD = 0
}

function getXP( crstr )
{
    switch ( crstr )
    {
        case "1/8": return 50;
        case "1/6": return 65;
        case "1/4": return 100;
        case "1/3": return 135;
        case "1/2": return 200;
        default:
            crval = safeParseInt(crstr);
            if ( crval < .124 ) return 0;
            if ( crval < 1 ) return 400/crval;
            if ( crval < 1.5 ) return 400;
            if ( crval < 2.5 ) return 600;
            if ( crval < 3.5 ) return 800;
            if ( crval < 4.5 ) return 1200;
            if ( crval < 5.5 ) return 1600;
            if ( crval < 6.5 ) return 2400;
            if ( crval < 7.5 ) return 3200;
            if ( crval < 8.5 ) return 4800;
            if ( crval < 9.5 ) return 6400;
            if ( crval < 10.5 ) return 9600;
            if ( crval < 11.5 ) return 12800;
            if ( crval < 12.5 ) return 19200;
            if ( crval < 13.5 ) return 25600;
            if ( crval < 14.5 ) return 38400;
            if ( crval < 15.5 ) return 51200;
            if ( crval < 16.5 ) return 76800;
            if ( crval < 17.5 ) return 102400;
            if ( crval < 18.5 ) return 153600;
            if ( crval < 19.5 ) return 204800;
            if ( crval < 20.5 ) return 307200;
            if ( crval < 21.5 ) return 409600;
            if ( crval < 22.5 ) return 615000;
            if ( crval < 23.5 ) return 820000;
            if ( crval < 24.5 ) return 1230000;
            if ( crval < 25.5 ) return 1640000;
            return 2000000;
    }
    return 0;
}

function advanced( amount )
{
    if ( Str != "" && Str > 0) Str=safeParseInt(Str)+4*amount;
    if ( Dex != "" && Dex > 0) Dex=safeParseInt(Dex)+4*amount;
    if ( Con != "" && Con > 0) Con=safeParseInt(Con)+4*amount;
    if ( Int != "" && Int > 2) Int=safeParseInt(Int)+4*amount;
    if ( Wis != "" && Wis > 0) Wis=safeParseInt(Wis)+4*amount;
    if ( Cha != "" && Cha > 0) Cha=safeParseInt(Cha)+4*amount;
    if ( Fort != "" && Fort > -90) Fort=safeParseInt(Fort)+2*amount;
    if ( Ref  != "" && Ref  > -90) Ref =safeParseInt(Ref)+2*amount;
    if ( Will != "" && Will > -90) Will=safeParseInt(Will)+2*amount;
    if ( Init != "")              
    {
        Init=safeParseInt(Init)+2*amount;
        if ( safeParseInt(Init) >= 0 ) Init = "+"+Init;
    }
    if ( AC != "" )                 
    {
        ACBase = safeParseInt(ACBase) + 4 * amount;
        ACTouch = safeParseInt(ACTouch) + 2 * amount;
        ACFlatFooted = safeParseInt(ACFlatFooted) + 2 * amount;
        AC_DexAdv += 2*amount;
        AC_NatAdv += 2*amount;
    }
    Advancement+="Advanced "
    if ( amount > 1 ) Advancement+="x"+amount+" "
    if ( HP != "" ) 
    {
        HDAdv+=2*amount*HitDice;
        HP=safeParseInt(HP)+HDAdv;
    }
    fixAttacks(2*amount, 2*amount, 0);
    fixDC(2*amount);
    fixSkills( 2*amount, 2*amount, 2*amount, 2*amount, 2*amount, 0);
    fixCR(amount);
    fixCMB( +2*amount, 0);
    fixCMD( +2*amount, +2*amount, 0);
}

function young( amount )
{
    // I'm going to just change the size and adjust using those instead of this
    //if ( Str != "" ) Str=parseInt(Str)-4*amount;
    //if ( Dex != "" ) Dex=parseInt(Dex)+4*amount;
    //if ( Con != "" ) Con=parseInt(Con)-4*amount;
    fixStatsAtksBySize( -amount );

    if ( AC != "" )                 
    {
        fixAC( -amount, 0 );
    }
    Advancement+="Young "
    if ( amount > 1 ) Advancement+="x"+amount+" "
    if ( HP != "" ) 
    {
        HDAdv -= 2*amount*HitDice;
        HP = safeParseInt(HP) + HDAdv;
    }
    fixDC(-2*amount);
    fixSkills( -2*amount, +2*amount, 0, 0, 0, -amount);
    fixCR( -amount );
    fixCMB( -2*amount, -amount);
    fixCMD( -2*amount, +2*amount, -amount);
    changeSize( -amount );
}

function giant( amount )
{
    fixStatsAtksBySize( amount );

    if ( AC != "" )                 
    {
        fixAC( amount, 0 )
    }
    Advancement+="Giant "
    if ( amount > 1 ) Advancement+="x"+amount+" "
    if ( HP != "" ) 
    {
        HDAdv+=2*amount*HitDice;
        HP=safeParseInt(HP)+HDAdv;
    }
    fixDC(2*amount);
    fixSkills( 2*amount, -1*amount, 0, 0, 0, amount);
    fixCR(amount);
    fixCMB( +2*amount, amount);
    fixCMD( +2*amount, -1*amount, amount);
    changeSize( amount );
}

function celestial( amount )
{
    Advancement+="Celestial "
    if ( amount > 1 ) Advancement+="x"+amount+" "
    if ( HitDice > 4 ) fixCR(1)
    if ( Senses.indexOf("arkvision") == -1 ) Senses = "darkvision 60 ft.; " + Senses;

    if ( SpecialAttacks != "" ) SpecialAttacks += "; ";
    SpecialAttacks += "Smite Evil 1/day <font -2>(swift action, +Cha bonus to attack, +HD bonus to damage; persists until target dead or creature rests).</font>"
    
    if ( HitDice < 5 ) res = 5;
    else if ( HitDice < 11 ) res = 10;
    else res = 15;
    addResistance("acid",res);
    addResistance("cold",res);
    addResistance("electricity",res);

    if ( HitDice > 4 ) 
    {
        if ( DR != "" ) DR += "; "
        if ( HitDice < 11 ) DR += "5/evil";
        else DR += "10/evil";
    }
    
    srval = safeParseInt(SR);
    newsr = safeParseInt(CR) + 5;
    if ( newsr > srval ) SR = newsr;
}

function fiendish( amount )
{
    Advancement+="Fiendish "
    if ( amount > 1 ) Advancement+="x"+amount+" "
    if ( HitDice > 4 ) fixCR(1)
    if ( Senses.indexOf("arkvision") == -1 ) Senses = "darkvision 60 ft.; " + Senses;
    
    if ( SpecialAttacks != "" ) SpecialAttacks += "; ";
    SpecialAttacks += "Smite Good 1/day <font -2>(swift action, +Cha bonus to attack, +HD bonus to damage; persists until target dead or creature rests).</font>"
    
    if ( HitDice < 5 ) res = 5;
    else if ( HitDice < 11 ) res = 10;
    else res = 15;
    addResistance("cold",res);
    addResistance("fire",res);

    if ( HitDice > 4 ) 
    {
        if ( DR != "" ) DR += "; "
        if ( HitDice < 11 ) DR += "5/good";
        else DR += "10/good";
    }
    
    srval = safeParseInt(SR);
    newsr = safeParseInt(CR) + 5;
    if ( newsr > srval ) SR = newsr;
}

function augmentSummoning( amount )
{
    Advancement+="AugmentSummoning "
    if ( amount > 1 ) Advancement+="x"+amount+" "
    if ( Str != "" ) Str=safeParseInt(Str)+4*amount;
    if ( Con != "" ) Con=safeParseInt(Con)+4*amount;

    if ( HP != "" ) 
    {
        HDAdv+=2*amount*HitDice;
        HP=safeParseInt(HP)+HDAdv;
    }
    if ( Fort != "" ) Fort=safeParseInt(Fort)+2*amount;
    fixCMB( 2*amount, 0 );
    fixCMD( 2*amount, 0, 0);
    fixSkills( 2*amount, 0, 0, 0, 0, 0 );
    fixAttacks( 2*amount, 0, 0)
    fixDC( 2*amount );
}
      

// Table 2-1
var HP2CR = [0,5,5,10,10,15,15,15,15,15,15,15,15,20,20,20,20,30,30,30,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,999999,999999]
var AC2CR = [0,1,2,1,2,1,1,1,1,2,1,1,2,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,999999,999999]
var BAB2CR =[0,1,2,1,2,2,1,2,1,2,1,1,1,2,1,1,1,2,1,1,1,1,1,1,1,1,1,2,1,1,1,1,2,1,1,1,1,2,1,1,1,1,2,1,1,1,1,2,1,1,1,999999,999999]
var DMG2CR =[0,2,3,2,3,4,4,4,5,4,4,5,4,5,4,4,9,8,9,8,9,9,8,9,9,9,9,10,10,10,11,11,11,11,12,12,12,12,13,13,13,13,14,999999,999999]

function adjustForCR(oldcr, newcr)
{
    var hpadj=0;
    var acadj=0;
    var babadj=0;
    var dmgadj=0;
    var hplen=HP2CR.length-1;
    var aclen=AC2CR.length-1;
    var bablen=BAB2CR.length-1;
    var dmglen=DMG2CR.length-1;
    oldcr += " ";
    newcr += " ";
    if ( oldcr.search("[./]") != -1 ) 
        oldcr = 0;
    if ( newcr.search("[./]") != -1 ) 
        newcr = 0;
    oldcr = safeParseInt(oldcr);
    newcr = safeParseInt(newcr);
    if (oldcr < newcr) {
        for (c=oldcr; c<newcr; c++) {
            if (c<hplen) hpadj += HP2CR[c]; else hpadj += HP2CR[hplen];
            if (c<aclen) acadj += AC2CR[c]; else acadj += AC2CR[aclen];
            if (c<bablen) babadj += BAB2CR[c]; else babadj += BAB2CR[bablen];
            if (c<dmglen) dmgadj += DMG2CR[c]; else dmgadj += DMG2CR[dmglen];
        }
    } else {
        for (c=oldcr-1; c>=newcr; c--) {
            if (c<hplen) hpadj -= HP2CR[c]; else hpadj -= HP2CR[hplen];
            if (c<aclen) acadj -= AC2CR[c]; else acadj -= AC2CR[aclen];
            if (c<bablen) babadj -= BAB2CR[c]; else babadj -= BAB2CR[bablen];
            if (c<dmglen) dmgadj -= DMG2CR[c]; else dmgadj -= DMG2CR[dmglen];
        }
    }
    // alert("OldCR: "+oldcr+"  NewCR: "+newcr+"  HP: "+hpadj+"  AC: "+acadj+"  BAB: "+babadj+"  Dmg: "+dmgadj);
    HP = safeParseInt(HP) + hpadj;
    AC = safeParseInt(AC) + acadj;
    ACBase = safeParseInt(ACBase) + acadj;
    ACFlatFooted = safeParseInt(ACFlatFooted) + acadj;
    AC_NatAdv = safeParseInt(AC_NatAdv) + acadj;
    BaseAtk = safeParseInt(BaseAtk) + babadj;
    CMB = safeParseInt(CMB) + babadj;
    CMD = safeParseInt(CMD) + babadj;
    dmgadj = 0; // remove this as it's supposed to be taken care of in the STR increase
    Melee = changeAttack( babadj, Melee, 0, dmgadj, true );
    Ranged = changeAttack( babadj, Ranged, 0, dmgadj, true ); // call this melee so the dmg gets added to attacks
}

function safeParseInt( val )
{
    n = parseInt(val);
    if ( isNaN(n) ) n=0;
    return n;
}

function addResistance( type, amount )
{
    if ( Resist != "" ) Resist += ", ";
    Resist += type + " " + amount;
}

function racialHitDice( amount )
{
    Advancement+=" +"+amount+"HD "
//    sizechange = Math.floor(amount/4);
    sizechange = 0;    
    fixStatsAtksBySize(sizechange);
    // for every 4 hd increase, add 1 to highest stat
    strmod=0
    dexmod=0
    conmod=0
    intmod=0
    wismod=0
    chamod=0
    if ( sizechange > 0 )
    {
        modchange = Math.floor(sizechange/2);
        maxstat =  Math.max(safeParseInt(Str),safeParseInt(Dex),safeParseInt(Con),safeParseInt(Wis),safeParseInt(Int),safeParseInt(Cha));
        if      ( safeParseInt(Str) == maxstat ) {strmod = modchange; Str = safeParseInt(Str) + sizechange;}
        else if ( safeParseInt(Dex) == maxstat ) {dexmod = modchange; Dex = safeParseInt(Dex) + sizechange;}
        else if ( safeParseInt(Con) == maxstat ) {conmod = modchange; Con = safeParseInt(Con) + sizechange;}
        else if ( safeParseInt(Int) == maxstat ) {intmod = modchange; Int = safeParseInt(Int) + sizechange;}
        else if ( safeParseInt(Wis) == maxstat ) {wismod = modchange; Wis = safeParseInt(Wis) + sizechange;}
        else if ( safeParseInt(Cha) == maxstat ) {chamod = modchange; Cha = safeParseInt(Cha) + sizechange;}
    }
    fixSkills(strmod, dexmod, intmod, wismod, chamod, sizechange);
    fixAC(sizechange, dexmod);
    changeHitDice(amount,0);
    
    hdtype = getHDType();
    avgval = hdtype / 2;
    if (hdtype < 3) avgval = 1;
    else if (hdtype < 5) avgval = 2.5;
    else if (hdtype < 7) avgval = 3.5;
    else if (hdtype < 9) avgval = 4.5;
    else if (hdtype < 11) avgval = 5.5;
    else if (hdtype < 13) avgval = 6.5;
    else if (hdtype < 21) avgval = 10.5;
    if ( safeParseInt(Con) > 0 )
      conhp = amount * Math.floor((safeParseInt(Con)-10)/2);
    else
      conhp = 0;
    addhp = Math.floor(avgval * amount + conhp);
    HP = safeParseInt(HP) + addhp;
    crval = safeParseInt(CR);
    count=0;
    newcr = crval;
    while ( count < addhp )
    {
        newcr++;
        count += HP2CR[newcr];
    }
    oldcr = CR;
    CR = newcr - 1;
    
    oldHP = HP;
    adjustForCR(oldcr,CR,false)
    hpmod = conhp + HP - oldHP;
    addHpToHD(hpmod)
    
    changeSize(sizechange);
}

function addHpToHD( hpmod )
{
    if (hpmod != 0 && HD != "")
    {
        loc1 = HD.indexOf("+");
        loc2 = HD.indexOf("-");
        loc = Math.max(loc1,loc2);
        sign="";
        
        if ( hpmod >= 0 ) sign="+";
        if ( HD == "" ) HD = "("+sign+hpmod+")";
        else if ( loc < 0 ) {
            lastchar = HD.charAt(HD.length-1);
            if ( lastchar == ")" || lastchar == "]" || lastchar == ";" )
                HD = HD.substring(0,HD.length-1)+sign+hpmod+lastchar;
            else
                HD += sign+hpmod;
        } else {
            endloc = HD.substring(loc).search("[ ;)]");
            if ( endloc < 0 ) 
                endloc = HD.length-1;
            else
                endloc += loc;
            hpmod = hpmod + safeParseInt(HD.substring(loc,endloc));
            if ( hpmod >= 0 ) sign="+";
            if ( hpmod != 0 )
                HD = HD.substring(0,loc)+sign+hpmod+HD.substring(endloc);
            else
                HD = HD.substring(0,loc)+HD.substring(endloc);
        }
    }
}
var sizeStr = ['Fine','Diminutive','Tiny','Small','Medium','Large','Huge','Gargantuan','Colossal']
var sizeModCMB = [-8,-4,-2,-1,0,1,2,4,8]
var sizeModATK = [+8,+4,+2,+1,0,-1,-2,-4,-8]
var sizeModFLY = [+8,+6,+4,+2,0,-2,-4,-6,-8]
var sizeModSTEALTH = [+16,+12,+8,+4,0,-4,-8,-12,-16]
var sizeModSTR = [0,0,2,6,10,18,26,34,42]
var sizeModDEX = [0,-2,-4,-6,-8,-10,-12,-12,-12]
var sizeModCON = [0,0,0,0,2,6,10,14,18]
var sizeModNATAC = [0,0,0,0,0,2,5,9,14]
var sizeModSpace = [0.5,1,2.5,5,5,10,15,20,30]
var sizeModReach = [0,0,0,5,5,10,15,20,30]

function changeSpeed( type, amount, keepIfBetter, maneuverability )
{
    var start=-1;
    var end=-1;
    var currSpeed = 0;
    if ( type=="" || type=="land" ) {
        // land speed
        landSpeed = parseInt(Speed);
        if ( isNaN(landSpeed) ) {
            // no land speed, just add it
            Speed = amount+" ft. "+Speed;
            return;
        }
        start=0;
        end = Speed.indexOf("ft");
        currSpeed = safeParseInt(Speed.substring(start));
    } else {
        start = Speed.indexOf(type);
        if ( start == -1 ) {
            // new speed type
            end = -1;
        } else {
            // existing speed type
            start += type.length + 1;
            end = Speed.indexOf(" ",start);
            currSpeed = safeParseInt(Speed.substring(start));
        }
    }
    if ( start == -1) {
        // new speed type
        pre = "";
        if (Speed.length > 0) pre=", ";
        Speed += pre + type + " " + amount;
        if (type == "fly" && maneuverability != "") {
            Speed += " ("+maneuverability+")";
        }
        return;
    } else {
        // change a current speed
        if ((keepIfBetter) && (currSpeed > amount))
            return;
        if (type == "fly" && maneuverability != "") {
            mstart = Speed.indexOf("(",end);
            mend = Speed.indexOf(")",end);
            if ((mstart != -1) && (mend != -1)) {
                Speed = Speed.substring(0,mstart+1)+maneuverability+Speed.substring(mend);
            }
        }
        Speed = Speed.substring(0,start)+amount+Speed.substring(end);
    }
}

function changeSize( sizeadj )
{
    if ( sizeadj == 0 ) return;
    for (s=0; s<sizeStr.length; s++)
    {
        if ( Size == sizeStr[s] ) 
        {
            sx = s + sizeadj;
            if ( sx < 0 ) sx = 0;
            if ( sx >= sizeStr.length ) sx = sizeStr.length - 1;
            Size = sizeStr[sx];
            
            if ( Space != "" )
            {
                spaceval = safeParseInt(Space);
                if ( spaceval == 2 ) spaceval = 2.5;
                newspaceval = spaceval + sizeModSpace[sx] - sizeModSpace[s]
                if ( newspaceval < 1 ) newspacestr = "1/2";
                else if ( newspaceval > 1 && newspaceval < 5 ) newspacestr="2-1/2"
                else newspacestr = Math.floor(newspaceval)
                end = Space.indexOf(" ");
                Space = newspacestr + Space.substr(end);
            }

            if ( Reach != "" )
            {
                reachval = safeParseInt(Reach);
                newReachval = reachval + sizeModReach[sx] - sizeModReach[s]
                if ( newReachval < 0 ) newReachval = 0;
                end = Reach.indexOf(" ");
                Reach = newReachval + Reach.substr(end);
            }
            return;
        }
    }
}

function sizeAdj( sizeadj, type )
{
    sizemod = 0;
    for (s=0; s<sizeStr.length; s++)
    {
        if ( Size == sizeStr[s] ) 
        {
            sx = s + sizeadj;
            if ( sx < 0 ) sx = 0;
            if ( sx >= sizeStr.length ) sx = sizeStr.length-1;
            switch (type)
            {
                case "CMB":
                case "CMD": sizemod = sizeModCMB[sx] - sizeModCMB[s]; break;
                case "AC": // ac and atk change by the same amounts
                case "ATK": sizemod = sizeModATK[sx] - sizeModATK[s]; break;
                case "FLY": sizemod = sizeModFLY[sx] - sizeModFLY[s]; break;
                case "STEALTH": sizemod = sizeModSTEALTH[sx] - sizeModSTEALTH[s]; break;
                case "STR": sizemod = sizeModSTR[sx] - sizeModSTR[s]; break;
                case "DEX": sizemod = sizeModDEX[sx] - sizeModDEX[s]; break;
                case "CON": sizemod = sizeModCON[sx] - sizeModCON[s]; break;
                case "NATAC": sizemod = sizeModNATAC[sx] - sizeModNATAC[s]; break;
                default: sizemod = 0;
            }
            break;
        }
    }
    return sizemod;
}

function fixAC( sizemod, dexmod )
{
        dexsizemod = Math.floor(sizeAdj( sizemod, "DEX" )/2);
        natacsizemod = sizeAdj( sizemod, "NATAC" );
        acsizemod = sizeAdj( sizemod, "AC" );
        natac = getNatAC();
        if ( natacsizemod + AC_NatAdv < -natac ) natacsizemod = -natac - AC_NatAdv
        ACBase = safeParseInt(ACBase) + dexsizemod + natacsizemod + dexmod + acsizemod;
        ACTouch = safeParseInt(ACTouch) + dexsizemod + dexmod + acsizemod;
        ACFlatFooted = safeParseInt(ACFlatFooted) + natacsizemod + acsizemod;
        AC_DexAdv += dexsizemod + dexmod;
        AC_NatAdv += natacsizemod;
        AC_SizeAdv += acsizemod;
}

function getNatAC()
{
    natloc = AC_Mods.toUpperCase().indexOf("NATURAL");
    if ( natloc == -1 ) natAC = 0;
    else {
        plusloc = AC_Mods.substring(0,natloc).lastIndexOf("+");
        natAC = 0;
        if ( plusloc >= 0 )
            natAC = safeParseInt(AC_Mods.substring(plusloc,natloc))
        if ( isNaN(natAC) ) natAC = 0;
    }
    return natAC;
}

function fixStatsAtksBySize( sizeadj )
{
    strchange = sizeAdj( sizeadj, "STR" );
    dexchange = sizeAdj( sizeadj, "DEX" );
    conchange = sizeAdj( sizeadj, "CON" );
    if (( Str != "" ) && ( Str != "-" )) Str = safeParseInt(Str) + strchange;
    if (( Dex != "" ) && ( Dex != "-" )) Dex = safeParseInt(Dex) + dexchange;
    if (( Con != "" ) && ( Con != "-" )) Con = safeParseInt(Con) + conchange;
    if ( Fort != "" ) 
    { 
        Fort = safeParseInt(Fort) + Math.floor(conchange/2); 
        if ( Fort >= 0 ) Fort = "+"+Fort; 
    }
    if ( Ref  != "" ) 
    { 
        Ref = safeParseInt(Ref) + Math.floor(dexchange/2); 
        if ( Ref >= 0 ) Ref = "+"+Ref; 
    }
    if ( Init != "" )              
    {
        Init=safeParseInt(Init)+Math.floor(dexchange/2);
        if ( safeParseInt(Init) >= 0 ) Init = "+"+Init;
    }
    fixAttacks( Math.floor(strchange/2), Math.floor(dexchange/2), sizeadj );
}

function fixCMB( stradj, sizeadj )
{
    var sizemod = 0;
    if (( CMB != "" ) && ( sizeadj != 0 ))
    {
        sizemod = sizeAdj(sizeadj, "CMB");
    }
    if ( CMB != "" ) CMB = safeParseInt(CMB) + stradj + sizemod;
}

function fixCMD( stradj, dexadj, sizeadj )
{
    var sizemod = 0;
    if (( CMD != "" ) && ( sizeadj != 0 ))
    {
        sizemod = sizeAdj(sizeadj, "CMD");
    }
    if ( CMD != "" ) CMD = safeParseInt(CMD) + stradj + dexadj + sizemod;
}

function fixCR( amt )
{
    if ( isEmpty(CR) ) return;
    CR += "" // make sure its a string
    slash = CR.indexOf("/");
    if ( slash > 0 )
    {
        n = safeParseInt(CR.substring(0,slash));
        d = safeParseInt(CR.substring(slash+1));
        if (d==0) d=1;
        crval = n / d;
    } else
        crval = safeParseInt(CR);
    if ( amt > 0 )
    {
        for (i=0; i<amt; i++)
        {
            if ( crval >= 1 ) crval += 1;
            else if ( crval < .126 ) crval = .167; // 1/8 -> 1/6
            else if ( crval < .170 ) crval = .250; // 1/6 -> 1/4
            else if ( crval < .260 ) crval = .333; // 1/4 -> 1/3
            else if ( crval < .334 ) crval = .500; // 1/3 -> 1/2
            else crval = 1;
        }
    } else {
        for (i=0; i<Math.abs(amt); i++)
        {
            if ( crval >= 2 ) crval -= 1;
            else if ( crval > .999 ) crval = .500; // 1 -> 1/2
            else if ( crval > .499 ) crval = .333; // 1/2 -> 1/3
            else if ( crval > .332 ) crval = .250; // 1/3 -> 1/4
            else if ( crval > .249 ) crval = .167; // 1/4 -> 1/6
            else if ( crval > .165 ) crval = .125; // 1/6 -> 1/8
        }
    }
    if ( crval >= 1 ) CR = crval;
    else if ( crval < .126 ) CR = "1/8"; 
    else if ( crval < .170 ) CR = "1/6";
    else if ( crval < .260 ) CR = "1/4";
    else if ( crval < .334 ) CR = "1/3";
    else CR = "1/2";
}

// adjust the number in a sting as   str=".... X3 itemStr... where X= + or -;
function changeAPreValue(mod, itemStr, str, addIfNotThere)
{
    found = 0;
    if ( mod != 0 )
    {
        itemloc = 0;
        startnumloc = 0;
        do 
        {
            itemloc = str.substring(itemloc).toUpperCase().search(" "+itemStr.toUpperCase());
            if ( itemloc >= 2 )
            {   
                found++;
                signloc1=str.substring(0,itemloc).lastIndexOf("+");
                signloc2=str.substring(0,itemloc).lastIndexOf("-");
                signloc = Math.max(signloc1,signloc2);
                if ( signloc >= 0 )
                {
                    endnumloc=itemloc;
                    value = safeParseInt(str.substring(signloc,endnumloc)) + mod;
                    if ( value < 0 ) sign="";
                    else if ( value > 0 ) sign="+";
                    str = str.substring(0,signloc) + sign + value + str.substring(endnumloc);
                }
            }
        } while (itemloc >= 2)
        if ( addIfNotThere && found==0 )
        {
            if ( mod < 0 ) sign="";
                else sign="+";
            toadd = ", "+sign+mod+" "+itemStr;
            lastchar = str.charAt(str.length - 1);
            if (lastchar == ")" || lastchar == "]" || lastchar == ";")
                str = str.substring(0,str.length-1)+toadd+lastchar;
            else
                str += toadd;
        }   
    }

    return str;
}

function changeASkill( mod, SkillString, str, sizeadj )
{
    var skillloc;
    var signloc;
    var endnumloc;
    var value;
    
    if ( mod != 0 )
    {
        for (i=0; i<SkillString.length; i++)
        {
            skillloc = 0;
            endnumloc = 0;
            do 
            {
                skillloc = str.substring(endnumloc).search(SkillString[i]);
                sizemod = 0;
                if ( SkillString[i].toUpperCase() == "FLY" ) sizemod = sizeAdj( sizeadj, "FLY");
                if ( SkillString[i].toUpperCase() == "STEALTH" ) sizemod = sizeAdj( sizeadj, "STEALTH");
                if ( skillloc >= 0 )
                {   
                    signloc=str.substring(skillloc+endnumloc).search("[+-]")+skillloc+endnumloc;
                    endnumloc=str.substring(signloc).search("[,]");
                    if ( endnumloc < 0 ) endnumloc = str.length;
                    else endnumloc += signloc
                    value = safeParseInt(str.substring(signloc,endnumloc)) + mod + sizemod;
                    if ( value < 0 ) sign="";
                    else sign="+";
                    str = str.substring(0,signloc) + sign + value + str.substring(endnumloc);
                }
            } while (skillloc >= 0)
        }
    }
    return str;
}

function fixSkills( strmod, dexmod, intmod, wismod, chamod, sizeadj )
{
    // search for the various skills
    Skills = changeASkill( strmod, StrSkills, Skills, sizeadj );
    Skills = changeASkill( dexmod, DexSkills, Skills, sizeadj );
    Skills = changeASkill( intmod, IntSkills, Skills, sizeadj );
    Skills = changeASkill( wismod, WisSkills, Skills, sizeadj );
    Skills = changeASkill( chamod, ChaSkills, Skills, sizeadj );
    
    Senses = changeASkill( strmod, StrSkills, Senses, sizeadj );
    Senses = changeASkill( dexmod, DexSkills, Senses, sizeadj );
    Senses = changeASkill( intmod, IntSkills, Senses, sizeadj );
    Senses = changeASkill( wismod, WisSkills, Senses, sizeadj );
    Senses = changeASkill( chamod, ChaSkills, Senses, sizeadj );
}

function changeDC( mod, str )
{
    var dcloc;
    var startloc;
    var endnumloc;
    var value;
    
    if ( mod != 0 )
    {
        dcloc = 0;
        endnumloc = 0;
        do 
        {
            dcloc = str.substring(endnumloc).search("DC ");
            if ( dcloc >= 0 )
            {   
                startloc=dcloc+endnumloc+3;
                endnumloc=str.substring(startloc).search("[, );]");
                if ( endnumloc < 0 ) endnumloc = str.length;
                else endnumloc += startloc
                value = safeParseInt(str.substring(startloc,endnumloc)) + mod;
                if ( !isNaN(value) )
                    str = str.substring(0,startloc) + value + str.substring(endnumloc);
            }
        } while (dcloc >= 0)
    }
    return str;
}

function fixDC( mod )
{
    SpecialAbilities = changeDC( mod, SpecialAbilities );
    SpecialAttacks = changeDC( mod, SpecialAttacks );
    SpellLikeAbilities = changeDC( mod, SpellLikeAbilities );
    Melee = changeDC( mod, Melee );
    Ramged = changeDC( mod, Ranged );
    SpellsPrepared = changeDC( mod, SpellsPrepared );
    SpellsKnown = changeDC( mod, SpellsKnown );
    Reach = changeDC( mod, Reach );
    Aura = changeDC( mod, Aura );
}

var NaturalAttackTypes = ["bite","claw","gore","hoof","tentacle","wing","pincers","tail","slam","sting","talons","other"];
var NaturalAttackPrimary = ["p","p","p","s","s","s","s","s","p","p","p","s"];
var NaturalAttackDmg = [ ["1","1d2","1d3","1d4","1d6","1d8","2d6","2d8","4d6"],
                         ["-","1","1d2","1d3","1d4","1d6","1d8","2d6","2d8"],
                         ["1","1d2","1d3","1d4","1d6","1d8","2d6","2d8","4d6"],
                         ["-","1","1d2","1d3","1d4","1d6","1d8","2d6","2d8"],
                         ["-","1","1d2","1d3","1d4","1d6","1d8","2d6","2d8"],
                         ["-","1","1d2","1d3","1d4","1d6","1d8","2d6","2d8"],
                         ["1","1d2","1d3","1d4","1d6","1d8","2d6","2d8","4d6"],
                         ["1","1d2","1d3","1d4","1d6","1d8","2d6","2d8","4d6"],
                         ["-","1","1d2","1d3","1d4","1d6","1d8","2d6","2d8"],
                         ["-","1","1d2","1d3","1d4","1d6","1d8","2d6","2d8"],
                         ["-","1","1d2","1d3","1d4","1d6","1d8","2d6","2d8"],
                         ["-","1","1d2","1d3","1d4","1d6","1d8","2d6","2d8"]];
                         
function addNaturalAttack( num, type )
{
    var i;
    var s;
    
    type = type.toLowerCase();
    if ( Melee.indexOf(type) != -1 ) return;
    
    for (i=0; i<NaturalAttackTypes.length-1; i++) {
        if ( NaturalAttackTypes[i] == type )
            break;
    }
    for (s=0; s<sizeStr.length; s++) {
        if ( Size == sizeStr[s] )
            break;
    }
    if ( s == sizeStr.length ) s=4;
    
    
    strMod = Math.floor((safeParseInt(Str)-10)/2);
    atk = safeParseInt(BaseAtk) + strMod + sizeModATK[s];
    dmg = NaturalAttackDmg[i][s];
    sign = "";
    if ( strMod >= 0 ) sign = "+";
    if ( NaturalAttackPrimary[i] == "p" ) {
        dmgMod = sign + strMod;
    } else {
        dmgMod = sign + Math.floor(strMod/2);
        atk -= 5;
    }
    if ( strMod == 0 ) dmgMod = "";
    if ( atk >=0 ) atk = "+"+atk;
    
    if ( Melee.length > 0 ) Melee += ", ";
    if ( num > 1 ) Melee += num + " ";
    Melee += type + " " + atk + " ("+ dmg + dmgMod +")";
}

function changeAttack( mod, atk, sizeadj, dmgmod, isMelee )
{
    // the "mod" should include changes due to size to the modifier, the sizeadj only adjusts the atk and dmg dice by that change
    var plusloc;
    var parenloc;
    var endparenloc
    var startloc;
    var endnumloc;
    var value;
    var s = atk;
    var locadjust = 0;
    
    var dicetype = ['1', '1d2', '1d3', '1d4', '1d6', '1d8', '2d6', '2d8', '4d6', '6d6', '8d6', '12d6'];
    var dicenum = dicetype.length;
    
    var sizemod = sizeAdj( sizeadj, "ATK" );
    
    // do double damage if only one melee attack.  Guess at if there is only one attack cause I'm lazy
    if ( isMelee && s.length < 26) dmgmod *= 2;
    
    if ( atk == "" ) return atk;
    if ( mod != 0 ) 
    {
        plusloc = 0;
        parenloc = 0;
        endnumloc = 2;
        do 
        {
            plusloc = s.substring(endnumloc).search("[+-]");
            parenloc = s.substring(endnumloc).search("[(]");
            isSwarm = false;
            swarmloc = s.substring(endnumloc-2).search("swarm");
            if ((swarmloc >= 0) && (swarmloc <= 4)) isSwarm = true;
            if ((( plusloc >= 0 ) && ( plusloc < parenloc )) || isSwarm)
            {   
                if (isSwarm)
                {
                    parenloc += endnumloc;
                    endparenloc = s.substring(parenloc).search("[)]") + parenloc;
                    // attack
                    startloc=swarmloc + endnumloc - 2 + 5;
                    endnumloc=startloc;
                } else {                
                    parenloc += endnumloc;
                    endparenloc = s.substring(parenloc).search("[)]") + parenloc;
                    // attack
                    startloc=plusloc+endnumloc;
                    endnumloc=s.substring(startloc).search("[, ;/]");
                    if ( endnumloc < 0 ) endnumloc = s.length;
                    else endnumloc += startloc;
                    value = safeParseInt(s.substring(startloc,endnumloc)) + mod + sizemod;
                    if ( value < 0 ) sign="";
                    else sign="+";
                    atk = atk.substring(0,startloc+locadjust) + sign + value + s.substring(endnumloc);
                    locadjust += (sign+value).length - (endnumloc - startloc);
                }
                // multiple attacks
                while (s.substr(endnumloc,1) == "/")
                {
                    plusloc = s.substring(endnumloc).search("[+-]");
                    if (( plusloc >= 0 ) && ( plusloc < parenloc ))
                    {
                        startloc=plusloc+endnumloc;
                        endnumloc=s.substring(startloc).search("[, ;/]");
                        if ( endnumloc < 0 ) endnumloc = s.length;
                        else endnumloc += startloc
                        value = safeParseInt(s.substring(startloc,endnumloc)) + mod + sizemod;
                        if ( value < 0 ) sign="";
                        else sign="+";
                        atk = atk.substring(0,startloc+locadjust) + sign + value + s.substring(endnumloc);
                        locadjust += (sign+value).length - (endnumloc - startloc);
                    }
                }

                // damage
                if ( sizeadj != 0 )
                {
                    diceloc=s.substring(parenloc).search("[d]");
                    if ( diceloc >= 0 ) 
                    {
                        startloc = diceloc + parenloc - 1;
                        endnumloc= startloc + 3;
                        dice = s.substring(startloc,endnumloc);
                        for (d=0; d<dicenum; d++)
                        {
                            if (dice == dicetype[d])
                            {
                                dx = d + sizeadj;
                                if (dx < 0) dx=0;
                                if (dx > dicenum) dx = dicenum-1;
                                if ( dx != d ) {
                                    atk = atk.substring(0,startloc+locadjust) + dicetype[dx] + s.substring(endnumloc);
                                    locadjust += dicetype[dx].length - (endnumloc - startloc);
                                }
                                break;
                            }
                        }
                    }
                }
                plusloc=s.substring(parenloc).search("[+-/]");
                if ( isMelee ) // only add damage bonus to melee attacks normally
                {
                    if (( plusloc >= 0 ) && ( s.substr(parenloc+plusloc,1) != "/" ))
                    {
                        startloc = plusloc + parenloc;
                        endnumloc=s.substring(startloc).search("[, ;/)]");
                        if ( endnumloc < 0 ) endnumloc = s.length;
                        else endnumloc += startloc
                        value = safeParseInt(s.substring(startloc,endnumloc)) + dmgmod;
                        if ( value < 0 ) sign="";
                        else sign="+";
                        if (value == 0) {
                            sign = "";
                            value = "";
                        }
                        atk = atk.substring(0,startloc+locadjust) + sign + value + s.substring(endnumloc);
                        locadjust += (sign+value).length - (endnumloc - startloc);
                        temploc = s.substring(endnumloc).search("[)]");
                        if (temploc >= 0) endnumloc += temploc + 4 ;
                        else 
                        {
                            endnumloc = -1;
                            plusloc = -1;
                        }
                    } else if ((dmgmod != 0) && !isSwarm) {
                        endofdmgdice = s.substring(parenloc).search("[/)]")+parenloc;
                        if ( dmgmod < 0 ) sign="";
                        else sign="+"; 
                        atk = atk.substring(0,endofdmgdice+locadjust) + sign + dmgmod + s.substring(endofdmgdice);
                        locadjust += (sign+value).length;
                        temploc = s.substring(endnumloc).search("[)]");
                        if (temploc >= 0) endnumloc += temploc + 4 ;
                        else 
                        {
                            endnumloc = -1;
                            plusloc = -1;
                        }
                    } else {
                        plusloc = -1;
                    }
                }
                endnumloc = endofdmgdice = s.substring(parenloc).search("[)]")+parenloc;
            } else if ( plusloc != 0 ) {
                endnumloc += 1 + plusloc;
            }
        } while (plusloc >= 0)
    }
//  alert(s+"\n\n"+atk);
    return atk;
}

function fixAttacks( strmod, dexmod, sizeadj )
{
    // the "mod" should include changes due to size to the modifier, the sizeadj only adjusts the atk and dmg dice by that change
    Melee = changeAttack( strmod, Melee, sizeadj, strmod, true );
    Ranged = changeAttack( dexmod, Ranged, sizeadj, strmod, false );
}

function adjustRHD( amount )
{ 
    rhd = safeParseInt(document.form.RacialHitDice.value) + amount;
    if ( rhd < 0 ) rhd = 0;
    if ( rhd > 30 ) rhd = 30;
    document.form.RacialHitDice.value = rhd;
}

////////////////// SKELETON ////////////////////////////

function skeleton () 
{
    Advancement+="Skeleton ";
    
//Change CR
    var oldTW = [0.5,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]
    var newCR = ["1/6","1/3",1,1,2,2,3,3,4,4,5,5,6,6,6,7,7,7,8,8,8];
    var newXP = [65,135,400,400,600,600,800,800,1200,1200,1600,1600,2400,2400,2400,3200,3200,3200,4800,4800,4800];

    var i = oldTW.indexOf(HitDice);
    CR = newCR[i];
    XP = newXP[i];
//Alignment & Type  
    Alignment = "NE";
    Type = "undead";
//Filter some subtypes (Kill-> Chaos, Good, Angel....)(Maintain -> Aquatic, Water, Earth....)
    var regexp = new RegExp(/(adlet|aeon|agathion|angel|archon|asura|augmented|azata|behemoth|catfolk|chaotic|clockwork|daemon|dark folk|demodand|demon|devil|div|dwarf|elf|extraplanar|evil|elemantal|giant|gnome|goblinoid|good|halfling|human|incorporeal|inevitable|kami|kyton|lawful|leshy|nightshade|oni|orc|protean|qlippoth|rakshasa|ratfolk|reptilian|sasquatch|shapechanger|vanara|vishkanya)/g);//Fl\FCche
    SubType = SubType.replace(regexp,"");

//Attributes
    Dex=safeParseInt(Dex)+2;
    Wis = 10;
    old_Cha = Cha; //need to fix SLA DC
    Cha = 10;
    Con = "-";
    Int = "-";
    var ChaMod = Math.floor((safeParseInt(Cha)-10)/2);
    var DexMod = Math.floor((safeParseInt(Dex)-10)/2);
    var WisMod = Math.floor((safeParseInt(Wis)-10)/2);

//Nat AC Bonus is set to (see skeleton template)
    var i = sizeStr.indexOf(Size);

    var Nat_AC_before = -1 * FindArmorValue("natural", AC_Mods, true);
    if(i <= 2) {AC_NatAdv = 0 + Nat_AC_before;}
    else if(i == 3) {AC_NatAdv = 1 + Nat_AC_before;}
    else if(i == 4||i == 5) {AC_NatAdv = 2 + Nat_AC_before;}
    else if(i == 6) {AC_NatAdv = 3 + Nat_AC_before;}
    else if(i == 7) {AC_NatAdv = 6 + Nat_AC_before;}
    else if(i == 8) {AC_NatAdv = 10 + Nat_AC_before;}
    else {AC_NatAdv = 0 + Nat_AC_before;}
    
    ACBase = safeParseInt(ACBase) + AC_NatAdv;
    ACFlatFooted = safeParseInt(ACFlatFooted) + AC_NatAdv;
    
//No special Attacks
    SpecialAttacks = "";

//Fix DC of Spell Like Abilities
    changeDC( Math.floor((safeParseInt(old_Cha - Cha)-10)/2), SpellLikeAbilities );
    
//Defense
    Immune = "Cold, like undead";
    Resist = "";
    SR = "";
    DR = "5/bludgeoning";

//No Skills
    Skills = "";
    RacialMods = "";
    
//Only Bonus Feat
    Feats = "Improved InitiativeB";
    Init = Math.floor((safeParseInt(Dex)-10)/2)+4;
    
//all undead get Darkvision
    Senses = "darkvision 60 ft.; Perception "+addplus(WisMod);
    
//no flight
    var regexp = new RegExp(/Fly.*(,|$)/g);
    Speed = Speed.replace(regexp,"");

//How many TW
    HDamount = getHDamount();

//Kill Class Level
    if(Class != "") 
    {
        var ClassLevel = 0;

        var result = Class.split('/');
        for(var i=0;i<result.length;i++)
            {
            ClassLevel += parseInt(result[i].match(/\d+/g));
            }
    HDamount = HDamount - ClassLevel;
    if(HDamount <= 0) HDamount = 1;
    addNaturalAttack(1, "claw");
    Class = "";
    }

//Kill SpellsKnown, SpellsPrepared, SpellDomains
    SpellsKnown = "";
    SpellsPrepared = "";
    SpellDomains = "";
    
//New Saves
    Fort = Math.floor(HDamount/3) + ChaMod;
    Ref = Math.floor(HDamount/3) + DexMod;
    Will = Math.floor(HDamount/2) + 2 + WisMod;

//New BaseAttack
    BaseAtk = Math.floor(HDamount/4*3);

//Change HitDice to d8
//Hitpoints (xd8+0)
    var chabonus = HDamount * ChaMod;
    HP = Math.floor(HDamount * 4.5 + chabonus);
    HD = "("+HDamount+"d8+"+chabonus+")";

//Fix Attacks (feat bonus...)
if(Melee != "") {Melee = changeAttackSkeleton (Str,Melee,"true");}
if(Ranged != "") {Ranged = changeAttackSkeleton (Dex,Ranged,"false");}

//Kill all SpecialAbilities or Kill-All execpt Ex?

    SpecialAbilities = "";  //
    


//+2 dex chnaging -> AC, CMD
    stradj = strmod = 0; dexadj = dexmod = 1; sizeadj = 0;
    fixAttacks( strmod, dexmod, sizeadj );
    fixCMB( stradj, sizeadj );
    fixCMD( stradj, dexadj, sizeadj );
    fixAC(0,dexmod);

    
//End of function
}

function changeAttackSkeleton (attribut, atk, isMelee) {
//Melee is GAB + STR + Size (no feats)
//Range is GAB + DEX + Size (no feats)
   var plusloc;
    var parenloc;
    var endparenloc
    var startloc;
    var endnumloc;
    var value;
    
    var i = sizeStr.indexOf(Size);
    var sizeadj = sizeModATK[i];
    
    var s = atk;
    var locadjust = 0;
    var dmgmod = 0;
    var mod = Math.floor((safeParseInt(attribut)-10)/2);
    
    var sizemod = sizeModATK[i];
        
        plusloc = 0;
        parenloc = 0;
        endnumloc = 2;
        do 
        {
            plusloc = s.substring(endnumloc).search("[+-]");
            parenloc = s.substring(endnumloc).search("[(]");
            if (( plusloc >= 0 ) && ( plusloc < parenloc ))
            {   
                parenloc += endnumloc;
                endparenloc = s.substring(parenloc).search("[)]") + parenloc;
                // attack
                startloc=plusloc+endnumloc;
                endnumloc=s.substring(startloc).search("[, ;/]");
                if ( endnumloc < 0 ) endnumloc = s.length;
                else endnumloc += startloc
                value = mod+BaseAtk+sizeadj;
                if ( value < 0 ) sign="";
                else sign="+";
                atk = atk.substring(0,startloc+locadjust) + sign + value + s.substring(endnumloc);
                locadjust += (sign+value).length - (endnumloc - startloc);
                
                // multiple attacks
                while (s.substr(endnumloc,1) == "/")
                {
                    plusloc = s.substring(endnumloc).search("[+-]");
                    if (( plusloc >= 0 ) && ( plusloc < parenloc ))
                    {
                        startloc=plusloc+endnumloc;
                        endnumloc=s.substring(startloc).search("[, ;/]");
                        if ( endnumloc < 0 ) endnumloc = s.length;
                        else endnumloc += startloc
                        value = mod+BaseAtk+sizeadj;
                        if ( value < 0 ) sign="";
                        else sign="+";
                        atk = atk.substring(0,startloc+locadjust) + sign + value + s.substring(endnumloc);
                        locadjust += (sign+value).length - (endnumloc - startloc);
                    }
                }

                endnumloc = endofdmgdice = s.substring(parenloc).search("[)]")+parenloc;
            }
        } while (plusloc >= 0)
    return atk;
}

//How many TW ??
function getHDamount()
{
  var hdamount = 0;
  if ( HD != "" ) 
  {
    end = HD.search( "[d]" );
    start = HD.search( "[(]" );
    if ( (end > start) && (start >= 0) )
    {
        hdamount = safeParseInt(HD.substring(start+1,end));
        if ( hdamount < 1 ) hdamount = 1;
        if ( isNaN(hdamount) ) hdamount = 1;
    }
  }
  return hdamount;
}

//Find Armor Value
function FindArmorValue(itemStr, str, addIfNotThere)
{
    var found = 0;

        itemloc = 0;
        startnumloc = 0;
        do 
        {
            itemloc = str.substring(itemloc).toUpperCase().search(" "+itemStr.toUpperCase());
            if ( itemloc >= 2 )
            {   
                found++;
                signloc1=str.substring(0,itemloc).lastIndexOf("+");
                signloc2=str.substring(0,itemloc).lastIndexOf("-");
                signloc = Math.max(signloc1,signloc2);
                if ( signloc >= 0 )
                {
                    endnumloc=itemloc;
                    value = safeParseInt(str.substring(signloc,endnumloc));
                    if (typeof value === "undefined") {value = 0;}

                }
            }
        } while (itemloc >= 2)
        if ( addIfNotThere && found==0 )
        {
               sign="+";
            toadd = ", "+sign+"0 "+itemStr;
            lastchar = str.charAt(str.length - 1);
            if (lastchar == ")" || lastchar == "]" || lastchar == ";")
                str = str.substring(0,str.length-1)+toadd+lastchar;
            else
                str += toadd; value = 0;
        }   

    return value;
}
  
function zombie () {
    Advancement+="Zombie ";

//Change CR
    var oldTW = [0.5,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28];
    var newCR = ["1/8","1/4","1/2",1,1,2,2,3,3,4,4,5,5,6,6,6,6,7,7,7,7,8,8,8,8,9,9,9,9];
    var newXP = [50,100,200,400,400,600,600,800,800,1200,1200,1600,1600,2400,2400,2400,2400,3200,3200,3200,3200,4800,4800,4800,4800,6400,6400,6400,6400];
    
    var i = oldTW.indexOf(HitDice);
    CR = newCR[i];
    XP = newXP[i];

//Alignment & Type  
    Alignment = "NE";
    Type = "Undead";
    
//Filter some subtypes (Kill-> Chaos, Good, Angel....)(Maintain -> Aquatic, Water, Earth....)
    var regexp = new RegExp(/(Good|Evil|Neutral|Chaotic)/g);
    SubType = SubType.replace(regexp,"");
    
//Attributes
    Str=safeParseInt(Str)+2;
    Dex=safeParseInt(Dex)-2;
    Wis = 10;
    old_Cha = Cha; //need to fix SLA DC
    Cha = 10;
    Con = "-";
    Int = "-";
    var ChaMod = Math.floor((safeParseInt(Cha)-10)/2);
    var DexMod = Math.floor((safeParseInt(Dex)-10)/2);
    var WisMod = Math.floor((safeParseInt(Wis)-10)/2);

//Nat AC Bonus is set to (see skeleton template)
    var i = sizeStr.indexOf(Size);

    var Nat_AC_before = -1 * FindArmorValue("natural", AC_Mods, true);
    if(i <= 2) {AC_NatAdv = 0 + Nat_AC_before;}
    else if(i == 3) {AC_NatAdv = 1 + Nat_AC_before;}
    else if(i == 4) {AC_NatAdv = 2 + Nat_AC_before;}
    else if(i == 5) {AC_NatAdv = 3 + Nat_AC_before;}
    else if(i == 6) {AC_NatAdv = 4 + Nat_AC_before;}
    else if(i == 7) {AC_NatAdv = 7 + Nat_AC_before;}
    else if(i == 8) {AC_NatAdv = 11 + Nat_AC_before;}
    else {AC_NatAdv = 0 + Nat_AC_before;}
    
    ACBase = safeParseInt(ACBase) + AC_NatAdv;
    ACFlatFooted = safeParseInt(ACFlatFooted) + AC_NatAdv;

//No special Attacks
    SpecialAttacks = "";

//Fix DC of Spell Like Abilities
    changeDC( Math.floor((safeParseInt(old_Cha - Cha)-10)/2), SpellLikeAbilities );
    
//Defense
    Immune = "undead traits";
    Resist = "";
    SR = "";
    var n = SubType.search(/swarm/);
    if(n < 0) {DR = "5/slashing";}
    else {
        DR = ""; 
        var i = sizeStr.indexOf(Size);
            if(i == 0 || i == 1) Immune += ", weapon damage";
            if(i == 2) DefensiveAbilities += ", half damage from slashing and piercing weapons";
        }

//No Skills
    Skills = "";
    RacialMods = "";

//Only Bonus Feat
    Feats = "ToughnessB";

//all undead get Darkvision
    Senses = "darkvision 60 ft.; Perception "+addplus(WisMod);

//How many TW
//Kill Class Level
    if(Class != "") 
    {
        var ClassLevel = 0;

        var result = Class.split('/');
        for(var i=0;i<result.length;i++)
            {
            ClassLevel += parseInt(result[i].match(/\d+/g));
            }
    HitDice = HitDice - ClassLevel;
    if(HitDice <= 0) HitDice = 1;
    addNaturalAttack(1, "slam");
    Class = "";
    }
//Bonus HitDice
    var i = sizeStr.indexOf(Size);
    if(i == 3||i == 4) HitDice = HitDice+1;
    else if(i == 5) HitDice = HitDice+2;
    else if(i == 6) HitDice = HitDice+4;
    else if(i == 7) HitDice = HitDice+6;
    else if(i == 8) HitDice = HitDice+10;
    else HitDice = HitDice+0;
    
//Kill SpellsKnown, SpellsPrepared, SpellDomains
    SpellsKnown = "";
    SpellsPrepared = "";
    SpellDomains = "";
    
//New Saves
    Fort = Math.floor(HitDice/3) + ChaMod;
    Ref = Math.floor(HitDice/3) + DexMod;
    Will = Math.floor(HitDice/2) + WisMod;

//New BaseAttack
    BaseAtk = Math.floor(HitDice/4*3);

//Change HitDice to d8
//Hitpoints (xd8+0)
    var chabonus = HitDice * ChaMod;
    if(HitDice <= 3) var BonusHP = 3 + chabonus;
    else var BonusHP = HitDice + chabonus;
    HP = Math.floor(HitDice * 4.5 + BonusHP);
    
    HD = "("+HitDice+"d8+"+BonusHP+")";

//Kill all SpecialAbilities or Kill-All execpt Ex?

    SpecialAbilities = "Staggered (Ex): Zombies have poor reflexes and can only perform a single move action or standard action each round. A zombie can move up to its speed and attack in the same round as a charge action.";    //
    
//+2 str;-2 dex changing -> AC, CMD
    stradj = strmod = 1; dexadj = dexmod = -1; sizeadj = 0;
    fixAttacks( strmod, dexmod, sizeadj );
    fixCMB( stradj, sizeadj );
    fixCMD( stradj, dexadj, sizeadj );
    fixAC(sizeadj,dexmod);

//Fix Attacks (feat bonus...)
if(Melee != "") {Melee = changeAttackSkeleton (Str,Melee,"true");}
if(Ranged != "") {Ranged = changeAttackSkeleton (Dex,Ranged,"false");}

//Change Fly Speed
    var n = Speed.search(/fly/);
    if(n >= 0) {
        var amount = Speed.match(/fly\s\d*/m);
        amount = amount[0].split(" ");
        changeSpeed( "fly", amount[1], false, "clumsy" );
    }

//End of function
}  
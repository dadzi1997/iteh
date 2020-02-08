<?php
//definiše se mime type
header("Content-type: application/xml");
include("../model/konekcija.php");
//priprema upita
$sql="SELECT * FROM state ORDER BY idState ASC";
//kreiranje XMLDOM dokumenta
$dom = new DomDocument('1.0','utf-8');

//dodaje se koreni element
 $state = $dom->appendChild($dom->createElement('state'));

//izvršavanje upita
if (!$q=$mysqli->query($sql)){
//ako se upit ne izvrši
  //dodaje se element <greska> u korenom elementu <state>
 $greska = $state->appendChild($dom->createElement('greska'));
 //dodaje se elementu <greska> sadrzaj cvora
 $greska->appendChild($dom->createTextNode("Došlo je do greške pri izvršavanju upita"));
} else {
//ako je upit u redu
if ($q->num_rows>0){
//ako ima rezultata u bazi
$niz = array();
while ($red=$q->fetch_object()){
  //dodaje se element <st> u korenom elementu <state>
 $st = $state->appendChild($dom->createElement('st'));

 //dodaje  se <idState> element u <st>
 $idState = $st->appendChild($dom->createElement('idState'));
 //dodaje se elementu <idState> sadrzaj cvora
 $idState->appendChild($dom->createTextNode($red->idState));

 //dodaje  se <nameState> element u <st>
 $nameState = $st->appendChild($dom->createElement('nameState'));
 //dodaje se elementu <nameState> sadrzaj cvora
 $nameState->appendChild($dom->createTextNode($red->nameState));
}
} else {
//ako nema rezultata u bazi
  //dodaje se element <greska> u korenom elementu <state>
 $greska = $state->appendChild($dom->createElement('greska'));
 //dodaje se elementu <greska> sadrzaj cvora
 $greska->appendChild($dom->createTextNode("Nema unetih sta"));
}
}
//cuvanje XML-a
$xml_string = $dom->saveXML(); 
echo $xml_string;
//zatvaranje konekcije
$mysqli->close()
?>

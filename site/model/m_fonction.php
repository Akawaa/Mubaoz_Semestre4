<?php
	function convertitDatepicker($dateAconvert) {
		$jour = $dateAconvert[3].$dateAconvert[4];
		$mois = $dateAconvert[0].$dateAconvert[1];
		$annee = $dateAconvert[6].$dateAconvert[7].$dateAconvert[8].$dateAconvert[9];
		$date = $annee.'-'.$mois.'-'.$jour;
		return $date;
	}

	function deconvertitDatepicker($dateAdeconvertir) {
		$jour = $dateAdeconvertir[8].$dateAdeconvertir[9];
		$mois = $dateAdeconvertir[5].$dateAdeconvertir[6];
		$annee = $dateAdeconvertir[0].$dateAdeconvertir[1].$dateAdeconvertir[2].$dateAdeconvertir[3];
		$date = $mois.'/'.$jour.'/'.$annee;
		return $date;
	}
?>
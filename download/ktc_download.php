<?
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename=1101_korea_tour_card_leaflet_new.pdf');
echo file_get_contents("1101_korea_tour_card_leaflet_new.pdf");
?>
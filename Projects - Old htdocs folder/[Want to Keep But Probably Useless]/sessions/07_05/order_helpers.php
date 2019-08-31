<?php
$price = array(
    'Calla_Lilies' => 3,
    'Sunflowers' => 3,
    'Iris' => 2,
    'Peruvian_Lilies' => 2,
    'Daffodils_(Narcissus)' => 2,
    'Gerbera_Daisies' => 3,
    'Dendrobium_Orchid' => 4,
    'Roses' => 3,
    'Lilies' => 3,
    'Tulips' => 2,
    'Lilac' => 4,
    'Daisies' => 1
    );
function getColor($filename) {
	$parts = explode('_', $filename);
	return ucfirst($parts[2]);
}
$total = 0;
?>



<?php
if (isset($_GET['lat']) && isset($_GET['lon'])) {
    $lat = $_GET['lat'];
    $lon = $_GET['lon'];

    // Usamos el servicio de geocodificación inversa de Nominatim (OpenStreetMap)
    $url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=$lat&lon=$lon";

    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: geolocalizacion-app"
        ]
    ];
    $context = stream_context_create($opts);
    $response = file_get_contents($url, false, $context);
    $data = json_decode($response, true);

    if (isset($data['address']['postcode'])) {
        echo $data['address']['postcode'];
    } else {
        echo "No se pudo obtener el código postal.";
    }
} else {
    echo "Parámetros no válidos.";
}
?>
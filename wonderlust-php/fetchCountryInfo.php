<?php
if (isset($_GET['country'])) {
    $country = $_GET['country'];
    $apiUrl = "https://countries-api-abhishek.vercel.app/countries/" . urlencode($country);

    $json = file_get_contents($apiUrl);
    $data = json_decode($json, true);

    if (!empty($data) && isset($data["data"])) {
        $countryInfo = $data["data"];

        $response = [
            "language" => implode(", ", $countryInfo["languages"] ?? ["N/A"]),
            "currency" => $countryInfo["currency"] ?? "N/A", 
            "timezone" => implode(", ", $countryInfo["timezones"] ?? ["N/A"]),
            "flag" => $countryInfo["flag"] ?? "" 
        ];

        echo json_encode($response);
    } else {
        echo json_encode(["error" => "Country not found"]);
    }
}
?>

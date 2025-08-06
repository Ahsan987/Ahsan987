<?php
// Set response headers
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Include database connection
require '../statsAPIs/dbConn.php';

// Read the raw POST body and decode JSON
$input = json_decode(file_get_contents('php://input'), true);

// Extract and sanitize input fields (can be null or strings/integers)
$zone = isset($input['zone']) && trim($input['zone']) !== '' ? pg_escape_literal($dbconn, trim($input['zone'])) : 'NULL';
$circle = isset($input['circle']) && trim($input['circle']) !== '' ? pg_escape_literal($dbconn, trim($input['circle'])) : 'NULL';
$division = isset($input['division']) && trim($input['division']) !== '' ? pg_escape_literal($dbconn, trim($input['division'])) : 'NULL';
$forest = isset($input['forest']) && trim($input['forest']) !== '' ? pg_escape_literal($dbconn, trim($input['forest'])) : 'NULL';
$scheme = isset($input['scheme']) && trim($input['scheme']) !== '' ? pg_escape_literal($dbconn, trim($input['scheme'])) : 'NULL';
$year = isset($input['year']) && is_numeric($input['year']) ? (int)$input['year'] : 'NULL';

// Build the query (call the plantation scheme function with optional parameters)
$query = "SELECT * FROM public.get_plantation_scheme_data($zone, $circle, $division, $forest, $scheme, $year)";

// Execute the query
$result = pg_query($dbconn, $query);

if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => "Query failed: " . pg_last_error($dbconn)
    ]);
    exit;
}

// Fetch result
$row = pg_fetch_assoc($result);

if (!$row) {
    echo json_encode([
        "status" => "error",
        "message" => "No data found"
    ]);
    exit;
}

// Parse the JSON data returned by the function
$forest_geojson = json_decode($row['forest_geojson'], true);
$stats_summary = json_decode($row['stats_summary'], true);
$raw_data = json_decode($row['raw_data'], true);

// Return structured JSON response
echo json_encode([
    "status" => "success",
    "data" => [
        "forest_geojson" => $forest_geojson,
        "stats_summary" => $stats_summary,
        "raw_data" => $raw_data
    ]
]);

// Close DB connection
pg_close($dbconn);
?>
<?php
header("Content-Type: application/json");

// ----------------------------
// Load pt.json
// ----------------------------
$jsonPath = __DIR__ . "/pt.json";

if (!file_exists($jsonPath)) {
    http_response_code(500);
    echo json_encode(["error" => "pt.json not found"]);
    exit;
}

$data = json_decode(file_get_contents($jsonPath), true);
$elements = $data["elements"];

// ----------------------------
// Helper function
// ----------------------------
function normalize($value) {
    return strtolower(trim((string)$value));
}

// ----------------------------
// ROUTING LOGIC
// ----------------------------

// 1️⃣ ALL ELEMENTS
if (isset($_GET["all"])) {
    echo json_encode([
        "count" => count($elements),
        "elements" => $elements
    ], JSON_PRETTY_PRINT);
    exit;
}

// 2️⃣ SINGLE ELEMENT (name / symbol / number)
if (isset($_GET["element"])) {
    $query = normalize($_GET["element"]);

    foreach ($elements as $el) {
        if (
            normalize($el["name"]) === $query ||
            normalize($el["symbol"]) === $query ||
            (string)$el["number"] === $query
        ) {
            echo json_encode($el, JSON_PRETTY_PRINT);
            exit;
        }
    }

    http_response_code(404);
    echo json_encode(["error" => "Element not found"]);
    exit;
}

// 3️⃣ PERIOD
if (isset($_GET["period"])) {
    $period = (int) $_GET["period"];
    $result = [];

    foreach ($elements as $el) {
        if ($el["period"] === $period) {
            $result[] = $el;
        }
    }

    echo json_encode([
        "period" => $period,
        "count" => count($result),
        "elements" => $result
    ], JSON_PRETTY_PRINT);
    exit;
}

// 4️⃣ GROUP
if (isset($_GET["group"])) {
    $group = (int) $_GET["group"];
    $result = [];

    foreach ($elements as $el) {
        if ($el["group"] === $group) {
            $result[] = $el;
        }
    }

    echo json_encode([
        "group" => $group,
        "count" => count($result),
        "elements" => $result
    ], JSON_PRETTY_PRINT);
    exit;
}

// 5️⃣ TYPE / CATEGORY
if (isset($_GET["type"])) {
    $type = normalize($_GET["type"]);
    $result = [];

    foreach ($elements as $el) {
        if (normalize($el["category"]) === $type) {
            $result[] = $el;
        }
    }

    echo json_encode([
        "type" => $_GET["type"],
        "count" => count($result),
        "elements" => $result
    ], JSON_PRETTY_PRINT);
    exit;
}

// ----------------------------
// INVALID REQUEST
// ----------------------------
http_response_code(400);
echo json_encode([
    "error" => "Invalid API request"
], JSON_PRETTY_PRINT);

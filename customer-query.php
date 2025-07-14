<?php
$TOKEN = $curlclass->login($URL, $DB, $AUTH);
$LAYOUT = '案件_管理アポ';

$field = $_GET['field'] ?? '';
$keyword = $_GET['keyword'] ?? '';

if (!empty($field) && !empty($keyword)) {
    $postFields = json_encode([
        'query' => [[$field => $keyword]],
        'limit' => $limit,
        'offset' => $offset
    ]);
    $result = $curlclass->find($URL, $DB, $LAYOUT, $TOKEN, $postFields);
} else {
    $result = $curlclass->getrecords($URL, $DB, $LAYOUT, $TOKEN, $limit, $offset);
}

$curlclass->logout($URL, $DB, $TOKEN);

$records = $result['response']['data'] ?? [];
if (isset($result['messages'][0]['code']) && $result['messages'][0]['code'] === '401') {
    $records = [];
}

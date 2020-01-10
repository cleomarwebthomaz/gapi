<?php
header('Content-Type: application/json');

require './config.php';
require './lib/gapi.class.php';

$ga = new gapi(GA_EMAIL, GA_FILE);

$startDate = date('Y-m-01', mktime(0, 0, 0, date('m'), 1, date('Y')));
$endDate = date('Y-m-t', mktime(0, 0, 0, date('m'), 1, date('Y')));

if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $startDate = $_GET['start_date'];
    $endDate = $_GET['end_date'];

    $startDate = (new Datetime("{$startDate}"))->format('Y-m-d');
    $endDate = (new Datetime("{$endDate}"))->format('Y-m-t');

    for($month = 1; $month <= 12; $month++){
        $data = (object)[
            'start' => date('Y-m-d', mktime(0, 0, 0, date($month), 1, date('Y'))),
            'end' => date("Y-m-t", mktime(0,0,0, $month, '01', date('Y')))
        ];

        $ga->requestReportData($model->profile,array('browser','browserVersion'),array('pageviews','visits'),'-visits', null, $startDate, $endDate);

        $reports[$month] = [
            'visits' => $ga->getVisits(),
            'page_views' => $ga->getPageviews(),
        ];
    }

    echo json_encode([
        'reports' => $reports
    ]);
}

$ga->requestReportData(GA_PROFILE_ID, array('browser','browserVersion'),array('pageviews','visits'),'-visits', null, $startDate, $endDate);

echo json_encode([
    'total_results' => $ga->getTotalResults(),
    'page_views' => $ga->getPageviews(),
    'visits' => $ga->getVisits()
]);
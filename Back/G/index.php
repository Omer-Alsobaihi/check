<?php
require __DIR__ . '/includes/conn.php';
require __DIR__ . '/includes/engine.php';
require __DIR__ . '/includes/functionstore.php';

$hasSubmission = isset($_POST['scode']);
$scode = $hasSubmission ? substr(trim((string)$_POST['scode']), 0, 5) : '';
$status = $hasSubmission ? checkScodeStatus($conn, Corr($scode)) : null;

HeadHtml();
render_scode_input();

if ($status === 0) {
    NotOKPage();
} elseif ($status === 1) {
    ActOKPage();
} elseif ($status === 2) {
    OKPage();
} else {
    render_info_sections();
}

FootHtml();
?>

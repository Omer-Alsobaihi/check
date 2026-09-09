<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/includes/conn.php';
require __DIR__ . '/includes/engine.php';
require __DIR__ . '/includes/functionstore.php';

$hasSubmission = isset($_POST['scode']);
$scode = $hasSubmission ? substr(trim((string)$_POST['scode']), 0, 5) : '';
$nonce = isset($_POST['verify_nonce']) ? (string)$_POST['verify_nonce'] : bin2hex(random_bytes(16));
$status = $hasSubmission ? checkScodeStatus($conn, Corr($scode), 'items', $nonce) : null;

if (!$hasSubmission || empty($_SESSION['verify_nonce'])) {
    $_SESSION['verify_nonce'] = $nonce;
} elseif ($hasSubmission) {
    // رمز جديد للنموذج التالي، بينما يبقى nonce المرسل صالحًا لإعادة نفس الطلب فقط.
    $_SESSION['verify_nonce'] = bin2hex(random_bytes(16));
}

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

<?php
require __DIR__ . '/includes/conn.php';
require __DIR__ . '/includes/engine.php';
require __DIR__ . '/includes/functionstore.php';

// استقبال المدخلات عبر طريقة POST بأمان
$scode = isset($_POST['scode']) ? htmlspecialchars($_POST['scode']) : '';
$status = checkScodeStatus($conn, Corr($scode));

HeadHtml();
render_scode_input();

if(isset($_POST['scode']))  {
    
    if ($status === 0) {
        NotOKPage();
    } elseif ($status === 1) {
        ActOKPage();
    } elseif ($status === 2) {
        OKPage();
    }
}


FootHtml();
?>
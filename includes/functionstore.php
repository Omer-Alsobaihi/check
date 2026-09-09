<?php
function Corr($nameb) {
    $nameb = trim($nameb);
    $nameb = stripslashes($nameb);
    $nameb = htmlspecialchars($nameb, ENT_QUOTES, 'UTF-8');
    return $nameb;
}

function checkScodeStatus(PDO $conn, $scode, $tableName = 'items', $requestNonce = null) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // إعادة إرسال نفس النموذج (مثل الضغط المزدوج) يعيد النتيجة نفسها
    // ولا يعيد تنفيذ عملية التفعيل على قاعدة البيانات.
    if ($requestNonce && isset($_SESSION['verify_results'][$requestNonce])) {
        return $_SESSION['verify_results'][$requestNonce];
    }

    $stmt = $conn->prepare("SELECT act FROM `$tableName` WHERE scode = ? LIMIT 1");
    $stmt->execute([Corr($scode)]);
    $row = $stmt->fetch();
    
    // إذا لم يتم العثور على القيد
    if (!$row) {
        if ($requestNonce) {
            $_SESSION['verify_results'][$requestNonce] = 0;
        }
        return 0;
    }
    
    // إذا كان الحقل act يساوي 1
    if ($row['act'] == 1) {
        if ($requestNonce) {
            $_SESSION['verify_results'][$requestNonce] = 1;
        }
        return 1;
    }
    
    // إذا كان الحقل act يساوي 0، نفعّله ونسجل وقت التفعيل الأول فقط.
    // لا يتم تعديل ActDate عند الفحوصات اللاحقة لأن الحالة ستعود 1 أعلاه.
    $updateStmt = $conn->prepare("UPDATE `$tableName` SET act = 1, ActDate = NOW() WHERE scode = ? AND (act = 0 OR act IS NULL)");
    $updateStmt->execute([Corr($scode)]);

    // في حال فحصين متزامنين، الفحص الذي نجح في التحديث الأول فقط يُعد تفعيلًا أوليًا.
    $status = $updateStmt->rowCount() === 1 ? 2 : 1;
    if ($requestNonce) {
        $_SESSION['verify_results'][$requestNonce] = $status;
    }
    return $status;
}
?>

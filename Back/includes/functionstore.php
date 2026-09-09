<?php
function Corr($nameb) {
    $nameb = trim($nameb);
    $nameb = stripslashes($nameb);
    $nameb = htmlspecialchars($nameb, ENT_QUOTES, 'UTF-8');
    return $nameb;
}

function checkScodeStatus(PDO $conn, $scode, $tableName = 'items') {
    $stmt = $conn->prepare("SELECT act FROM `$tableName` WHERE scode = ? LIMIT 1");
    $stmt->execute([Corr($scode)]);
    $row = $stmt->fetch();
    
    // إذا لم يتم العثور على القيد
    if (!$row) {
        return 0;
    }
    
    // إذا كان الحقل act يساوي 1
    if ($row['act'] == 1) {
        return 1;
    }
    
    // إذا كان الحقل act يساوي 0، نقوم بتحديثه إلى 1 ثم نعيد 2
    $updateStmt = $conn->prepare("UPDATE `$tableName` SET act = 1 WHERE scode = ?");
    $updateStmt->execute([Corr($scode)]);
    
    return 2;
}
?>
<?php
function HeadHtml() {
    echo '<!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/search/css/style4.css">
        <title>فحص المنتج</title>
    </head>
    <body>
        <header>
            <img src="/search/img/mig.png" alt="شعار المنتج" class="logo">
            <div class="titles">
                <h1>صفحة فحص المنتج</h1>
                <h2>للتاكد من المنتج</h2>
            </div>
        </header>';
}

function FootHtml() {
    echo '<footer>
            <br />
          </footer>
          </body></html>';
}

function render_scode_input() {
    
    // طباعة نموذج الإدخال لنفس الصفحة
    echo '<form method="POST" action="">';
    echo '<label for="scode">اكتب رمز التحقق: </label>';
    echo '<input type="text" id="scode" name="scode" maxlength="5" size="5" required>';
    echo '<button type="submit">إرسال</button>';
    echo '</form>';

}

function OKPage() {
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;

    echo '<main>
            <div class="form-group">
                <H2>المنتج اصلي</H2>
            </div>
          </main>';
}

function ActOKPage() {
    echo '<main class="maintenance">
            <div class="message-box">
                <h2>هذه الكود مستخدم سابقا</h2>
            </div>
          </main>';
}

function NotOKPage() {
    echo '<main class="maintenance">
            <div class="message-box">
                <h2>المنتج غير اصلي</h2>
            </div>
          </main>';
}

?>
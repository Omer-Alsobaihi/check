<?php
function HeadHtml() {
    echo '<!doctype html><html lang="ar" dir="rtl"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content="نظام التحقق من أصالة منتجات Golden Maxi+"><title>التحقق من أصالة المنتج | Golden Maxi+</title><link rel="stylesheet" href="css/style.css"></head><body><header class="topbar"><div class="wrap topbar-inner"><div class="brand"><small>GOLDEN</small><b>maxi<span>+</span></b><em>PLUS</em></div><div class="tagline"><small>عطر للشعر</small><strong>نعومة أكثر · لمعان يدوم</strong></div><span class="lang">◉ العربية⌄</span></div></header><main>';
}

function FootHtml() {
    $year = date('Y');
    echo '</main><footer><div class="rights">جميع الحقوق محفوظة © ' . $year . '</div></footer><script src="js/script.js"></script></body></html>';
}

function render_scode_input() {
    $value = isset($_POST['scode']) ? htmlspecialchars($_POST['scode'], ENT_QUOTES, 'UTF-8') : '';
    $count = strlen($value);
    $inputValue = isset($_POST['scode']) ? '' : $value;
    $inputCount = isset($_POST['scode']) ? 0 : $count;
    $slots = '';
    for ($i = 0; $i < 5; $i++) {
        $char = isset($value[$i]) ? htmlspecialchars($value[$i], ENT_QUOTES, 'UTF-8') : '·';
        $filled = isset($value[$i]) && $value[$i] !== '' ? ' filled' : '';
        $slots .= '<i class="' . $filled . '">' . $char . '</i>';
    }

    $nonce = htmlspecialchars((string)($_SESSION['verify_nonce'] ?? bin2hex(random_bytes(16))), ENT_QUOTES, 'UTF-8');
    $inputValue = htmlspecialchars($inputValue, ENT_QUOTES, 'UTF-8');
    echo '<section class="hero"><div class="wrap hero-grid"><div class="product-visual"><img src="img/hero-product.jpg" alt="منتج Golden Maxi+ Caviar with Collagen"><span class="visual-pill">✦ تركيبة مطوّرة</span><span class="visual-note note-one">CAVIAR <i>with</i> COLLAGEN</span><span class="visual-note note-two">لمعان أكثر<br>نعومة ولمعان</span></div><section class="verify-card"><div class="eyebrow">◈ نظام التحقق الرسمي</div><h1>التحقق من أصالة المنتج</h1><p>أدخل رمز الأمان الموجود تحت طبقة الخدش على عبوتك للتحقق من صحة المنتج.</p><form method="post" action="" id="verifyForm"><input type="hidden" name="verify_nonce" value="' . $nonce . '"><label for="scode">رمز الأمان <small>5 أحرف وأرقام</small></label><div class="input-wrap"><span>◈</span><input id="scode" name="scode" maxlength="5" autocomplete="off" placeholder="مثال: K7P49" value="' . $inputValue . '" dir="ltr" required><small id="count">' . $inputCount . '/5</small></div><div class="slots">' . $slots . '</div><small class="hint">استخدم الأحرف الإنجليزية والأرقام فقط</small><button class="primary" type="submit">تحقق الآن <b>←</b></button></form><button class="help" type="button" onclick="document.getElementById(\'steps\').scrollIntoView({behavior:\'smooth\'})">ⓘ أين أجد رمز الأمان؟ ↖</button>';
}

function resultProduct() {
    return '<div class="mini-product"><img src="img/product-mini.jpg" alt="Golden Maxi+"><span>GOLDEN MAXI+ PLUS<br><small>Caviar with Collagen<br>Hair Perfume · 200 mL</small></span></div>';
}

function OKPage() {
    echo '<div class="result success"><strong>✓ مبروك، المنتج أصلي</strong>لقد حصلت على المنتج بالتركيبة المطوّرة من Golden Maxi+.' . resultProduct() . '</div>';
    render_info_sections();
}

function ActOKPage() {
    echo '<div class="result warning"><strong>! تنبيه مهم</strong>تم استخدام رمز الأمان هذا سابقًا. إذا اشتريت المنتج حديثًا، يرجى التأكد من مصدر الشراء.' . resultProduct() . '</div>';
    render_info_sections();
}

function NotOKPage() {
    echo '<div class="result error"><strong>✕ الرمز غير صحيح</strong>الرمز الذي أدخلته غير مسجل في نظام التحقق. تأكد من إدخال الحروف والأرقام بشكل صحيح.</div>';
    render_info_sections();
}

function render_info_sections() {
    echo '</section></div></section><section id="steps" class="steps"><div class="wrap"><div class="section-head"><div><small>دليل سريع</small><h2>طريقة العثور على رمز الأمان</h2></div><p>تحقق من أصالة منتجك خلال ثوانٍ باتباع الخطوات الثلاث.</p></div><div class="cards three"><article class="step"><b class="num">01</b><img src="img/scratch-card.jpg" alt="ملصق رمز الأمان"><small>ابحث على العبوة</small><h3>حدد ملصق رمز الأمان</h3><p>ستجد الملصق الفضي أسفل عبارة SCRATCH HERE على العبوة.</p></article><article class="step"><b class="num">02</b><img src="img/scratch-code.jpg" alt="الرمز الظاهر بعد كشط الطبقة الفضية"><small>اكشف الطبقة</small><h3>اكشط الطبقة الفضية</h3><p>استخدم طرفًا ناعمًا لكشف الرمز المطبوع دون إتلاف الحروف.</p></article><article class="step"><b class="num">03</b><div class="code-preview"><small>SECURITY CODE</small><strong>K7P49</strong><small>5 CHARACTERS</small></div><small>أدخل الرمز</small><h3>اكتب الرمز الظاهر لك</h3><p>أدخل الحروف والأرقام الخمسة ثم اضغط تحقق الآن.</p></article></div></div></section><section class="results"><div class="wrap"><div class="section-head"><div><small>نتائج الفحص</small><h2>نتائج التحقق الممكنة</h2></div><p>تعرّف على معنى كل نتيجة تظهر بعد إدخال رمز الأمان.</p></div><div class="cards three"><article class="result-card valid"><i>✓</i><h3>مبروك</h3><strong>لقد حصلت على المنتج<br>بالتركيبة المطوّرة.</strong>' . resultProduct() . '<em>✦ تركيبة مطوّرة</em></article><article class="result-card used"><i>!</i><h3>تنبيه</h3><strong>تم استخدام رمز الأمان هذا<br>سابقًا.</strong><p>إذا اشتريت المنتج على أنه جديد، يرجى التأكد من مصدر الشراء.</p>' . resultProduct() . '</article><article class="result-card invalid"><i>×</i><h3>رمز غير صحيح</h3><strong>الرمز الذي أدخلته غير مسجل<br>في نظام التحقق.</strong><p>يرجى التأكد من إدخال جميع الأحرف والأرقام بشكل صحيح.</p><button type="button" onclick="document.getElementById(\'scode\').focus()">↻ إعادة المحاولة</button></article></div></div></section>';
}
?>

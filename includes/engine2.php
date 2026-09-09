<?php
function HeadHtml() {
    echo '<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فحص المنتج - التحقق من الأصالة</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Tajawal", sans-serif;
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
        }

        .bg-shapes {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .bg-shapes .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 8s ease-in-out infinite;
        }

        .shape-1 { width: 400px; height: 400px; background: #667eea; top: -100px; right: -100px; animation-delay: 0s; }
        .shape-2 { width: 300px; height: 300px; background: #764ba2; bottom: -50px; left: -50px; animation-delay: 2s; }
        .shape-3 { width: 250px; height: 250px; background: #f093fb; top: 40%; left: 30%; animation-delay: 4s; opacity: 0.2; }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.1); }
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 520px;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 50px 40px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            text-align: center;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo-wrapper {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4); }
            50% { box-shadow: 0 10px 40px rgba(102, 126, 234, 0.7); }
        }

        .logo-wrapper svg {
            width: 50px;
            height: 50px;
            fill: white;
        }

        h1 {
            color: #fff;
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1rem;
            margin-bottom: 35px;
            font-weight: 400;
        }

        .code-inputs {
            display: flex;
            gap: 10px;
            justify-content: center;
            direction: ltr;
            margin-bottom: 25px;
        }

        .code-inputs input {
            width: 56px;
            height: 64px;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            color: #fff;
            font-size: 1.6rem;
            font-weight: 700;
            text-align: center;
            font-family: "Tajawal", sans-serif;
            transition: all 0.3s ease;
            outline: none;
        }

        .code-inputs input:focus {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.15);
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
            transform: translateY(-2px);
        }

        .code-inputs input.filled {
            border-color: #48bb78;
            background: rgba(72, 187, 120, 0.15);
        }

        .btn-verify {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 14px;
            color: white;
            font-size: 1.1rem;
            font-weight: 700;
            font-family: "Tajawal", sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
        }

        .btn-verify:active {
            transform: translateY(0);
        }

        .btn-verify::after {
            content: "";
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-verify:hover::after {
            left: 100%;
        }

        .result-box {
            margin-top: 25px;
            padding: 20px;
            border-radius: 16px;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .result-success {
            background: rgba(72, 187, 120, 0.15);
            border: 1px solid rgba(72, 187, 120, 0.3);
            color: #68d391;
        }

        .result-error {
            background: rgba(245, 101, 101, 0.15);
            border: 1px solid rgba(245, 101, 101, 0.3);
            color: #fc8181;
        }

        .result-warning {
            background: rgba(237, 137, 54, 0.15);
            border: 1px solid rgba(237, 137, 54, 0.3);
            color: #f6ad55;
        }

        .result-box h3 {
            font-size: 1.2rem;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .result-box p {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .result-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .footer-text {
            margin-top: 30px;
            color: rgba(255, 255, 255, 0.3);
            font-size: 0.8rem;
        }

        .loader {
            display: none;
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        .btn-verify.loading .btn-text { display: none; }
        .btn-verify.loading .loader { display: block; }

        @media (max-width: 480px) {
            .card { padding: 35px 25px; }
            h1 { font-size: 1.5rem; }
            .code-inputs input { width: 48px; height: 56px; font-size: 1.4rem; }
        }
    </style>
</head>
<body>
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    <div class="container">
        <div class="card">';
}

function FootHtml() {
    $year = date('Y');
    echo "            <p class=\"footer-text\">&copy; $year نظام التحقق من المنتجات</p>
        </div>
    </div>
    <script>
        const inputs = document.querySelectorAll('.code-inputs input');
        const hiddenInput = document.getElementById('scode');
        const btn = document.getElementById('verifyBtn');

        function updateHidden() {
            hiddenInput.value = Array.from(inputs).map(i => i.value).join('');
        }

        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const val = e.target.value;
                if (val && /^[0-9]$/.test(val)) {
                    input.classList.add('filled');
                    updateHidden();
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    } else {
                        btn.focus();
                    }
                } else {
                    input.value = '';
                    input.classList.remove('filled');
                    updateHidden();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    inputs[index - 1].focus();
                    inputs[index - 1].classList.remove('filled');
                    updateHidden();
                }
                if (e.key === 'ArrowLeft' && index > 0) inputs[index - 1].focus();
                if (e.key === 'ArrowRight' && index < inputs.length - 1) inputs[index + 1].focus();
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const paste = e.clipboardData.getData('text').replace(/\\D/g, '').slice(0, 5);
                paste.split('').forEach((char, i) => {
                    if (inputs[i]) {
                        inputs[i].value = char;
                        inputs[i].classList.add('filled');
                    }
                });
                updateHidden();
                if (paste.length === 5) btn.focus();
                else if (inputs[paste.length]) inputs[paste.length].focus();
            });

            input.addEventListener('focus', () => {
                input.select();
            });
        });

        document.getElementById('verifyForm').addEventListener('submit', function(e) {
            updateHidden();
            const code = hiddenInput.value;
            if (code.length !== 5) {
                e.preventDefault();
                alert('يرجى إدخال جميع الأرقام الخمسة');
                inputs[0].focus();
                return false;
            }
            btn.classList.add('loading');
        });

        window.addEventListener('DOMContentLoaded', () => {
            inputs[0].focus();
        });
    </script>
</body>
</html>";
}

function render_scode_input() {
    echo '<div class="logo-wrapper">
        <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
    </div>
    <h1>فحص المنتج</h1>
    <p class="subtitle">أدخل رمز التحقق المكون من 5 أرقام للتأكد من أصالة المنتج</p>
    <form id="verifyForm" method="POST" action="">
        <div class="code-inputs" id="codeInputs">
            <input type="text" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="text" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="text" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="text" maxlength="1" inputmode="numeric" autocomplete="off">
            <input type="text" maxlength="1" inputmode="numeric" autocomplete="off">
        </div>
        <input type="hidden" id="scode" name="scode" value="">
        <button type="submit" class="btn-verify" id="verifyBtn">
            <span class="btn-text">التحقق من المنتج</span>
            <div class="loader"></div>
        </button>
    </form>';
}

function OKPage() {
    echo '<div class="result-box result-success">
        <div class="result-icon">&#9989;</div>
        <h3>المنتج أصلي</h3>
        <p>تهانينا! المنتج أصلي ومسجل في نظامنا. يمكنك استخدامه بثقة.</p>
    </div>';
}

function ActOKPage() {
    echo '<div class="result-box result-warning">
        <div class="result-icon">&#9888;&#65039;</div>
        <h3>هذا الرمز مستخدم سابقاً</h3>
        <p>عذراً، تم استخدام هذا الرمز من قبل. يرجى التواصل مع الدعم.</p>
    </div>';
}

function NotOKPage() {
    echo '<div class="result-box result-error">
        <div class="result-icon">&#10060;</div>
        <h3>المنتج غير أصلي</h3>
        <p>لم يتم العثور على هذا الرمز في قاعدة بياناتنا. قد يكون المنتج مزيفاً.</p>
    </div>';
}
?>


function isvalid(){
    var name   = document.form.user.value;
    var mother = document.form.mother.value;
    var birth  = document.form.birth.value;

    if(name.length < 8 && mother.length < 5 && birth.length < 4){
        alert("الرجاءادخال الاسم الثلاثي و اسم الام الثنائي و سنة المواليد");
        return false;
    } else if(name.length < 8){
        alert("الرجاء ادخال الاسم الثلاثي");
        return false;
    } else if(mother.length < 5){
        alert("الرجاء ادخال اسم الام الثنائي");
        return false;
    } else if(birth.length < 4){
        alert("الرجاء ادخال سنةالميلاد");
        return false;
    }
}

function voice(tagid){
    var recognition = new webkitSpeechRecognition();
    recognition.lang="ar";

    recognition.onresult = function(event){
        console.log(event);
        document.getElementById(tagid).value = event.results[0][0].transcript;
    }
    recognition.start();
}


function loadQadha() {
    var p_code = document.getElementById("province").value;
    if (p_code) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_data.php?action=get_qadha&p_code=" + encodeURIComponent(p_code), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("qadha").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    } else {
        document.getElementById("qadha").innerHTML = "<option value=''>اختر القضاء</option>";
    }
    document.getElementById("nahea").innerHTML = "<option value=''>اختر الناحية</option>";
}

function loadNahea() {
    var q_code = document.getElementById("qadha").value;
    if (q_code) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_data.php?action=get_nahea&q_code=" + encodeURIComponent(q_code), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("nahea").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    } else {
        document.getElementById("nahea").innerHTML = "<option value=''>اختر الناحية</option>";
    }
}

// Function to set values for multiple text input fields
function setInputValues(inputValues) {
    for (const [id, value] of Object.entries(inputValues)) {
        const inputElement = document.getElementById(id);
        if (inputElement) {
            inputElement.value = value;
        }
    }
}
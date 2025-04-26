function getCookie(name) {
    let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) return match[2];
    return null;
}
function setCookie(name, value, days) {
    let date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    let expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function changeStylesheet(mode) {
    let link = document.getElementById('theme-stylesheet');
    if (mode === 'sombre') {
        link.href = '../fichier_css/variables_sombre.css';
    } else {
        link.href = '../fichier_css/variables_clair.css';
    }
}
function change_image(mode) {
    let favori = document.getElementById('favori');
    let people = document.getElementById('people');
    let info = document.getElementById('info');
    let logo = document.getElementById('logo');
    
    if (favori && people && info) {
        if (mode === 'sombre') {
            favori.src = '../Image/image_icône/favori.png';
            people.src = '../Image/image_icône/people.png';
            info.src = '../Image/image_icône/info.png';
            logo.src = '../Image/image_icône/Passport_logo.png';
        } else {
            favori.src = '../Image/image_icône/favori_mode_clair.png';
            people.src = '../Image/image_icône/people_mode_clair.png';
            info.src = '../Image/image_icône/info_mode_clair.png';
            logo.src = '../Image/image_icône/Passport_logo_mode_clair.png';
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const modeToggle = document.getElementById('mode-toggle');
    
    if (getCookie('mode_sombre') === 'true') {
        changeStylesheet('sombre');
        change_image('sombre')
        modeToggle.src = '../Image/image_icône/mode_sombre.png';
    } else {
        changeStylesheet('clair');
        change_image('clair')
        modeToggle.src = '../Image/image_icône/mode_clair.png';
    }

    modeToggle.addEventListener('click', function () {
        if (document.body.classList.contains('sombre')) {
            setCookie('mode_sombre', 'false', 30);
            changeStylesheet('clair');
            change_image('clair')
    
            modeToggle.src = '../Image/image_icône/mode_clair.png';
            document.body.classList.remove('sombre');
        } else {
            setCookie('mode_sombre', 'true', 30);
            changeStylesheet('sombre');
            change_image('sombre')
            modeToggle.src = '../Image/image_icône/mode_sombre.png';
            document.body.classList.add('sombre');
        }
    });
});

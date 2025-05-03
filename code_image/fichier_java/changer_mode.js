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
    } else if (mode === 'clair') {
        link.href = '../fichier_css/variables_clair.css';
    } else if (mode === 'fifou') {
        link.href = '../fichier_css/variables_fifou.css';
    }
}

function change_image(mode) {
    let favori = document.getElementById('favori');
    let people = document.getElementById('people');
    let info = document.getElementById('info');
    let logo = document.getElementById('logo');
    let backgroundVideo = document.getElementById('background-video');
    let backgroundImage = document.getElementById('background-image');
    
    if (logo) {
        if (mode === 'sombre') {
            logo.src = '../Image/image_icône/Passport_logo.png';
        } else if (mode === 'clair') {
            logo.src = '../Image/image_icône/Passport_logo_mode_clair.png';
        } else if (mode === 'fifou') {
            logo.src = '../Image/image_icône/Passport_logo_mode_fifou.png';
        }
    }

    if (favori && people && info) {
        if (mode === 'sombre') {
            favori.src = '../Image/image_icône/panier.png';
            people.src = '../Image/image_icône/people.png';
            info.src = '../Image/image_icône/info.png';
        } else if (mode === 'clair') {
            favori.src = '../Image/image_icône/panier_mode_clair.png';
            people.src = '../Image/image_icône/people_mode_clair.png';
            info.src = '../Image/image_icône/info_mode_clair.png';
        } else if (mode === 'fifou') {
            favori.src = '../Image/image_icône/panier_mode_fifou.png';
            people.src = '../Image/image_icône/people_mode_fifou.png';
            info.src = '../Image/image_icône/info_mode_fifou.png';
        }
    }
    if (mode === 'fifou') {
        if (backgroundVideo) backgroundVideo.style.display = 'none';
        if (backgroundImage) backgroundImage.style.display = 'block';
    } else {
        if (backgroundVideo) backgroundVideo.style.display = 'block';
        if (backgroundImage) backgroundImage.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const modeToggle = document.getElementById('mode-toggle');
    if (getCookie('mode_sombre') === 'true') {
        changeStylesheet('sombre');
        change_image('sombre');
        modeToggle.src = '../Image/image_icône/mode_sombre.png';
        document.body.classList.add('sombre');
    } else if (getCookie('mode_fifou') === 'true') {
        changeStylesheet('fifou');
        change_image('fifou');
        modeToggle.src = '../Image/image_icône/mode_fifou.png';
        document.body.classList.add('fifou');
    } else if (getCookie('mode_clair') === 'true') {
        changeStylesheet('clair');
        change_image('clair');
        modeToggle.src = '../Image/image_icône/mode_clair.png';
        document.body.classList.add('clair');
    } else {
        changeStylesheet('sombre');
        change_image('sombre');
        modeToggle.src = '../Image/image_icône/mode_sombre.png';
        document.body.classList.add('sombre');
        setCookie('mode_sombre', 'true', 30);
    }

    modeToggle.addEventListener('click', function () {
        if (document.body.classList.contains('sombre')) {
            setCookie('mode_sombre', 'false', 30);
            setCookie('mode_clair', 'false', 30);
            setCookie('mode_fifou', 'false', 30);
            changeStylesheet('clair');
            change_image('clair');
            modeToggle.src = '../Image/image_icône/mode_clair.png';
            document.body.classList.remove('sombre');
            document.body.classList.add('clair');
            setCookie('mode_clair', 'true', 30);
        } else if (document.body.classList.contains('clair')) {
            setCookie('mode_sombre', 'false', 30);
            setCookie('mode_fifou', 'false', 30);
            changeStylesheet('fifou');
            change_image('fifou');
            modeToggle.src = '../Image/image_icône/mode_fifou.png';
            document.body.classList.remove('clair');
            document.body.classList.add('fifou');
            setCookie('mode_fifou', 'true', 30);
        } else if (document.body.classList.contains('fifou')) {
            setCookie('mode_fifou', 'false', 30);
            setCookie('mode_clair', 'false', 30);
            changeStylesheet('sombre');
            change_image('sombre');
            modeToggle.src = '../Image/image_icône/mode_sombre.png';
            document.body.classList.remove('fifou');
            document.body.classList.add('sombre');
            setCookie('mode_sombre', 'true', 30);
        }
    });
});
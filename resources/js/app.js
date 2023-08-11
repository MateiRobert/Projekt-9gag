import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


function previewAvatar(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('avatar-preview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
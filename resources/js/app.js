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

document.addEventListener('DOMContentLoaded', function() {
    let upvotes = document.querySelectorAll("[id^='upvote-']");
    let downvotes = document.querySelectorAll("[id^='downvote-']");

    upvotes.forEach(button => {
        button.addEventListener('click', function() {
            let downvoteButton = document.getElementById('downvote-' + button.id.split('-')[1]);
            button.querySelector('svg').classList.toggle('text-blue-500');
            downvoteButton.querySelector('svg').classList.remove('text-red-500');
        });
    });

    downvotes.forEach(button => {
        button.addEventListener('click', function() {
            let upvoteButton = document.getElementById('upvote-' + button.id.split('-')[1]);
            button.querySelector('svg').classList.toggle('text-red-500');
            upvoteButton.querySelector('svg').classList.remove('text-blue-500');
        });
    });
});

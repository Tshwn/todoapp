import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const toggleFormBtn = document.getElementById('toggleFormBtn');

const inputFormContainer = document.getElementById('inputFormContainer');
toggleFormBtn.addEventListener('click', function() {
    inputFormContainer.classList.toggle('open');
});

// toggleFormBtn.addEventListener('click', function() {
//   const inputForm = document.getElementById('inputForm');
//     inputForm.classList.toggle('hidden');
// });

// document.addEventListener('click', function(event) {
//     if (!inputForm.contains(event.target) && !toggleFormBtn.contains(event.target)) {
//       inputForm.classList.add('hidden');
//     }
//   });
import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const toggleFormBtn = document.getElementById('toggleFormBtn');

const inputFormContainer = document.getElementById('inputFormContainer');
toggleFormBtn.addEventListener('click', function() {
    inputFormContainer.classList.toggle('open');
});

document.addEventListener('click', function(event) {
    if (!inputForm.contains(event.target) && !toggleFormBtn.contains(event.target)) {
      inputFormContainer.classList.remove('open');
    }
  });

const tasksToday_btn = document.getElementById('tasks-today_btn');
const tasksTomorrow_btn = document.getElementById('tasks-tomorrow_btn');
const tasksThisWeek_btn = document.getElementById('tasks-thisWeek_btn');
const tasksToday = document.getElementById('tasks-today');
const tasksTomorrow = document.getElementById('tasks-tomorrow');
const tasksThisWeek = document.getElementById('tasks-thisWeek');

tasksToday_btn.addEventListener('click', function() {
        tasksToday.classList.remove('hidden');
        tasksTomorrow.classList.add('hidden');
        tasksThisWeek.classList.add('hidden');
});

tasksTomorrow_btn.addEventListener('click', function() {
        tasksToday.classList.add('hidden');
        tasksTomorrow.classList.remove('hidden');
        tasksThisWeek.classList.add('hidden');
});

tasksThisWeek_btn.addEventListener('click', function() {
    tasksToday.classList.add('hidden');
    tasksTomorrow.classList.add('hidden');
    tasksThisWeek.classList.remove('hidden');
});
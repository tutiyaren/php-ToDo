
const taskList = document.querySelectorAll('.task-list');

taskList.forEach(task => {
  task.addEventListener('click', () => {
    task.classList.toggle('task-target');
  });
});

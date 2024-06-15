
const openModel = document.querySelector('.open-modal');
const dialogModal = document.querySelector('.dialog');
const { body } = document;
const MODAL_CLASS = "is_modal";

openModel.addEventListener('click', () => {
  body.classList.add(MODAL_CLASS);
  dialogModal.showModal();
});

dialogModal.addEventListener('cancel', () => {
  body.classList.remove(MODAL_CLASS);
});

dialogModal.addEventListener('click', (event) => {
  if (!event.target.closest('.dialog-inner')) {
    body.classList.remove(MODAL_CLASS);
    dialogModal.close();
  }
});

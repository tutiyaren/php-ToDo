
const scrollMessage = document.querySelector('.scroll-message');
window.addEventListener('scroll', () => {
  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight){
    scrollMessage.style.display = 'block';
  } else {
    scrollMessage.style.display = 'none';
  }
});

const btn = document.createElement('button');
btn.className = 'to-top';
btn.type = 'button';
btn.textContent = '↑';
btn.title = 'Наверх';
document.body.appendChild(btn);

window.addEventListener('scroll', () => {
    btn.classList.toggle('visible', window.scrollY > 300);
});

btn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
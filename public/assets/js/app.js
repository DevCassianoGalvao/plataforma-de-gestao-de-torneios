const root=document.documentElement;
const stored=localStorage.getItem('theme'); if(stored) root.dataset.theme=stored;
document.querySelectorAll('[data-theme-toggle]').forEach(button=>button.addEventListener('click',()=>{const next=root.dataset.theme==='dark'?'light':'dark';root.dataset.theme=next;localStorage.setItem('theme',next)}));
document.querySelectorAll('[data-confirm]').forEach(form=>form.addEventListener('submit',event=>{if(!window.confirm(form.dataset.confirm)) event.preventDefault()}));

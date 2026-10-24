(function(){
  var b=document.querySelector('.burger'), m=document.getElementById('menu-principal');
  if(!b||!m) return;
  b.addEventListener('click',function(){ var open=m.classList.toggle('open'); b.setAttribute('aria-expanded',String(open)); document.body.style.overflow=open?'hidden':''; });
  m.querySelectorAll('a').forEach(function(a){ a.addEventListener('click',function(){ m.classList.remove('open'); b.setAttribute('aria-expanded','false'); document.body.style.overflow=''; }); });
})();

// Suivi des envois de formulaire et des clics de contact dans Google Analytics (si gtag est présent).
(function(){
  function track(name, params){ if (typeof window.gtag === 'function') { window.gtag('event', name, params || {}); } }
  document.addEventListener('wpcf7mailsent', function(){ track('generate_lead', {method:'formulaire_contact'}); });
  document.querySelectorAll('a[href^="https://wa.me/"]').forEach(function(a){ a.addEventListener('click', function(){ track('contact_whatsapp'); }); });
  document.querySelectorAll('a[href^="mailto:"]').forEach(function(a){ a.addEventListener('click', function(){ track('contact_email'); }); });
  document.querySelectorAll('a[href^="tel:"]').forEach(function(a){ a.addEventListener('click', function(){ track('contact_telephone'); }); });
})();

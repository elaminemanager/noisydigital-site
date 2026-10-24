(function(){
  var b=document.querySelector('.burger'), m=document.getElementById('menu-principal');
  if(!b||!m) return;
  b.addEventListener('click',function(){ var open=m.classList.toggle('open'); b.setAttribute('aria-expanded',String(open)); document.body.style.overflow=open?'hidden':''; });
  m.querySelectorAll('a').forEach(function(a){ a.addEventListener('click',function(){ m.classList.remove('open'); b.setAttribute('aria-expanded','false'); document.body.style.overflow=''; }); });
})();

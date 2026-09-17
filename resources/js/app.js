import './bootstrap';
import Alpine from 'alpinejs';
import 'trix';
import 'trix/dist/trix.css';

window.Alpine = Alpine;
Alpine.data('siteApp', () => ({
    menuOpen:false, scrolled:false, submitting:false, formMessage:'', formError:false,
    lightbox:{open:false,src:'',caption:''},
    init(){ this.scrolled=window.scrollY>20; window.addEventListener('scroll',()=>this.scrolled=window.scrollY>20,{passive:true}); const observer=new IntersectionObserver(entries=>entries.forEach(entry=>entry.isIntersecting&&entry.target.classList.add('is-visible')),{threshold:.12}); document.querySelectorAll('[data-reveal]').forEach(el=>observer.observe(el)); },
    openLightbox(src,caption){this.lightbox={open:true,src,caption}},
    async submitForm(event){ this.submitting=true; this.formMessage=''; this.formError=false; try { const response=await window.axios.post('/contact',new FormData(event.target)); this.formMessage=response.data.message; event.target.reset(); } catch(error){ this.formError=true; const errors=error.response?.data?.errors; this.formMessage=errors ? Object.values(errors).flat()[0] : 'We could not send your enquiry. Please try again or email us directly.'; } finally { this.submitting=false; } }
}));
Alpine.start();

jQuery(document).ready(function(){
    let mainHeader  = document.querySelector('#main-header');
    if(window.pageYOffset > 150) mainHeader.classList.add('main-header-top');
    let callToActionComponent  = document.querySelector('.call-to-action-comp');
    window.addEventListener('scroll',function(){
        // callToActionComponent.style.transform = 'translate('+window.pageYOffset/10+'px)';
        if(!!callToActionComponent){
            callToActionComponent.style.transform = 'translateY(-'+window.pageYOffset/10+'px)';
        }
        if(window.pageYOffset > 150){
            mainHeader.classList.add('main-header-top');
        }else{
            mainHeader.classList.remove('main-header-top');
        }
    })
    jQuery('.offer-owl-carousel').owlCarousel({
        nav:true
    });
})
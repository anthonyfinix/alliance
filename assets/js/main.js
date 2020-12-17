jQuery(document).ready(function(){
    let mainHeader  = document.querySelector('#main-header');
    let callToActionComponent  = document.querySelector('.call-to-action-comp');
    window.addEventListener('scroll',function(){
        // callToActionComponent.style.transform = 'translate('+window.pageYOffset/10+'px)';
        if(!!callToActionComponent){
            console.log(callToActionComponent.style.transform = 'translateY(-'+window.pageYOffset/10+'px)');
        }
        if(window.pageYOffset > 150){
            mainHeader.classList.add('main-header-top');
        }else{
            mainHeader.classList.remove('main-header-top');
        }
    })
    $('.offer-owl-carousel').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
})
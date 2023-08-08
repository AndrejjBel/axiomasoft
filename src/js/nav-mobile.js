const menuMobile = () => {
    const mobileToggle = document.querySelector('.menu-toggle')
    const navWrapper = document.querySelector('.main-navigation')
    const topMenuClouse = document.querySelector('.menu-clouse')
    const overlay = document.querySelector('.js-overlay-modal')
    const body = document.querySelector('body')

    mobileToggle.addEventListener('click', () => {
        overlay.classList.add('active')
        navWrapper.style.display = 'block'
        body.style.overflow = 'hidden'
    })

    topMenuClouse.addEventListener('click', () => {
        overlay.classList.remove('active')
        navWrapper.style.display = ''
        body.style.overflow = ''
    })

    document.body.addEventListener('keyup', function (e) {
        var key = e.keyCode;

        if (key == 27) {
            overlay.classList.remove('active')
            navWrapper.style.display = ''
            body.style.overflow = ''
        };

    }, false);


     if ( overlay ) {
        overlay.addEventListener('click', function() {
            overlay.classList.remove('active')
            navWrapper.style.display = ''
            body.style.overflow = ''
        });
    }

    // liItemsHasChildren.forEach((item) => {
    //     item.addEventListener('click', function() {
    //         if ( window.innerWidth <= 991 ) {
    //             item.children[1].classList.toggle('active')
    //             item.children[2].classList.toggle('active')
    //         }
    //     })
    // });

}
menuMobile()

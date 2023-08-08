const imgBackResize = () => {
    const imgFront = document.querySelectorAll('.featured__content__card__img.front')
    if ( imgFront.length > 0 ) {
        imgFront.forEach((item) => {
            item.nextElementSibling.style.height = item.clientHeight+'px'
        });

        window.addEventListener('resize', (e) => {
            imgFront.forEach((item) => {
                item.nextElementSibling.style.height = item.clientHeight+'px'
            });
        });
    }
}
imgBackResize()

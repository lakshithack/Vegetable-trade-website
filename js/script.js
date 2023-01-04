
//Header//
let shoppingCart = document.querySelector('.shopping-cart');
                document.querySelector('#cart-btn').onclick = () =>{
                shoppingCart.classList.toggle('active');
                searchForm.classList.remove('active');
                loginForm.classList.remove('active');
                navBar.classList.remove('active');
                }

            let searchForm = document.querySelector('.search-form');
                document.querySelector('#search-btn').onclick = () =>{
                searchForm.classList.toggle('active');
                shoppingCart.classList.remove('active');
                loginForm.classList.remove('active');
                navBar.classList.remove('active');
                }

            let loginForm = document.querySelector('.login-form');
                document.querySelector('#login-btn').onclick = () =>{
                loginForm.classList.toggle('active');
                shoppingCart.classList.remove('active');
                searchForm.classList.remove('active');
                navBar.classList.remove('active');
                }

            let navBar = document.querySelector('.navbar-mobile');
                document.querySelector('#menu-btn').onclick = () =>{
                navBar.classList.toggle('active');
                shoppingCart.classList.remove('active');
                searchForm.classList.remove('active');
                loginForm.classList.remove('active');
                }


            var swiper = new Swiper(".product-slider", {
                loop:true,
                spaceBetween: 20,
                autoplay: {
                    delay: 7500,
                    disableOnInteraction: false,
                },
                centeredSlides: true,
                breakpoints: {
                  0: {
                    slidesPerView: 1,
                  },
                  768: {
                    slidesPerView: 2,
                  },
                  1020: {
                    slidesPerView: 3,
                  },
                },
            });

//Alert//


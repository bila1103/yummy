<section id="image-carousel" class="splide" aria-label="Carousel">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide">
                <img loading="lazy" src="https://cdn.yummy.co.id/content-images/images/20221213/254b09a957d2675142db9e9882e4f488.png?x-oss-process=image/format,webp"
                    sizes="70px" alt="img-1">
            </li>
            <li class="splide__slide">
                <img loading="lazy" src="https://cdn.yummy.co.id/content-images/images/20221213/f37b827cd7e27c7ca39c64d189a7e8c1.png?x-oss-process=image/format,webp"
                    alt="img-2">
            </li>
            <li class="splide__slide">
                <img loading="lazy" src="https://cdn.yummy.co.id/content-images/images/20230614/64b1bb2023a471c8ee9977449a9dce39.png?x-oss-process=image/format,webp"
                    alt="img-3">
            </li>

        </ul>
    </div>
</section>

@push('styles')
    <style>
        #image-carousel {
            margin-top: 300px;
            margin-bottom: 80px;
        }

        #image-carousel .splide__slide {
            transition: transform 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #image-carousel .splide__slide img {
            width: 100%;
            /* ukuran default */
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        #image-carousel .splide__pagination {
            bottom: -1.5em;
            /* geser ke bawah jika perlu */
        }

        /* Default bullet */
        #image-carousel .splide__pagination__page {
            background: #ffc107;
            /* Bootstrap warning color */
            opacity: 0.4;
            transition: opacity 0.3s, transform 0.3s;
        }

        /* Bullet aktif */
        #image-carousel .splide__pagination__page.is-active {
            opacity: 1;
            transform: scale(1.2);
            box-shadow: 0 0 0 2px #fff;
            /* Opsional: garis putih di sekeliling */
        }
    </style>
@endpush

@push('scripts')
    <script>
        let splideInstance = null;
        let isMobilePrev = null;

        function initSplide() {
            const isMobile = window.innerWidth <= 767;

            if (isMobile === isMobilePrev && splideInstance) {
                // Kalau status mobile/desktop gak berubah, skip re-init
                return;
            }
            isMobilePrev = isMobile;

            if (splideInstance) {
                splideInstance.destroy();
                splideInstance = null;
            }

            if (isMobile) {
                splideInstance = new Splide('#image-carousel', {
                    type: 'loop',
                    perPage: 1,
                    padding: '10vw',
                    autoplay: true,
                    pagination: true,
                    gap: '1em',
                    interval: 2500,
                    updateOnMove: true,
                    arrows: false,
                    heightRatio: 0.7,
                    cover: true,
                    easing: 'ease',
                });
            } else {
                splideInstance = new Splide('#image-carousel', {
                    type: 'loop',
                    rewind: true,
                    perPage: 3,
                    pagination: true,
                    arrows: false,
                    autoplay: true,
                    gap: '1em',
                });
            }

            splideInstance.mount();
        }

        initSplide();

        window.addEventListener('resize', () => {
            clearTimeout(window.resizeTimeout);
            window.resizeTimeout = setTimeout(() => {
                initSplide();
            }, 0);
        });
    </script>
@endpush

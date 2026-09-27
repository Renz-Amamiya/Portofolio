export function initParallax(gsap, ScrollTrigger) {
    const items = document.querySelectorAll('.parallax');
    if (!items.length) return;
    if (window.matchMedia('(hover: none)').matches) return;

    items.forEach((el) => {
        const img = el.querySelector('img');
        if (!img) return;

        gsap.fromTo(
            img,
            { yPercent: -6 },
            {
                yPercent: 6,
                ease: 'none',
                scrollTrigger: {
                    trigger: el,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true,
                },
            }
        );
    });
}
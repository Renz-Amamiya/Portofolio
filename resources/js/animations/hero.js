export function initHero(gsap, ScrollTrigger) {
    const section = document.querySelector('#hero-section');
    if (!section) return;

    const left = section.querySelector('[data-hero-left]');
    const right = section.querySelector('[data-hero-right]');
    const center = section.querySelector('[data-hero-center]');
    const ghost = section.querySelector('[data-hero-ghost]');
    const code = section.querySelector('[data-hero-code]');

    // Prepare initial states to prevent FOUC
    if (center) gsap.set(center, { yPercent: 50, opacity: 0 });
    if (ghost) gsap.set(ghost, { xPercent: 20, opacity: 0 });
    if (left) gsap.set(left, { x: -80, opacity: 0 });
    if (right) gsap.set(right, { x: 80, opacity: 0 });
    if (code) gsap.set(code, { opacity: 0, y: 10 });

    // --- ENTRANCE TIMELINE ---
    const tl = gsap.timeline({ 
        defaults: { ease: 'power4.out' },
        onComplete: initScrollTriggers // Only start scroll animations after entrance is done
    });

    // 1. Center photo slides up from the bottom
    if (center) tl.to(center, { yPercent: 0, opacity: 1, duration: 1.5 }, 0.2);

    // 1.5. Ghost photo slides out from behind
    if (ghost) tl.to(ghost, { xPercent: 0, opacity: 0.1, duration: 2, ease: 'power2.out' }, 0.5);

    // 2. Left side (First Name) slides in from the left
    if (left) tl.to(left, { x: 0, opacity: 1, duration: 1.2, clearProps: "x" }, 0.6);

    // 3. Right side (Coder) slides in from the right
    if (right) tl.to(right, { x: 0, opacity: 1, duration: 1.2, clearProps: "x" }, 0.6);

    // 4. Code snippet typewriter or fade in
    if (code) tl.to(code, { opacity: 0.5, y: 0, duration: 1 }, 1.2);

    // --- SCROLL-LINKED ANIMATIONS (Parallax) ---
    function initScrollTriggers() {
        if (center) {
            gsap.to(center, {
                scrollTrigger: {
                    trigger: section,
                    start: 'top top',
                    end: 'bottom top',
                    scrub: true,
                },
                // Removed yPercent: -20 so the photo stays anchored at the bottom
                opacity: 0.2, // Just fade it out slightly on scroll
            });
        }

        // Parallax pushing left
        if (left) {
            gsap.to(left, {
                scrollTrigger: {
                    trigger: section,
                    start: 'top top',
                    end: 'bottom top',
                    scrub: true,
                },
                x: -100, // Move outward on scroll
                opacity: 0,
            });
        }

        // Parallax pushing right
        if (right) {
            gsap.to(right, {
                scrollTrigger: {
                    trigger: section,
                    start: 'top top',
                    end: 'bottom top',
                    scrub: true,
                },
                x: 100, // Move outward on scroll
                opacity: 0,
            });
        }
    }
}
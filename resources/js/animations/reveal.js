export function initReveal(gsap, ScrollTrigger) {
    const items = document.querySelectorAll('[data-reveal]');
    if (!items.length) return;

    // Skip items inside #hero-section (hero has its own animation)
    items.forEach((el) => {
        if (el.closest('#hero-section')) return;

        gsap.fromTo(
            el,
            { y: 60, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 90%',
                    end: 'top 60%',
                    toggleActions: 'play none none none',
                },
            }
        );
    });

    // Staggered reveal for project rows
    const rows = document.querySelectorAll('.project-row');
    if (rows.length) {
        rows.forEach((row, i) => {
            gsap.fromTo(
                row,
                { y: 50, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.8,
                    delay: i * 0.1,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: row,
                        start: 'top 92%',
                        toggleActions: 'play none none none',
                    },
                }
            );
        });
    }

    // Section headings slide in from left
    const headings = document.querySelectorAll('section h2, section .font-mono.uppercase');
    headings.forEach((el) => {
        if (el.closest('#hero-section') || el.closest('header') || el.closest('nav')) return;

        gsap.fromTo(
            el,
            { x: -40, opacity: 0 },
            {
                x: 0,
                opacity: 1,
                duration: 0.9,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 88%',
                    toggleActions: 'play none none none',
                },
            }
        );
    });

    // Skill icons stagger entrance
    const skillIcons = document.querySelectorAll('.devicon-html5-plain, .devicon-css3-plain, .devicon-javascript-plain, .devicon-php-plain, .devicon-laravel-original, .devicon-nextjs-plain, .devicon-react-original, .devicon-tailwindcss-original, .devicon-bootstrap-plain, .devicon-supabase-plain, .devicon-figma-plain, .devicon-linux-plain, .devicon-mysql-plain, .devicon-git-plain, [class*="devicon-"]');
    if (skillIcons.length) {
        gsap.fromTo(
            skillIcons,
            { y: 40, opacity: 0, scale: 0.6 },
            {
                y: 0,
                opacity: 1,
                scale: 1,
                duration: 0.6,
                stagger: 0.05,
                ease: 'back.out(1.4)',
                scrollTrigger: {
                    trigger: skillIcons[0]?.closest('section'),
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                },
            }
        );
    }

    // Experience cards stagger
    const expCards = document.querySelectorAll('.border-t.rule.pt-5');
    if (expCards.length) {
        expCards.forEach((card, i) => {
            gsap.fromTo(
                card,
                { y: 40, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.8,
                    delay: i * 0.15,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: card,
                        start: 'top 90%',
                        toggleActions: 'play none none none',
                    },
                }
            );
        });
    }

    // Contact form slides up
    const contactForm = document.querySelector('#contact form');
    if (contactForm) {
        gsap.fromTo(
            contactForm,
            { y: 60, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: contactForm,
                    start: 'top 85%',
                    toggleActions: 'play none none none',
                },
            }
        );
    }
}
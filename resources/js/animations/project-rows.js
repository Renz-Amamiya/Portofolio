export function initProjectRows(gsap) {
    const rows = document.querySelectorAll('.project-row');
    if (!rows.length) return;
    if (window.matchMedia('(hover: none)').matches) return;

    rows.forEach((row) => {
        const title = row.querySelector('h3');
        const arrow = row.querySelector('.w-10.h-10');
        const techTags = row.querySelectorAll('.font-mono.text-\\[10px\\]');

        row.addEventListener('mouseenter', () => {
            if (title) {
                gsap.to(title, { x: 16, duration: 0.5, ease: 'power3.out' });
            }
            if (arrow) {
                gsap.to(arrow, { scale: 1.15, duration: 0.3, ease: 'power3.out' });
            }
            techTags.forEach((tag, i) => {
                gsap.to(tag, {
                    x: 16,
                    opacity: 1,
                    duration: 0.4,
                    delay: i * 0.03,
                    ease: 'power3.out'
                });
            });
        });

        row.addEventListener('mouseleave', () => {
            if (title) {
                gsap.to(title, { x: 0, duration: 0.5, ease: 'power3.out' });
            }
            if (arrow) {
                gsap.to(arrow, { scale: 1, duration: 0.3, ease: 'power3.out' });
            }
            techTags.forEach((tag) => {
                gsap.to(tag, { x: 0, duration: 0.4, ease: 'power3.out' });
            });
        });
    });
}
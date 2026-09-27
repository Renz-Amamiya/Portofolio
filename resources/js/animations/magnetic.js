export function initMagnetic(gsap) {
    const buttons = document.querySelectorAll('.magnetic');
    if (!buttons.length) return;
    if (window.matchMedia('(hover: none)').matches) return;

    buttons.forEach((btn) => {
        btn.addEventListener('mouseenter', () => {
            gsap.to(btn, { scale: 1.03, duration: 0.4, ease: 'power3.out' });
        });

        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            gsap.to(btn, {
                x: x * 0.25,
                y: y * 0.25,
                duration: 0.5,
                ease: 'power3.out',
            });
        });

        const reset = () => {
            gsap.to(btn, { x: 0, y: 0, scale: 1, duration: 0.5, ease: 'power3.out' });
        };

        btn.addEventListener('mouseleave', reset);
        btn.addEventListener('blur', reset);
    });
}
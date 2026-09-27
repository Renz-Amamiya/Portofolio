import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';
import { initHero } from './animations/hero';
import { initReveal } from './animations/reveal';
import { initMagnetic } from './animations/magnetic';
import { initParallax } from './animations/parallax';
import { initProjectRows } from './animations/project-rows';
import { initSortable } from './animations/sortable';

gsap.registerPlugin(ScrollTrigger);

export function initAnimations() {
    const lenis = new Lenis({
        duration: 1.1,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    });

    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => lenis.raf(time * 1000));
    gsap.ticker.lagSmoothing(0);

    initHero(gsap, ScrollTrigger);
    initReveal(gsap, ScrollTrigger);
    initMagnetic(gsap);
    initParallax(gsap, ScrollTrigger);
    initProjectRows(gsap);
    initSortable();
}
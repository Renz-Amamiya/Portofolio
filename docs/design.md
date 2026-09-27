# Design Direction

Reading this as: personal portfolio for a frontend developer / student audience (recruiters, collaborators), in an editorial Swiss-inspired visual language, dials ENERGY 2 / RHYTHM 3 / MOTION 2.

## Dials
- ENERGY 2 (Balanced): confident but not shouting. Large display type carries the page, no glow or noise.
- RHYTHM 3 (Varied): sections deliberately differ in composition. Asymmetric hero, list rows for projects, timeline for experience, grouped chips for skills. No repeated "centered title + card grid" pattern.
- MOTION 2 (Scroll-reveal + transitions): Lenis smooth scroll, GSAP ScrollTrigger reveals, one magnetic CTA, hover thumbnail preview on project rows. No endless loops.

## Palette (max 2 core + 1 accent, R-29)
- `--color-ink: #111111` (near-black, primary text and rules)
- `--color-paper: #FAFAF7` (warm off-white surface)
- `--color-accent: #C8553D` (terracotta, used sparingly: hover states, the "open to work" mark, one CTA)
- Neutrals: `#6B6B66` muted text, `#E5E3DD` hairline dividers.

Reason: terracotta on warm paper reads as printed-editorial, not tech-startup gradient. Ink on paper gives contrast ratio ~15:1 (R-25 pass).

## Typography (R-06)
- Display: **Instrument Serif**. Reason: high-contrast serif with character; portfolio is personal, so an editorial display face differentiates it from the default sans portfolio. Used only for headlines and large numerals.
- Body: **Inter Tight**. Reason: tight, neutral, pairs with the serif without competing; excellent small-size readability.
- Mono: **JetBrains Mono** for small labels (section indices `01`, `02`, eyebrows, dates). Reason: mono numerals stay aligned in project indices and timeline dates.

Use `font-feature-settings: "kern" 1, "liga" 1` on body; display uses `"kern" 1` only.

## Grid & Layout
- 12-column at 1200px max, 24px gutter. Mobile: single column, 20px outer padding.
- Whitespace is structural: sections separated by 96px desktop / 48px mobile.
- Project list is a stacked row list, not a card grid. Reason: a developer portfolio is a list of work, and rows let the title and year breathe while giving space for a hover thumbnail.
- Hairline dividers (1px) instead of cards and shadows (R-12: shadow only on the one element that lifts).

## Detail Motifs (identity, R-20)
- Mono section index `01 / 04` next to every section heading.
- Thin rules under each project row that thicken on hover.
- Small `◆` mark (single, deliberate accent) before the "open to work" status.
- Hover state on project rows: title shifts right, thumbnail follows cursor (desktop only).

## Icons
Lucide via inline SVG, 1.5px stroke, used only where the glyph adds information (external link, mail, github). Never decorative. Reason: one consistent set is a decision; the restraint is the point.

## Motion Rules
- Durations 0.4s to 0.9s. Easing `power3.out` / `expo.out`. Transform and opacity only.
- `prefers-reduced-motion`: all GSAP/Lenis disabled, content visible by default, only simple fades remain.
- Hero: split-text reveal per line with mask + translateY, stagger 0.08.
- No layout shift: reveal elements start at `opacity:0` only when JS is active (`.js-active` class on `<html>`), so no-JS users see content.

## Dark mode
Token-driven: `--color-paper` becomes `#14140F`, `--color-ink` becomes `#F2EFE6`. Accent stays terracotta (contrast on dark ~5.2:1). Toggle in nav, persisted to localStorage, follows system on first visit.

## Forbidden in this project
Gradient text, glassmorphism, blob shapes, purple/blue gradients, progress-bar skills, emoji icons, "passionate developer" hero copy, 3-card feature grids, stat counters with invented numbers.

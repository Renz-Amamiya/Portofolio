import './bootstrap';
import Alpine from 'alpinejs';
import { initAnimations } from './animations';

document.addEventListener('alpine:init', () => {
    Alpine.data('themeToggle', () => ({
        isDark: document.documentElement.classList.contains('dark'),
        toggle() {
            this.isDark = !this.isDark;
            document.documentElement.classList.toggle('dark', this.isDark);
            localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
        },
    }));

    Alpine.data('publishToggle', (url, published) => ({
        on: published,
        loading: false,
        async submit() {
            this.loading = true;
            const previous = this.on;
            this.on = !this.on;
            try {
                const res = await fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ published: this.on }),
                });
                if (!res.ok) throw new Error('Request failed');
            } catch (e) {
                this.on = previous;
            } finally {
                this.loading = false;
            }
        },
    }));

    Alpine.data('markdownEditor', (previewUrl) => ({
        tab: 'write',
        content: '',
        rendered: '',
        url: previewUrl,
        init() {
            const textarea = this.$el.querySelector('textarea');
            if (textarea) {
                this.content = textarea.value;
            }
        },
        async preview() {
            this.tab = 'preview';
            if (this.content === '' || this.rendered !== '') {
                return;
            }
            const res = await fetch(this.url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ content: this.content }),
            });
            const data = await res.json();
            this.rendered = data.html ?? '';
        },
    }));
});

window.Alpine = Alpine;
Alpine.start();

// Always run animations — no reduced-motion gate
document.addEventListener('DOMContentLoaded', () => initAnimations());
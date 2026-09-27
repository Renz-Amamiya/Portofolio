import Sortable from 'sortablejs';

export function initSortable() {
    document.querySelectorAll('[data-reorder-endpoint]').forEach((container) => {
        const form = document.getElementById('reorder-form');
        if (!form) return;

        Sortable.create(container, {
            handle: '.sortable-row',
            animation: 300,
            easing: 'cubic-bezier(0.16, 1, 0.3, 1)',
            onEnd: async () => {
                const rows = [...container.querySelectorAll('.sortable-row')];
                const data = new FormData();
                rows.forEach((row) => data.append('ids[]', row.dataset.id));

                try {
                    await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                        },
                        body: data,
                    });
                    toast('Order updated.');
                } catch (e) {
                    toast('Could not save order.');
                }
            },
        });
    });
}

function toast(message) {
    const el = document.createElement('div');
    el.textContent = message;
    el.className = 'fixed bottom-6 right-6 z-50 bg-[var(--color-ink)] text-[var(--color-paper)] px-5 py-3.5 font-mono text-sm shadow-lg';
    el.setAttribute('role', 'status');
    document.body.appendChild(el);
    setTimeout(() => el.remove(), 3000);
}
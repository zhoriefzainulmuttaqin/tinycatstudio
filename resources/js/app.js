import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.addEventListener('DOMContentLoaded', () => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const isCoarsePointer = window.matchMedia('(pointer: coarse)').matches || window.matchMedia('(hover: none)').matches;
    const revealElements = document.querySelectorAll('[data-reveal]');

    if (revealElements.length) {
        if (prefersReducedMotion || !('IntersectionObserver' in window)) {
            revealElements.forEach((element) => element.classList.add('is-visible'));
        } else {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (!entry.isIntersecting) {
                            return;
                        }

                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    });
                },
                {
                    threshold: 0.16,
                    rootMargin: '0px 0px -10% 0px',
                },
            );

            revealElements.forEach((element) => observer.observe(element));
        }
    }

    const serviceButtons = document.querySelectorAll('[data-service-target]');
    const serviceSelect = document.querySelector('#lead_service');

    if (serviceButtons.length && serviceSelect) {
        serviceButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const targetValue = button.getAttribute('data-service-target');

                if (!targetValue) {
                    return;
                }

                serviceSelect.value = targetValue;
                serviceSelect.dispatchEvent(new Event('change', { bubbles: true }));
            });
        });
    }

    if (prefersReducedMotion || isCoarsePointer) {
        return;
    }

    const parallaxContainers = document.querySelectorAll('[data-parallax-scene]');

    parallaxContainers.forEach((scene) => {
        const items = scene.querySelectorAll('[data-parallax]');

        if (!items.length) {
            return;
        }

        const reset = () => {
            items.forEach((item) => {
                item.style.transform = 'translate3d(0, 0, 0)';
            });
        };

        scene.addEventListener('pointermove', (event) => {
            const rect = scene.getBoundingClientRect();
            const x = (event.clientX - rect.left) / rect.width - 0.5;
            const y = (event.clientY - rect.top) / rect.height - 0.5;

            items.forEach((item) => {
                const speed = Number(item.getAttribute('data-parallax') || 18);
                const rotate = Number(item.getAttribute('data-rotate') || 0);
                const translateX = x * speed * 2;
                const translateY = y * speed * 2;
                const rotateY = x * rotate;
                const rotateX = y * -rotate;

                item.style.transform = `translate3d(${translateX}px, ${translateY}px, 0) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });
        });

        scene.addEventListener('pointerleave', reset);
    });

    const tiltCards = document.querySelectorAll('[data-tilt-card]');

    tiltCards.forEach((card) => {
        const intensity = Number(card.getAttribute('data-tilt-intensity') || 10);

        const reset = () => {
            card.style.transform = '';
            card.style.setProperty('--pointer-x', '50%');
            card.style.setProperty('--pointer-y', '50%');
        };

        card.addEventListener('pointermove', (event) => {
            const rect = card.getBoundingClientRect();
            const offsetX = (event.clientX - rect.left) / rect.width;
            const offsetY = (event.clientY - rect.top) / rect.height;
            const rotateY = (offsetX - 0.5) * intensity;
            const rotateX = (0.5 - offsetY) * intensity;

            card.style.transform = `perspective(1600px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translate3d(0, -6px, 0)`;
            card.style.setProperty('--pointer-x', `${offsetX * 100}%`);
            card.style.setProperty('--pointer-y', `${offsetY * 100}%`);
        });

        card.addEventListener('pointerleave', reset);
    });
});

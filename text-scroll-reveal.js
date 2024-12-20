const wrapCharacters = () => {
	document.querySelectorAll('.scroll-reveal > *').forEach(element => {
		if (!element.querySelector('.reveal-char')) {
			element.innerHTML = Array.from(element.textContent).map(char =>
				`<span class="reveal-char">${char}</span>`
			).join('');
		}
	});
};

const updateRevealEffect = () => {
	const triggerHeight = window.innerHeight * 0.7;

	document.querySelectorAll('.reveal-char').forEach(span => {
		const { top, left } = span.getBoundingClientRect();
		if (top < window.innerHeight && top > 0) {
			const opacityValue = 1 - Math.max(0, (top - triggerHeight) * 0.01 + left * 0.001);
			span.style.opacity = Math.min(1, Math.max(0.1, opacityValue)).toFixed(3);
		}
	});
};

let scheduledAnimationFrame = false;
const onScroll = () => {
	if (!scheduledAnimationFrame) {
		scheduledAnimationFrame = true;
		requestAnimationFrame(() => {
			updateRevealEffect();
			scheduledAnimationFrame = false;
		});
	}
};

const initRevealEffect = () => {
	wrapCharacters();
	window.addEventListener('scroll', onScroll);
	updateRevealEffect();
};

// Wait for Elementor to initialise and attach hook
const waitForElementor = () => {
	if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
		console.log('Elementor Frontend detected, attaching hooks.');

		if (elementorFrontend.isEditMode()) {
			console.log('Editor Mode: Initializing in Editor.');
			elementorFrontend.hooks.addAction('frontend/element_ready/text_scroll_reveal.default', () => {
				console.log('Widget initialized in editor.');
				initRevealEffect();
			});
		} else {
			console.log('Frontend Mode: Initializing for user.');
			initRevealEffect();
		}
	} else {
		console.log('Waiting for Elementor Frontend...');
		setTimeout(waitForElementor, 50);
	}
};

// Initialise for all cases
document.addEventListener('DOMContentLoaded', () => {
	console.log('Initializing Text Scroll Reveal');
	waitForElementor();
});

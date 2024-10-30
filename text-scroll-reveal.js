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

initRevealEffect();

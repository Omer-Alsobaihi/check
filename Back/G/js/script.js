const codeInput = document.getElementById('scode');
const count = document.getElementById('count');
const slots = [...document.querySelectorAll('.slots i')];

if (codeInput) {
  const render = () => {
    codeInput.value = codeInput.value.replace(/[^a-zA-Z0-9]/g, '').slice(0, 5).toUpperCase();
    if (count) count.textContent = `${codeInput.value.length}/5`;
    slots.forEach((slot, index) => {
      slot.textContent = codeInput.value[index] || '·';
      slot.classList.toggle('filled', Boolean(codeInput.value[index]));
    });
  };
  codeInput.addEventListener('input', render);
  render();
}

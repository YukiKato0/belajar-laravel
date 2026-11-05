function updateProductEstimate() {
  const config = window.productDetailConfig;
  const quantityInput = document.getElementById('customQtyInput');
  const totalDisplay = document.getElementById('totalPriceDisplay');

  if (!config || !quantityInput || !totalDisplay) return;

  const minimum = Number(config.minimumOrder) || 1;
  const quantity = Math.max(minimum, Number.parseInt(quantityInput.value, 10) || minimum);
  quantityInput.value = quantity;

  const material = document.querySelector('input[name="productMaterial"]:checked');
  const side = document.querySelector('input[name="productSides"]:checked');
  const materialPrice = material ? Number(material.dataset.price) : Number(config.price);
  const sidePrice = side ? Number(side.dataset.price) : 0;
  const finishPrice = Array.from(document.querySelectorAll('.finish-option:checked'))
    .reduce((total, option) => total + Number(option.dataset.price || 0), 0);
  const designService = document.getElementById('needDesignService');
  const designFee = designService?.checked ? Number(designService.dataset.price || 0) : 0;
  const subtotal = (materialPrice + sidePrice + finishPrice) * quantity + designFee;
  const discount = (config.discounts || [])
    .filter(tier => quantity >= Number(tier.minimum))
    .sort((first, second) => Number(second.minimum) - Number(first.minimum))[0];
  const discountPercent = discount ? Number(discount.percent) : 0;
  const total = Math.round(subtotal * (1 - discountPercent / 100));
  const money = amount => 'Rp ' + amount.toLocaleString('id-ID');

  totalDisplay.textContent = money(total);
  document.getElementById('pricePerBox').textContent = money(Math.round(total / quantity));
  const strikethroughPrice = document.getElementById('strikethroughPrice');
  strikethroughPrice.textContent = discountPercent ? money(subtotal) : '';
  document.getElementById('tierDiscountBadge').textContent = discountPercent
    ? 'Diskon Grosir ' + discountPercent + '%'
    : 'Harga Satuan';

  const materialName = material?.nextElementSibling?.querySelector('.fw-bold')?.textContent.trim();
  const sideName = side?.nextElementSibling?.textContent.trim();
  const finishNames = Array.from(document.querySelectorAll('.finish-option:checked'))
    .map(option => option.nextElementSibling?.textContent.trim())
    .filter(Boolean);
  const orderMessage = [
    'Halo PrimaGraphia, saya ingin memesan:',
    config.name,
    materialName ? 'Bahan: ' + materialName : null,
    sideName ? 'Sisi cetak: ' + sideName : null,
    finishNames.length ? 'Finishing: ' + finishNames.join(', ') : null,
    'Jumlah: ' + quantity + ' ' + config.priceUnit,
    'Estimasi: ' + money(total),
  ].filter(Boolean).join('\n');
  const designFile = document.getElementById('designFile')?.files?.[0];
  const message = designFile ? orderMessage + '\nFile desain: ' + designFile.name : orderMessage;
  const messageUrl = 'https://wa.me/62811987990?text=' + encodeURIComponent(message);
  document.getElementById('orderViaWhatsapp').href = messageUrl;
  document.getElementById('addToCartWhatsapp').href = 'https://wa.me/62811987990?text=' + encodeURIComponent('Mohon bantu masukkan ke keranjang pesanan saya:\n' + message);
}

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('input[name="productMaterial"], input[name="productSides"], .finish-option, #needDesignService')
    .forEach(option => option.addEventListener('change', updateProductEstimate));
  document.querySelectorAll('.quick-quantity').forEach(option => option.addEventListener('change', () => {
    document.getElementById('customQtyInput').value = option.dataset.qty;
    updateProductEstimate();
  }));
  document.getElementById('customQtyInput')?.addEventListener('input', event => {
    const input = event.currentTarget;
    const minimum = Number(input.min) || 1;
    input.value = Math.min(500, Math.max(minimum, Number.parseInt(input.value, 10) || minimum));
    syncQuickQuantity(input.value);
    updateProductEstimate();
  });
  const dropzone = document.getElementById('designDropzone');
  const fileInput = document.getElementById('designFile');
  dropzone?.addEventListener('click', event => {
    if (event.target !== fileInput) fileInput.click();
  });
  dropzone?.addEventListener('dragover', event => event.preventDefault());
  dropzone?.addEventListener('drop', event => {
    event.preventDefault();
    if (event.dataTransfer.files.length) {
      fileInput.files = event.dataTransfer.files;
      fileInput.dispatchEvent(new Event('change', { bubbles: true }));
    }
  });
  document.getElementById('designFile')?.addEventListener('change', event => {
    const file = event.target.files?.[0];
    document.getElementById('uploadLabel').textContent = file
      ? file.name + ' siap diunggah'
      : 'Tarik & lepas file desain di sini, atau klik Cari File';
    updateProductEstimate();
  });
  document.getElementById('decreaseQuantity')?.addEventListener('click', () => {
    const input = document.getElementById('customQtyInput');
    input.value = Math.max(Number(input.min), Number(input.value) - 1);
    syncQuickQuantity(input.value);
    updateProductEstimate();
  });
  document.getElementById('increaseQuantity')?.addEventListener('click', () => {
    const input = document.getElementById('customQtyInput');
    input.value = Math.min(500, Number(input.value) + 1);
    syncQuickQuantity(input.value);
    updateProductEstimate();
  });

  const preview = document.getElementById('mainCardVisual');
  document.querySelectorAll('[data-preview]').forEach(button => {
    button.addEventListener('click', () => {
      document.querySelectorAll('[data-preview]').forEach(item => item.classList.remove('active'));
      button.classList.add('active');
      if (!preview) return;

      const looks = {
        depan: ['rotate(-3deg)', 'linear-gradient(135deg,#10233f 0%,#25466e 58%,#102139 100%)'],
        belakang: ['rotate(2deg)', 'linear-gradient(135deg,#26394f 0%,#0b1524 100%)'],
        detail: ['scale(1.04)', 'radial-gradient(circle,#3e5878 0%,#0c182b 100%)'],
        kemasan: ['rotate(-1deg) scale(.96)', 'linear-gradient(135deg,#52634d 0%,#1d302d 100%)'],
      };
      const [transform, background] = looks[button.dataset.preview] || looks.depan;
      preview.style.transform = transform;
      preview.style.background = background;
    });
  });

  updateProductEstimate();
});

function syncQuickQuantity(quantity) {
  document.querySelectorAll('.quick-quantity').forEach(option => {
    option.checked = Number(option.dataset.qty) === Number(quantity);
  });
}

function loader(e) {
  const t = document.getElementById("c-backdrop");
  e ? t.classList.add("active") : t.classList.remove("active");
};

function numberFormat(number, decimals = 0, decimalSeparator = ".", thousandsSeparator = ",") {
  return new Intl.NumberFormat("en-US", {
      minimumFractionDigits: decimals,
      maximumFractionDigits: decimals,
  }).format(number).replace(".", decimalSeparator).replace(/,/g, thousandsSeparator);
}

const awnOptions = {
  position: "bottom-right",
  maxNotifications: 4,
  durations: {
      global: 5000
  },
  icons: {
      enabled: true,
      prefix: "<i class='display-5 ri-",
      suffix: "'></i>",
      success: "checkbox-circle-fill",
      alert: "error-warning-fill",
      info: "information-fill",
      warning: "error-warning-fill",
  }
}

const awn = new AWN(awnOptions);

const swalDeleteConfirmation = {
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#dc3545',
  cancelButtonColor: '#3b7ddd',
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'Cancel'
};

const windowPrint = (url) => {
  window.open(url, '_blank', 'location=yes,height=600,width=800,scrollbars=yes,status=yes');
}

function loader(e) {
  const t = document.getElementById("c-backdrop");
  e ? t.classList.add("active") : t.classList.remove("active");
};

function numberFormat(number, decimals = 0, decimalSeparator = ".", thousandsSeparator = ",") {
  return new Intl.NumberFormat("en-US", {
      minimumFractionDigits: decimals,
      maximumFractionDigits: decimals,
  }).format(number).replace(".", decimalSeparator).replace(/,/g, thousandsSeparator);
}

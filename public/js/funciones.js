function valIsEmpty(value, extra=''){
  if (value !== null && $.type(value) !== 'undefined' && $.type(value) !== 'null' && $.type(value) !== '[]')
      return ( (value.length < 1 || $.trim((value).toString()).length < 1 || value === false || value.toString() === extra) ? true : false );
  else
      return true;
}

function number_format(amount, decimals) {
  amount += '';
  amount = parseFloat(amount.replace(/[^0-9\.]/g, ''));
  decimals = decimals || 0;
  if (isNaN(amount) || amount === 0)
      return parseFloat(0).toFixed(decimals);
  amount = '' + amount.toFixed(decimals);
  var amount_parts = amount.split('.'),
      regexp = /(\d+)(\d{3})/;
  while (regexp.test(amount_parts[0]))
      amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');
  return amount_parts.join('.');
}

function swalLoading(){
    return Swal.fire({
        imageUrl: 'img/loading.gif',
        imageHeight: 100,
        text: 'CARGANDO...',
        reverseButtons: false,
        background: 'linear-gradient(90deg, #EEF2FF, #C5E3FF)',
        showConfirmButton: false,
        color: '#588ECF',
        allowOutsideClick: false,
    });
}

function swalLoading2(){
    return Swal.fire({
        imageUrl: 'img/loading.gif',
        imageHeight: 100,
        text: 'CALCULANDO...',
        reverseButtons: false,
        background: 'linear-gradient(90deg, #EEF2FF, #C5E3FF)',
        showConfirmButton: false,
        color: '#588ECF',
        allowOutsideClick: false,
    });
}

//success-warning-
function swalTimer(tipo,title,time = null){
    const backgrounds = {
        success: 'linear-gradient(90deg, #EEFFEE, #D5FFC5)',
        warning: 'linear-gradient(90deg, #FFFFEE, #F9FFC5)',
        error: 'linear-gradient(90deg, #FFEEEE, #FFC5C5)',
    }
    const iconcsCol = {
        success: '#5BCF58',
        warning: '#CFCD58',
        error: '#CF5858',
    }
    let back = backgrounds[tipo] || '#fff';
    let colorI = iconcsCol[tipo] || '#fff';

    return Swal.fire({
        icon: tipo,
        text: title,
        reverseButtons: false,
        background: back,
        showConfirmButton: false,
        iconColor: colorI,
        color: colorI,
        timer: time,
        allowOutsideClick: false,
    });
}

function swalConfirm($title){
  return Swal.fire({
      icon: 'warning',
      text: $title,
      background: 'linear-gradient(90deg, #ADC7DE, #C5E3FF)',
      iconColor: '#4658A7',
      color: '#4658A7',
      allowOutsideClick: false,
      confirmButtonColor: '#C6536C',
      confirmButtonText: 'CONFIRMAR',
      showCancelButton: true,
      cancelButtonText: 'CANCELAR',
      dangerMode: true,
  });
}

function limpiarSelect(selector){
  $("#"+selector).val('');
  $('#'+selector).val(null).trigger('change');
  return;
}

function limpiarMultiSelect(selector){
  $('#'+selector).val([]).multipleSelect("refresh");
}

function hideLoading() {
  swal.close();
}

$('.pmask').mask("#,##0", {
  reverse: true
});

$('.pmask2').mask("#,##0.00", {
  reverse: true
});

$('.pmask3').mask("##0", {
  reverse: true
});

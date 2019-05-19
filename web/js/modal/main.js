$("#mdConfirm").on('show.bs.modal', (e) => {
  const button = $(e.relatedTarget);
  const modal = $("#mdConfirm");


  let message = button.data('message');
  modal.find('#btn-delete').attr('href', button.data('url'));
  modal.find('.modal-body').html(`<p>${message}</p>`);
});

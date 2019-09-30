(function ($, window, document, undefined) {
  $(function () {
    //Here you can create your functions
    function filter_ajax() {
      $('#post-date-filter').submit(function () {
        var filter = $('#post-date-filter');
        $.ajax({
          url: filter.attr('action'),
          data: filter.serialize(), // данные формы
          type: filter.attr('method'), // POST
          beforeSend: function (xhr) {
            filter.find('button').text('Применяем фильтр...');
          },
          success: function (data) {
            filter.find('button').text('Применить фильтр');
            $('#filtering-results').html(data);
          }
        });
        return false;
      });
    }

    function init() {
      //Here you can call your functions
      filter_ajax();
    }

    init();

  });
})(jQuery, window, document);
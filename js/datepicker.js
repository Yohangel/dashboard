/*datepicker*/
$(function(){
        var dateFormat = "mm/dd/yy",
          from = $("#fecha")
            .datepicker({
              defaultDate: "+1w",
              changeMonth: true,
              changeYear: true
            })
            .on("change", function(){
              to.datepicker("option", "minDate", getDate(this));
            }),
          to = $("#fecha_entrega").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true
          })
          .on("change", function(){
            from.datepicker("option", "maxDate", getDate(this));
          });
     
        function getDate(element){
          var date;
          try {
            date = $.datepicker.parseDate(dateFormat, element.value);
          } catch(error) {
            date = null;
          }
          return date;
        }
      } );
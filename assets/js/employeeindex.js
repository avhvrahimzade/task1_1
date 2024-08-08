$(document).ready(function() {

  function performSearch() {
      let data = {
          query: $('#query').val(),
          min_salary: $('#min_salary').val(),
          max_salary: $('#max_salary').val(),
          position: $('#position').val()
      };

      $.ajax({
          url: 'employee/search',
          method: 'GET',
          data: data,
          success: function(response) {
              var data = JSON.parse(response);
              var employees = data.employees;
              var tbody = $('#employee-table-body');
              tbody.empty();

              if (employees.length > 0) {
                  $.each(employees, function(index, employee) {
                      var row = '<tr>' +
                          '<td>' + employee.id + '</td>' +
                          '<td>' + employee.name + '</td>' +
                          '<td>' + employee.surname + '</td>' +
                          '<td>' + employee.position + '</td>' +
                          '<td>' + employee.salary + '</td>' +
                          '</tr>';
                      tbody.append(row);
                  });
              } else {
                  var row = '<tr><td colspan="5" class="text-center">No employees found.</td></tr>';
                  tbody.append(row);
              }
          },
          error: function() {
              alert('Failed to fetch employees.');
          }
      });
  }

  $('#search-form').on('submit', function(event) {
      event.preventDefault();
      performSearch();
  });


  $(document).on('keyup', '#query, #min_salary, #max_salary, #position', function() {
      performSearch();
  });

  $('#query').autocomplete({
      source: function(request, response) {
          $.ajax({
              url: 'employee/autocomplete',
              type: "GET",
              data: {
                  query: request.term
              },
              success: function(data) {
                  response(JSON.parse(data));
              }
          });
      },
      minLength: 2
  });

});

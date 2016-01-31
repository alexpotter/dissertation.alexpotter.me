function enableDisableSpecialty(id, event, element, url, token) {
    event.preventDefault();

    var td = $(element).parent();
    var tr = $(td).parent();

    $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": token,
                "specialtyId": id
            }
        })
        .done(function(data) {
            pNotifyMessage('Success', 'Specialty has been updated', 'success');
            if (data.enabledOrDisabled == 'Disabled') {
                var disabled = 'Yes';
                var icon = '<i class="fa fa-times red"></i>';
            }
            else {
                var disabled = 'No';
                var icon = '<i class="fa fa-check green"></i>';
            }
            tr.html('<td>' + data.code + '</td><td>' + data.specialty + '</td><td>' + disabled + '</td><td><a href="#" onclick="enableDisableSpecialty(' + id +', event, this, \'' + data.url + '\', \'' + data.token + '\')">' + icon + '</a></td>');
        })
        .fail(function(jqXHR, status, thrownError) {
            var responseText = jQuery.parseJSON(jqXHR.responseText);
            pNotifyMessage('Something went wrong', responseText['error'], 'error');
        });
}
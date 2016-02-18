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
                var icon = '<i class="fa fa-times red"></i>';
            }
            else {
                var icon = '<i class="fa fa-check green"></i>';
            }
            tr.html('<td>' + data.specialty + '</td><td><a href="#" onclick="enableDisableSpecialty(' + id +', event, this, \'' + data.url + '\', \'' + data.token + '\')">' + icon + '</a></td>');
        })
        .fail(function(jqXHR, status, thrownError) {
            var responseText = jQuery.parseJSON(jqXHR.responseText);
            pNotifyMessage('Something went wrong', responseText['error'], 'error');
        });
}

function updateTimeLineMaxCluster(setting, event, url, token) {
    event.preventDefault();

    $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": token,
                "timeLineClusterMax": setting,
                "setting_code": "cluster_max"
            }
        })
        .done(function(data) {
            pNotifyMessage('Success', 'Timeline cluster max has been updated', 'success');
        })
        .fail(function(jqXHR, status, thrownError) {
            var responseText = jQuery.parseJSON(jqXHR.responseText);
            pNotifyMessage('Something went wrong', responseText['error'], 'error');
        });
}
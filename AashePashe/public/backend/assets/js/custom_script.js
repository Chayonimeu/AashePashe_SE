function get_city(id) {
    var country_id = id;
    if (country_id !== '') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "/get_city",
            dataType: 'json',
            data: {
                country_id: country_id
            },
            success: function (response) {
                var obj = response;
                if (obj.output === "success") {
                    var html = '<select class="form-control" id="city_id" name="city_id" required="required" onchange="javascript:get_sub_area(this.value);"><option value="">Select City</option>';
                    $.each(obj.data_list, function (key, Event) {
                        html += '<option value="' + Event.city_id + '">' + Event.name + '</option>';
                    });

                    html += '</select>';
                    $("#city_div").html(html);

                } else {
                    alert(obj.msg);
                }
            }
        });
    } else {
        alert('No data found');
    }
}

function get_sub_area(id) {
    var city_id = id;
    if (city_id !== '') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "/get_sub_area",
            dataType: 'json',
            data: {
                city_id: city_id
            },
            success: function (response) {
                var obj = response;
                if (obj.output === "success") {
                    var html = '<select class="form-control" id="sub_area_id" name="sub_area_id"><option value="">Select Sub Area</option>';
                    $.each(obj.data_list, function (key, Event) {
                        html += '<option value="' + Event.sub_area_id + '">' + Event.name + '</option>';
                    });

                    html += '</select>';
                    $("#sub_area_div").html(html);

                } else {
                    alert(obj.msg);
                }
            }
        });
    } else {
        alert('No data found');
    }
}
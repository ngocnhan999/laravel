$(document).ready(function () {
    $('.nav-button').hide();
    $('.nav-button').first().show()
    $('.active-tab').click((e) => {
        /*if (!validateForm('step-a', {username: 'Vui lòng nhập username', email: 'Vui lòng nhập email'})) {
            return
        }
        if (!validateForm('step-b', {tentruong: 'Vui lòng nhập tên trường'})) {
            return
        }

        if (!validateForm('step-c', {time: 'Vui lòng nhập thời gian'})) {
            return
        }

        if (!validateForm('step-d', {info: 'Vui lòng nhập thông tin'})) {
            return
        }

        if (!validateForm('step-e', {hoten: 'Vui lòng nhập họ tên'})) {
            return
        }

        if (!validateForm('step-f', {thongtinbanthan: 'Vui lòng nhập thông tin bản thân'})) {
            return
        }

        if (!validateForm('step-g', {diemmanhdiemyeu: 'Vui lòng nhập chia sẻ điểm mạnh, điểm yếu'})) {
            return
        }

        if (!validateForm('step-h', {tenquyhocbong: 'Vui lòng nhập tên quỷ học bổng'})) {
            return
        }

        if (!validateForm('step-i', {})) {
            return
        }

        if (!validateForm('step-j', {})) {
            return
        }*/

        // $('.nav-button').hide();
        /* setTimeout(() => {
            let classNameTarget = e.target.getAttribute("data-active-tab")
            let idTargetTabPanel = e.target.getAttribute("data-active-tab-panel")
            $('.nav-link').removeClass('active')
            $('.nav-link.' + classNameTarget).addClass('active')
            $('.tab-pane').removeClass('active')
            $('#' + idTargetTabPanel).removeClass('active')
            $('#' + idTargetTabPanel).addClass('active')
            $('.tab-pane').removeClass('show')
            $(window).scrollTop(0);

            let navItem = $('.nav-link.' + classNameTarget).parent('.nav-item')
            $('.nav-button').hide();
            $(navItem).find('div > .nav-button').show()

        }, 100)*/
    })

    /*$('.nav-item').click((event) => {
        let navItem = event.currentTarget
        $('.nav-button').hide();
        $(navItem).find('div > .nav-button').show()

    })*/

    // ham kiem tra form
    /*const validateForm = (idForm, dataValid) => {
        var form = $('#' + idForm);
        let rules = [], messages = [];


        for (key in dataValid) {

            rules[key] = {
                required: true
            }

            messages[key] = {
                required: dataValid[key]
            }


        }
        form.validate({
            errorElement: 'div',
            errorClass: 'error',
            highlight: function (element, errorClass, validClass) {
                $(element).closest('.form-group').addClass("has-error");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).closest('.form-group').removeClass("has-error");
            },
            rules: rules,
            messages: messages
        })
        return form.valid()
    }*/

    // them giai thuong
    $('#addReward').click(() => {
        if ($('.reward-col').length <= 4) {
            let addReward = "<tr class='reward-col'>";
            addReward += "<td><input type='text' class='form-control' name='achievements[name][]'/></td>";
            addReward += "<td><textarea  cols='50' rows='3' class='form-control' name='achievements[description][]'></textarea></td>";
            addReward += "<td class=\"text-center align-middle\"><a href=\"#\" class='removeRow'><i class=\"icon-trash-alt text-danger\"></i></a></td>";
            addReward += "</tr>"
            $('#reward').append(addReward);
        }
    })


    // them giai thuong DH
    $('#addRewardUni').click(() => {
        if ($('.reward-uni-col').length <= 4) {
            let addRewardUni = "<tr class='reward-uni-col'>";
            addRewardUni += "<td><input type='text' class='form-control' placeholder='Nhập tên giải thưởng' name='achievementsUni[name][]'/></td>";
            addRewardUni += "<td><textarea  cols='50' rows='3' class='form-control' name='achievementsUni[description][]'></textarea></td>"
            addRewardUni += "<td class=\"text-center align-middle\"><a href=\"#\" class=\"removeRow\"><i class=\"icon-trash-alt text-danger\"></i></a></td>";
            addRewardUni += "</tr>";
            $('#rewardUni').append(addRewardUni);
        }
    })


    // them diem thi TN THPT
    $('#addMark').click((evt) => {
        evt.preventDefault();
        swal("Thông báo!", "Cập nhật sau ngày 25/07/2022", "error");
        /*if ($('.mark-col').length <= 5) {
            let addMark = "<tr class='mark-col'>";
            addMark += "<td><input type='text' class='form-control' name='graduation_exam[subject][]'/></td>";
            addMark += "<td><input type='text' class='form-control' name='graduation_exam[score][]'/></td>";
            addMark += '<td class="text-center align-middle"><a href="#" class="removeRow"><i class="icon-trash-alt text-danger"></i></a></td>';
            addMark += "</tr>"
            $('#mark').append(addMark)
        }*/
    })

    //them ket qua học tập

    $('#addResult').click((evt) => {
        evt.preventDefault();
        swal("Thông báo!", "Cập nhật sau ngày 25/07/2022", "error");
        return;
        if ($('.result-col').length <= 4) {
            var count = 0;
            for (var i = 0; i <= $('.result-col').length; i++) {
                count = count + 1;
            }

            let addResult = '<tr class="result-col">';
            addResult += '<td><input type="text" class="form-control" name="candidate_universities[name][]"/></td>';
            addResult += '<td><input type="text" class="form-control" name="candidate_universities[major][]"/></td>';
            addResult += '<td><input type="text" class="form-control" name="candidate_universities[total_score][]"/></td>';
            addResult += '<td class="text-center">';
            addResult += '<select name="candidate_universities[is_accepted][]" class="form-control is_accepted" style="padding-left:2px">';
            addResult += '<option value="1">Đậu</option>';
            addResult += '<option value="0">Trượt</option>';
            addResult += '</select>';
            addResult += '</td>';
            addResult += '<td class="d-flex justify-content-center"><input type="checkbox" class="mt-2 is_applying" name="candidate_universities[is_applying][]" value="0"/></td>';
            addResult += '<td class="text-center align-middle"><a href="#" class="removeRow"><i class="icon-trash-alt text-danger"></i></a></td>';
            addResult += '</tr>';
            $('#result').append(addResult);
            formElements.init();
        }
    })

    //them kinh nghiệm

    $('#addExpWorking').click(() => {
        if ($('.exp-col').length <= 4) {
            let addExpWorking = '';
            addExpWorking += '<tr class="exp-col">';
            addExpWorking += '<td><input type="text" class="form-control datePicker" name="work_experiences[start_date][]"/></td>';
            addExpWorking += '<td><input type="text" class="form-control" name="work_experiences[position][]" /></td>';
            addExpWorking += '<td><textarea cols="50" rows="3" class="form-control" name="work_experiences[description][]" maxwords="50"></textarea><span class="error text-danger"></span></td>';
            addExpWorking += '<td>';
            addExpWorking += '<select class="form-control select2-basic" name="work_experiences[work_place][]">';
            $.each(provinces, function (index, value) {
                addExpWorking += '<option value="' + index + '">' + value + '</option>';
            });
            addExpWorking += '</select>';
            addExpWorking += '</td>';
            addExpWorking += '<td><input type="number" class="form-control" name="work_experiences[weekly_hours][]" /></td>';
            addExpWorking += '<td class="text-center align-middle"><a href="#" class="removeRow"><i class="icon-trash-alt text-danger"></i></a></td>';
            addExpWorking += '</tr>';
            $('#experience').append(addExpWorking);
            if ($('.datePicker').length > 0) {
                $('.datePicker').datepicker({
                    format: 'mm/yyyy',
                    endDate: '-1y',
                    autoclose: true,
                });
            }
        }
    })

    //them kinh nghiệm activity 2

    $('#addExperienceActivity').click(() => {
        if ($('.experience-activity-col').length <= 2) {
            let addExperienceActivity = '<tr class="experience-activity-col">';
            addExperienceActivity += '<td><input type="text" class="form-control datePicker" name="volunteer_experiences[start_date][]" /></td>';
            addExperienceActivity += '<td><input type="text" class="form-control" name="volunteer_experiences[title][]" /></td>';
            addExperienceActivity += '<td><textarea cols="50" rows="3" class="form-control" name="volunteer_experiences[description][]" maxwords="50"></textarea><span class="error text-danger"></span></td>';
            addExperienceActivity += '<td><input type="text" class="form-control" name="volunteer_experiences[position][]" /></td>';
            addExperienceActivity += '<td><input type="text" class="form-control" name="volunteer_experiences[reason][]" /></td>';
            addExperienceActivity += '<td class="text-center align-middle"><a href="#" class="removeRow"><i class="icon-trash-alt text-danger"></i></a></td>';
            addExperienceActivity += '</tr>';
            $('#experienceActivity').append(addExperienceActivity);
            if ($('.datePicker').length > 0) {
                $('.datePicker').datepicker({
                    format: 'mm/yyyy',
                    endDate: '-1y',
                    autoclose: true,
                });
            }
        }
    })

    //them thành viên gia đình

    $('#addMember').click(() => {
        if ($('.member-col').length <= 5) {
            let addMember = '<tr class="member-col">'
            addMember += '<td><input type="text" name="family_members[full_name][]" class="form-control"/></td>';
            addMember += '<td><input type="text" name="family_members[relationship][]" class="form-control"/></td>';
            addMember += '<td><input type="text" name="family_members[job][]" class="form-control"/></td>';
            addMember += '<td><input type="text" name="family_members[work_place][]" class="form-control"/></td>';
            addMember += '<td class="text-center align-middle"><a href="#" class="removeRow"><i class="icon-trash-alt text-danger"></i></a></td>';
            addMember += '</tr>';
            $('#memberFamily').append(addMember)
        }
    });

    $("#addScholarship").click(() => {
        let addScholarship = '<tr class="scholarship">'
            addScholarship += '<td><input type="text" name="scholarships[name][]" class="form-control"/></td>';
            addScholarship += '<td>';
            addScholarship += '<select name="scholarships[is_received][]" class="form-control">';
            addScholarship += '<option value="1">Đã nộp</option>';
            addScholarship += '<option value="2">Đang nộp</option>';
            addScholarship += '<option value="3">Đã nhận</option>';
            addScholarship += '</select>';
            addScholarship += '</td>';
            addScholarship += '<td><input type="text" name="scholarships[total_amount][]" class="form-control inputmask"  data-inputmask="\'alias\': \'numeric\', \'groupSeparator\': \'.\', \'prefix\' : \'\', \'autoGroup\': true, \'digits\': 2, \'digitsOptional\': true, \'suffix\': \'\', \'placeholder\': \'0\'"/></td>';
            addScholarship += '<td><input type="text" name="scholarships[received_amount][]" class="form-control inputmask" data-inputmask="\'alias\': \'numeric\', \'groupSeparator\': \'.\', \'prefix\' : \'\', \'autoGroup\': true, \'digits\': 2, \'digitsOptional\': true, \'suffix\': \'\', \'placeholder\': \'0\'"/></td>';
            addScholarship += '<td><input type="text" name="scholarships[remaining_amount][]" class="form-control inputmask" data-inputmask="\'alias\': \'numeric\', \'groupSeparator\': \'.\', \'prefix\' : \'\', \'autoGroup\': true, \'digits\': 2, \'digitsOptional\': true, \'suffix\': \'\', \'placeholder\': \'0\'"/></td>';
            addScholarship += '<td><input type="text" name="scholarships[note][]" class="form-control"/></td>';
            addScholarship += '<td class="text-center align-middle"><a href="#" class="removeRow"><i class="icon-trash-alt text-danger"></i></a></td>';
            addScholarship += '</tr>';
        $('#scholarship').append(addScholarship)
        if ($('.inputmask').length > 0) {
            $('.inputmask').inputmask();
        }
    });

    //add input in select
    $('#other-sex').hide();
    $('#sex').change(function () {
        if ($(this).val() == '3') {
            $('#other-sex').show();
        } else {
            $('#other-sex').hide();
        }
    });
});

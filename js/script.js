$(function () {
    $('#editProfileForm').on('submit',function (e) {
        e.preventDefault();
        let dataInfo = $( this ).serialize();
        $.ajax({
            url:"../process/editProfile.php",
            data:dataInfo,
            method:'POST',
            dataType:'json',
            success:function (r) {
                console.log(r);
                if (r.f_n_e){
                    $('#f_n_e').html(r.f_n_e)
                }
                else if (r.l_n_e) {
                    $('#l_n_e').html(r.l_n_e)
                }
                else if(r.cot_e){
                    $('#cot_e').html(r.cot_e)
                }
                else if (r.dat_e) {
                    $('#dat_e').html(r.dat_e)
                }    
               else if (r.e_e) {
                    $('#e_e').html(r.e_e)
                } 
                else if (r.p_e) {
                    $('#p_e').html(r.p_e)
                }  
                else if (r.success) {
                    console.log(r);
                    $('#FullName').html(`${r.first_name} ${r.last_name}`);
                    $('#country').html(`${r.country}`);
                    $('#masnagitutyun').html(`${r.masnagitutyun}`);
                    $('#date').html(`${r.date}`);
                    $('#email').html(`${r.email}`);
                    $('#age').html(`(${r.age} years old)`);
                    $('#password').html(`${r.password}`);
                    $('#EditProfile').modal('hide');
                }
            },
            error:function (e) {
                console.log(e);
            }
        })
    })
    $('#avatarInput').on('change',function (e) {
        let formData = new FormData();
        formData.append('avatar',e.target.files[0]);
        formData.append('old_avatar',document.getElementById('old_avatar').value);
        $.ajax({
            url:"../process/editAvatar.php",
            data:formData,
            method:'post',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success:function (res) {
                const img = $('<img>');
                img.addClass('img-fluid');
                img.attr({'src':'../img/users/'+res.img});
                $('#img').html(img);
                document.getElementById('old_avatar').value = res.img
            }

        })

    });
    $(".like").on('dblclick',function () {
        const postId = $(this).attr('data-postLike');
        $.ajax({
            url:"../process/post_like.php",
            data:{'post_id':postId},
            dataType:"json",
            method:'post',
            success: r => {
                if (r.success === 'ok') {
                    $(this).html('Like '+r.num);
                }
            }

        })
    });
    const users = [];

    $("#searchInp").on('click',function () {
        $.ajax({
            url:'../process/ajaxSearch.php',
            dataType:'json',
            success:function (r) {
                users.length = 0;
               if (r.success){
                   for (let i = 0; i < r.success.length; i++) {
                       users.push(r.success[i]);
                   }
               }
            }
        })
    });
    $( "#searchInp" ).autocomplete({
        source: users
    });
});
<script>

    const successNotification = window.createNotification({
        // close on click
        closeOnClick: true,

        // displays close button
        displayCloseButton: false,

        // nfc-top-left
        // nfc-bottom-right
        // nfc-bottom-left
        positionClass: 'nfc-top-right',

        // callback
        // onclick: true,

        // timeout in milliseconds
        showDuration: 3500,

        // success, info, warning, error, and none
        theme: 'success'
    });


    const errorNotification = window.createNotification({
        closeOnClick: true,
        displayCloseButton: false,
        positionClass: 'nfc-top-right',
        showDuration: 3500,
        theme: 'error'
    });




    //    delete message request
    function deleteMessage(ele ,id){
        if (id){
            $.ajax({
                method : "POST",
                url : '{{route('ajax.message.delete')}}',
                data : {
                    '_token' :' {{csrf_token()}}',
                    'id' : id,
                },
                success : function (data){
                    if (data.success){
                        $(ele).parent().parent().parent().remove();
                        successNotification({
                            title: 'Message',
                            message: 'Successfuly Deleted'
                        });
                    }
                },
                error : function (error){
                    errorNotification({
                        title: 'Message',
                        message: 'Error !!'
                    });
                }
            });
        }
    }



//    send pages data
    function pagesSubmit(event){
        event.preventDefault();
        $.ajax({
            method: 'POST',
            url: "{{route('pages.update')}}",
            data : {
                "_token" : "{{csrf_token()}}",
                "header_description" : $("textarea[name='header_description']").val(),
                "service_description" : $("textarea[name='service_description']").val(),
                "construction" : $("textarea[name='construction']").val(),
                "houseRenovation" : $("textarea[name='houseRenovation']").val(),
                "painting" : $("textarea[name='painting']").val(),
                "architectureDesign" : $("textarea[name='architectureDesign']").val(),
                "recentWorks" : $("textarea[name='recentWorks']").val(),
                "employees_description" : $("textarea[name='employees_description']").val(),
                "projectsPg_description" : $("textarea[name='projectsPg_description']").val(),
                "phone" : $("textarea[name='phone']").val(),
                "email" : $("textarea[name='email']").val(),
                "facebook" : $("textarea[name='facebook']").val(),
                "googlePlus" : $("textarea[name='googlePlus']").val(),
                "twitter" : $("textarea[name='twitter']").val(),
                "pinterest" : $("textarea[name='pinterest']").val(),
                "linkedIn" : $("textarea[name='linkedIn']").val(),
                "address" : $("textarea[name='address']").val(),

            },
            success : function (){
                successNotification({
                    title: 'Message',
                    message: 'Successfuly Updated'
                });
            },
            error : function (error){
                errorNotification({
                    title: 'Message',
                    message: error.responseJSON.message
                });
            }
        });

    }


//    delete about section
    function deleteAboutSection(ele ,id ,event){
        event.preventDefault();
        $.ajax({
            method: 'POST',
            url : "{{route('about.section.delete')}}",
            data : {
                '_token' : "{{csrf_token()}}",
                'id' : id
            },
            success : function (data){
                if (data.success){
                    successNotification({
                        title: 'Message',
                        message: 'Successfuly Deleted',
                    });
                    console.log(data);
                    $(ele).parent().remove();
                }
            },
            error : function (error){
                console.log(error);
            }

        });
    }

//    save the header of the project
    function projectHeaderSave(id ,event){
        event.preventDefault();
        let formData = new FormData(event.target);
        formData.append("id" , id);
        $.ajax({
            method : "POST",
            url : "{{route('project.header.save')}}",
            processData : false,
            cache : false,
            contentType : false,
            data : formData,
            success : function (data){
                if (data.success){
                    successNotification({
                        title: 'Message',
                        message: 'Successfuly Updated'
                    });
                }
            },
            error : function (error){
                console.log(error);
            }
        });
    }

//    delete project image
    function deleteProjectImage(ele ,id){
        $.ajax({
           method : "POST",
           url : "{{route('project.imgs.delete')}}",
           data:{
               "_token" : "{{csrf_token()}}",
               "id" : id,
           },
            success : function (data){
               if (data.success){
                   successNotification({
                       title: 'Message',
                       message: 'Successfuly Deleted'
                   });
                   $(ele).parent().parent().parent().remove();
               }
            }
        });
    }

//    add project image
    function addProjectImage(id ,event){
        event.preventDefault();
        let formData = new FormData(event.target);
        formData.append("id" ,id);
        $.ajax({
            method : 'POST',
            url : "{{route('project.imgs.save')}}",
            cache: false,
            processData: false,
            contentType: false,
            data : formData,
            success : function (data){
                if (data.success){

                    $("#project_imgs_cont").append("" +
                        "" +
                        "<tr>\n" +
                        "    <td>\n" +
                        "        <img src='{{asset('imgs/projects')}}/" + data.img + "' alt='img' >\n" +
                        "    </td>\n" +
                        "    <td>\n" +
                        "        <div class='sparkbar' data-color='#00a65a' data-height='20'>\n" +
                        "            <button onclick='deleteProjectImage(this ," + data.last_id + ");' class='btn btn-danger' >Delete</button>\n" +
                        "         </div>\n" +
                        "    </td>\n" +
                        "</tr>");

                    successNotification({
                        title: 'Message',
                        message: 'Successfuly Added'
                    });
                }
            },
            error : function (error){
                console.log(error);
            }
        });
    }


    function deleteSection(ele ,id){
        $.ajax({
           method:"POST",
           url : "{{route('project.section.delete')}}",
           data:{
               "_token" : "{{csrf_token()}}",
               "id" : id,
           } ,
            success : function (data){
               if (data.success){
                   $(ele).parent().parent().parent().remove();
                   successNotification({
                       title : 'Message',
                       message: 'Successfuly Deleted'
                   })
               }
            },
            error:function (error){
               console.log(error);
            }
        });
    }


    //delete employee
    function deleteEmployee(ele ,id){
        $.ajax({
           method:"POST",
           url : "{{route('delete.employee')}}",
           data:{
               "_token" : "{{csrf_token()}}",
               "id" : id,
           } ,
            success : function (data){
               if (data.success){
                   $(ele).parent().parent().parent().remove();
                   successNotification({
                       title : 'Message',
                       message: 'Successfuly Deleted'
                   })
               }
            },
            error:function (error){
               console.log(error);
            }
        });
    }

//    projects edit employees
    function projectEditEmployees(id ,event){
        event.preventDefault();
        let formData = new FormData(event.target);
        formData.append("id" ,id);
        $.ajax({
            method : "POST",
            url : "{{route('edit.project.employees')}}",
            cache:false,
            processData:false,
            contentType:false,
            data : formData,
            success : function (data){
                if (data.success){
                    successNotification({
                        title : 'Message',
                        message: 'Successfuly Updated'
                    });
                }
            },
            error:function (error){
                console.log(error);
            }
        });

    }



    function deleteProject(ele ,id){
        $.ajax({
            method:"POST",
            url : "{{route('project.delete')}}",
            data:{
                "_token" : "{{csrf_token()}}",
                "id" : id,
            } ,
            success : function (data){
                if (data.success){
                    $(ele).parent().parent().parent().remove();
                    successNotification({
                        title : 'Message',
                        message: 'Successfuly Deleted'
                    })
                }
            },
            error:function (error){
                console.log(error);
            }
        });
    }


</script>


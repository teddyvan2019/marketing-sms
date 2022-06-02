$(function(){

    $("#formCampagne").submit(function(e) {  
        e.preventDefault();
         
        $('input+small').text('');
        
        let nomCampagne = $('#libelle').val();
        let dateDebut = $('#dateDebut').val();
        let dateFin = $('#dateFin').val();
        if (nomCampagne == '')
        {
            alert('le nom de la campagne est obligatoire');
            return false;
        }
        if (dateDebut == '' > dateFin )
        {
            alert('La date de debut de la campagne est invalide');
            return false;
        }
        if (dateFin == '')
        {
            alert('La date de fin de la campagne est invalide');
            return false;
        }
        
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }) 
        .done(function(data) {
            window.location.reload();
        })
        .fail(function(data) { 
            console.log(data);
            if(data.responseJSON.errors)
            {
                $.each(data.responseJSON.errors, function (key, value) {
                    var input = '#formRepertoire input[name=' + key + ']';
                    $(input + '+small').text(value);
                    $(input).parent().css({"color":"red"});
                });
            }
            else
            {
                $('#error_add_manuel').removeAttr('hidden');
                $('#error_msg_add_manuel').html(data.responseJSON.message);
            }
           
        });
    });

    $("#formAddMessageCampagne").submit(function(e) {  
        e.preventDefault();
         
        $('input+small').text('');
        
        let dateEnvoi = $('#dateDebut').val();
        let repertoire = $('#repertoire').val();
        let dateDebutCampagne = $("#dateDebutCampagne").val();
        if (dateEnvoi == '')
        {
            alert('La date d\'envoi est obligatoire');
            return false;
        }
        else if(dateEnvoi < dateDebutCampagne)
        {
            alert('La date d\'envoi doit etre dans la periode de couverture de la campagne');
            return false;
        }

        if (repertoire == ''  )
        {
            alert('Veuillez selectionner le(s) repertoire(s)');
            return false;
        }

        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }) 
        .done(function(data) {
            window.location.reload();
        })
        .fail(function(data) { 
            console.log(data);
            if(data.responseJSON.errors)
            {
                $.each(data.responseJSON.errors, function (key, value) {
                    var input = '#formRepertoire input[name=' + key + ']';
                    $(input + '+small').text(value);
                    $(input).parent().css({"color":"red"});
                });
            }
            else
            {
                $('#error_add_manuel').removeAttr('hidden');
                $('#error_msg_add_manuel').html(data.responseJSON.message);
            }
           
        });
    });

    $("#formImportFileContact").submit(function(e) {  
        e.preventDefault();
         
        $('input+small').text('');
         
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        })
        .done(function(data) {
            window.location.reload();
        })
        .fail(function(data) { 
            console.log(data);
            if(data.responseJSON.errors)
            {
                $.each(data.responseJSON.errors, function (key, value) {
                    var input = '#formImportFileContact input[name=' + key + ']';
                    $(input + '+small').text(value);
                    $(input).parent().css({"color":"red"});
                });
            }
            else
            {
                $('#error_add_manuel').removeAttr('hidden');
                $('#error_msg_add_manuel').html(data.responseJSON.message);
            }
           
        });
    });

    // var jq = jQuery.noConflict() ;
    //ouverture boite modal formulaire ajout contact
    // $(".add_manual_contact").click(function(){
    //     //recuperer l'id du repertoire
    //     id_repertoire = $(this).attr('value');
    //     console.log('id :' +id_repertoire);

    //     $('#ajouter_contact').modal('toggle') ;               // initializes and invokes show immediately
    // });

});
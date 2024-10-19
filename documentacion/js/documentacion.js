$(document).ready(function() {
    // Aquí puedes agregar scripts personalizados
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true
    });

    // Muestra capacidades segun la competencia en documentacion
    $('select[id^="competencia"]').on('change', function() {
        var id = $(this).attr('id').replace('competencia', ''); // ID del campo actual
        var competencia = $(this).val(); // Valor de la competencia seleccionada
        
        if (competencia) {
            $.ajax({
                url: 'https://academico.sansebastian.edu.pe/docentes/consultasajax.php',
                type: 'POST',
                data: { competencia: competencia },
                dataType: 'json', // Espera una respuesta en formato JSON
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        $('#capacidad' + id).html('<option value="">Seleccionar</option>');
                    } else {
                        var options = '<option value="">Seleccionar</option>';
                        $.each(response, function(index, value) {
                            options += '<option value="' + value.id + '">' + value.capacidad + '</option>';
                        });
                        $('#capacidad' + id).html(options);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', status, error);
                    $('#capacidad' + id).html('<option value="">Seleccionar</option>');
                }
            });
        } else {
            $('#capacidad' + id).html('<option value="">Seleccionar</option>');
        }
    });

    // Muestra capacidades segun la competencia en evaluacion
    $('select[id^="competencia_evaluacion"]').on('change', function() {
        var id = $(this).attr('id').replace('competencia_evaluacion', ''); // ID del campo actual
        var competencia = $(this).val(); // Valor de la competencia seleccionada
        if (competencia) {
            $.ajax({
                url: 'https://academico.sansebastian.edu.pe/docentes/consultasajax.php',
                type: 'POST',
                data: { competencia: competencia },
                dataType: 'json', // Espera una respuesta en formato JSON
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        $('#capacidades_evaluacion' + id).html('<option value="">Seleccionar</option>');
                    } else {
                        var options = '<option value="">Seleccionar</option>';
                        $.each(response, function(index, value) {
                            options += '<option value="' + value.id + '">' + value.capacidad + '</option>';
                        });
                        console.log('#capacidades_evaluacion' + id);
                        $('#capacidades_evaluacion' + id).html(options);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', status, error);
                    $('#capacidades_evaluacion' + id).html('<option value="">Seleccionar</option>');
                }
            });
        } else {
            $('#capacidades_evaluacion' + id).html('<option value="">Seleccionar</option>');
        }
    });

    // Muestra los valores segun el ENFOQUE
    $('select[id^="enfoque"]').on('change', function() {
        var id = $(this).attr('id').replace('enfoque', ''); 
        var enfoque = $(this).val(); 
        var valorSelectId = '#valor' + id; 
        if (enfoque) {
            $.ajax({
                url: 'https://academico.sansebastian.edu.pe/docentes/consultasajax.php',
                type: 'POST',
                data: { enfoque: enfoque },
                dataType: 'json', // Espera una respuesta en formato JSON
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        $(valorSelectId).html('<option value="">Seleccionar</option>');
                    } else {
                        var options = '<option value="">Seleccionar</option>';
                        $.each(response, function(index, value) {
                            options += '<option value="' + value.id + '">' + value.valor + '</option>';
                        });
                        $(valorSelectId).html(options);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', status, error);
                    $(valorSelectId).html('<option value="">Seleccionar</option>');
                }
            });
        } else {
            $(valorSelectId).html('<option value="">Seleccionar</option>');
        }
    });

    // Muestra los acciones segun el VALORES
    $('select[id^="valor"]').on('change', function() {
        var id = $(this).attr('id').replace('valor', ''); // ID del campo actual
        var valor = $(this).val(); // Valor de la opción seleccionada
        // Asegúrate de que `#capacidad` es el id del select que quieres actualizar
        var accionSelectId = '#acciones' + id; 
        if (valor) {
            $.ajax({
                url: 'https://academico.sansebastian.edu.pe/docentes/consultasajax.php',
                type: 'POST',
                data: { valor: valor },
                dataType: 'json', // Espera una respuesta en formato JSON
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        $(accionSelectId).html('<option value="">Seleccionar</option>');
                    } else {
                        var options = '<option value="">Seleccionar</option>';
                        $.each(response, function(index, value) {
                            options += '<option value="' + value.id + '">' + value.accion + '</option>';
                        });
                        $(accionSelectId).html(options);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', status, error);
                    $(accionSelectId).html('<option value="">Seleccionar</option>');
                }
            });
        } else {
            $(accionSelectId).html('<option value="">Seleccionar</option>');
        }
    });

    // Guardar Propósito de Aprendizaje
    $('.btn-save-proposito').on('click', function() {
        var id = $(this).data('id');
        var container = $('#collapse' + id + '-1');
    
        var data = {
            acciontipo: 'guardaProposito',
            nsesiones: container.find('#nsesiones' + id).val(),
            fecha_inicio: container.find('#startDate' + id).val(),
            fecha_fin: container.find('#endDate' + id).val(),
            competencias: {
                1: {
                    competencia: container.find('#competencia' + id + '1').val(),
                    capacidad: container.find('#capacidad' + id + '1').val(),
                    desempeno: container.find('#desempeno' + id + '1').val()
                },
                2: {
                    competencia: container.find('#competencia' + id + '2').val(),
                    capacidad: container.find('#capacidad' + id + '2').val(),
                    desempeno: container.find('#desempeno' + id + '2').val()
                },
                3: {
                    competencia: container.find('#competencia' + id + '3').val(),
                    capacidad: container.find('#capacidad' + id + '3').val(),
                    desempeno: container.find('#desempeno' + id + '3').val()
                }
            },
            enfoque: container.find('#enfoque' + id).val(),
            valor: container.find('#valor' + id).val(),
            acciones: container.find('#acciones' + id).val(),
            evidencia_aprendizaje: container.find('#evidencia' + id).val(),
            actitud_observable: container.find('#actitudes' + id).val(),
            proposito: container.find('#proposito' + id).val(),
            datos_ocultos: {
                courseid: container.find('#courseid' + id).val(),
                userid: container.find('#userid' + id).val(),
                bimestre: container.find('#bimestre' + id).val(),
                seccion: container.find('#seccion' + id).val()
            }
        };
        $.ajax({
            url: 'https://academico.sansebastian.edu.pe/docentes/backdocumentacion.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                console.log(response); // Verifica la respuesta en la consola
                if (response.status === 'success') {
                    alert(response.message);
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error:', textStatus, errorThrown);
            }
        });
        window.location.reload();
    });

    $('.btn-update-proposito').on('click', function() {
        var id = $(this).data('id');
        var container = $('#collapse' + id + '-1');
        var data = {
            acciontipo: 'updateProposito',
            nsesiones: container.find('#nsesiones' + id).val(),
            fecha_inicio: container.find('#startDate' + id).val(),
            fecha_fin: container.find('#endDate' + id).val(),
            competencias: {
                1: {
                    competencia: container.find('#competencia' + id + '1').val(),
                    capacidad: container.find('#capacidad' + id + '1').val(),
                    desempeno: container.find('#desempeno' + id + '1').val()
                },
                2: {
                    competencia: container.find('#competencia' + id + '2').val(),
                    capacidad: container.find('#capacidad' + id + '2').val(),
                    desempeno: container.find('#desempeno' + id + '2').val()
                },
                3: {
                    competencia: container.find('#competencia' + id + '3').val(),
                    capacidad: container.find('#capacidad' + id + '3').val(),
                    desempeno: container.find('#desempeno' + id + '3').val()
                }
            },
            enfoque: container.find('#enfoque' + id).val(),
            valor: container.find('#valor' + id).val(),
            acciones: container.find('#acciones' + id).val(),
            evidencia_aprendizaje: container.find('#evidencia' + id).val(),
            actitud_observable: container.find('#actitudes' + id).val(),
            proposito: container.find('#proposito' + id).val(),
            datos_ocultos: {
                courseid: container.find('#courseid' + id).val(),
                userid: container.find('#userid' + id).val(),
                bimestre: container.find('#bimestre' + id).val(),
                seccion: container.find('#seccion' + id).val()
            }
        };
        /*
        console.log("Enviando....");
        console.log(data);
        console.log("...Fin del envio");
        console.log("recibiendo...");
        */
        $.ajax({
            url: 'https://academico.sansebastian.edu.pe/docentes/backdocumentacion.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                console.log(response); // Verifica la respuesta en la consola
                if (response.status === 'success') {
                    alert(response.message);
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error:', textStatus, errorThrown);
            }
        });
        window.location.reload();
    });
    
    // Guardar Evaluación
    $('.btn-save-evaluacion').on('click', function() {
        var id = $(this).data('id');
        var container = $('#collapse' + id + '-2');
        
        // Crear el objeto principal para enviar
        var data = {
            acciontipo: "guardaEvaluacion",
            cursoid: container.find('#courseid' + id).val(),
            docente_id: container.find('#userid' + id).val(),
            evaluaciones: {},
            bimestre: container.find('#bimestre' + id).val(),
            sesion: container.find('#seccion' + id).val(),
            alumnoid: {}
        };
        
        // Rellenar las evaluaciones con los datos
        for (var i = 1; i <= 3; i++) {
            data.evaluaciones[i] = {
                competencia: container.find('#competencia_evaluacion' + id + i).val(),
                capacidad: container.find('#capacidades_evaluacion' + id + i).val(),
                desempeno: container.find('#desempeno_evaluacion' + id + i).val()
            };
        }
    
        // Rellenar notas de alumnos 
        data.alumnoid = {};
        container.find('tbody tr').each(function(index) {
            var row = $(this);
            var studentId = index + 1; // Suponiendo que los IDs de los alumnos empiezan en 1
            
            // Inicializar el objeto para cada alumno si no existe
            if (!data.alumnoid[studentId]) {

                //var valoraciones= row.find('input[name="valoracion' + studentId + '"]:checked').val();
                data.alumnoid[studentId] = {
                    alumnoid: container.find('#alumnoid'+studentId).val(), // Puede que necesites adaptar esto si el ID del alumno es diferente
                    valoraciones: row.find('input[name="valoracion' + studentId + '"]:checked').val(),
                    comentarios:  row.find('input[name="valoracion' + studentId + '"]:checked').val()
                };
            }
    
            // Asignar las valoraciones y comentarios del alumno
            data.alumnoid[studentId].valoraciones = row.find('input[name="valoracion' + studentId + '"]:checked').val();
            data.alumnoid[studentId].comentarios = row.find('textarea[name="comentarios' + studentId + '"]').val();
        });

        //console.log(data);
        // Enviar los datos a través de AJAX
        $.ajax({
            url: 'https://academico.sansebastian.edu.pe/docentes/backdocumentacion.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                alert('Evaluación guardada exitosamente');
                console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error:', textStatus, errorThrown);
            }
        });
        window.location.reload();
    });

    // Actualizacion Evaluación
    
    $('.btn-update-evaluacion').on('click', function() {
        var id = $(this).data('id');
        var container = $('#collapse' + id + '-2');
        
        // Crear el objeto principal para enviar
        var data = {
            acciontipo: "updateEvaluacion",
            cursoid: container.find('#courseid' + id).val(),
            docente_id: container.find('#userid' + id).val(),
            evaluaciones: {},
            bimestre: container.find('#bimestre' + id).val(),
            sesion: container.find('#seccion' + id).val(),
            alumnoid: {}
        };
        
        // Rellenar las evaluaciones con los datos
        for (var i = 1; i <= 3; i++) {
            data.evaluaciones[i] = {
                competencia: container.find('#competencia_evaluacion' + id + i).val(),
                capacidad: container.find('#capacidades_evaluacion' + id + i).val(),
                desempeno: container.find('#desempeno_evaluacion' + id + i).val()
            };
        }
    
        // Rellenar notas de alumnos 
        data.alumnoid = {};
        container.find('tbody tr').each(function(index) {
            var row = $(this);
            var studentId = index + 1; // Suponiendo que los IDs de los alumnos empiezan en 1
            
            // Inicializar el objeto para cada alumno si no existe
            if (!data.alumnoid[studentId]) {

                //var valoraciones= row.find('input[name="valoracion' + studentId + '"]:checked').val();
                data.alumnoid[studentId] = {
                    alumnoid: container.find('#alumnoid'+studentId).val(), // Puede que necesites adaptar esto si el ID del alumno es diferente
                    valoraciones: row.find('input[name="valoracion' + studentId + '"]:checked').val(),
                    comentarios:  row.find('input[name="valoracion' + studentId + '"]:checked').val()
                };
            }
    
            // Asignar las valoraciones y comentarios del alumno
            data.alumnoid[studentId].valoraciones = row.find('input[name="valoracion' + studentId + '"]:checked').val();
            data.alumnoid[studentId].comentarios = row.find('textarea[name="comentarios' + studentId + '"]').val();
        });

        console.log(data);
        console.log("***************************");
        // Enviar los datos a través de AJAX
        $.ajax({
            url: 'https://academico.sansebastian.edu.pe/docentes/backdocumentacion.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                alert(response.message);
                console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error:', textStatus, errorThrown);
            }
        });
    });

});
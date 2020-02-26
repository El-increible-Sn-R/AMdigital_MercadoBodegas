<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table align="center" border="0" 
        cellpadding="0" cellspacing="0" width="600" 
        style="border-collapse: collapse;">
        <tr>
            <td align="center" bgcolor="#FE6C30" style="padding-top:0px; 
            padding-right:0; padding-bottom:0px; padding-left:0;">
                
                <img src="http://amdigital.tech/static/imagenes/mb.png" 
                alt="Creating Email Magic" width="300" 
                height="130" style="display: block;" />

            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="padding: 20px 30px 20px 30px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td>
                            <center>
                                <p>Codigo de confirmacion: <b>{{$datosNecesarios->codigoConfirmacion}}</b> </p>
                                <p>Fecha de mudanza: <b>{{$datosNecesarios->fechaMudanza}}</b></p>
								<p>Horario de Acceso: <b>{{$datosNecesarios->horarioDeAcceso}}</b></p>
                            </center>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td width="260" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            
                                            <tr>
                                                <td style="padding: 10px 0 0 0;">
                                                    <p>Datos de la unidad alquilada:</p>
													<div>
														<p>Precio Mensual:<b>{{$datosNecesarios->datosDeLaUnidad->unidad_precioMensual}}</b></p>
														<p>Area de la unidad:<b>{{$datosNecesarios->datosDeLaUnidad->unidad_area}}</b></p>
														<p>Oferta de la unidad:<b>{{$datosNecesarios->datosDeLaUnidad->unidad_oferta}}</b></p>   
													</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="font-size: 0; line-height: 0;" width="20"><!---->
                                        &nbsp;
                                    </td>
                                    <td width="260" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            
                                            <tr>
                                                <td style="padding: 10px 0 0 0;">
                                                    <p>Datos del local:</p>
													<div>
													    <p>Nombre del local:<b>{{$datosNecesarios->datosDelLocal->local_nombre}}</b></p>
													    <p>Descripcion:<b>{{$datosNecesarios->datosDelLocal->local_descripcion}}</b></p>
													    <p>Telefono de contacto:<b>{{$datosNecesarios->datosDelLocal->local_telefono}}</b></p>
													    <p>correo de contacto:<b>{{$datosNecesarios->datosDelLocal->local_email}}</b></p>
													    <p>direccion:<b>{{$datosNecesarios->datosDelLocal->local_direccion}}</b></p>
													</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#FE6C30" style="padding-top:30px; 
            padding-right:0; padding-bottom:0px; padding-left:0;">
            </td>
        </tr>
    </table>
</body>
</html>






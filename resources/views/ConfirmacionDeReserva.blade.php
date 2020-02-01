<p>Código de confirmación:</p>
<p><b>{{$datosNecesarios->codigoConfirmacion}}</b></p>
<p>Fecha de mudanza :</p>
<p><b>{{$datosNecesarios->fechaMudanza}}</b></p>
<p>Horario de Acceso: </p>
<p><b>{{$datosNecesarios->horarioDeAcceso}}</b></p>
<p>Datos de la unidad alquilada:</p>
<div>
    <p>Precio Mensual:<b>{{$datosNecesarios->datosDeLaUnidad->unidad_precioMensual}}</b></p>
    <p>Area de la unidad:<b>{{$datosNecesarios->datosDeLaUnidad->unidad_area}}</b></p>
    <p>Oferta de la unidad:<b>{{$datosNecesarios->datosDeLaUnidad->unidad_oferta}}</b></p>   
</div>
<p>Datos del local:</p>
<div>
    <p>Nombre del local:<b>{{$datosNecesarios->datosDelLocal->local_nombre}}</b></p>
    <p>Descripcion:<b>{{$datosNecesarios->datosDelLocal->local_descripcion}}</b></p>
    <p>Telefono de contacto:<b>{{$datosNecesarios->datosDelLocal->local_telefono}}</b></p>
    <p>correo de contacto:<b>{{$datosNecesarios->datosDelLocal->local_email}}</b></p>
    <p>direccion:<b>{{$datosNecesarios->datosDelLocal->local_direccion}}</b></p>
    <p>ventana de reserva:<b>{{$datosNecesarios->datosDelLocal->local_nDiasDeReserva}}</b></p>
</div>
<table>

    <thead>
        <tr>
            <th>Nombre del Proovedor</th>
            <th>Nombre del Proovedor</th>
            <th>Nombre del Proovedor</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $item)
            <tr>
                <td>Id del proovedor: {{$item->id_proovedor}}</td>
                <td>Nombre del proovedor: {{$item->nombre_proovedor}}</td>
                <td>Email de proovedor: {{$item->email_proovedor}}</td>
            </tr>
            <tr>
                <td>Id del Empleado: {{$item->id_empleado}}</td>
                <td>Nombre del proovedor: {{$item->nombre_empleado}}</td>
            </tr>
        @endforeach
    </tbody>

</table>

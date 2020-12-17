<section><h1>Mantenimiento de Libros</h1></section>
<hr /></section>
<section>
    <table>
        <thead>
            <tr>
                <th>
                    Codigo
                </th>
                 <th>
                    Nombre
                </th> 
                <th>
                    Fecha 
                </th> 
                <th>
                    Autor
                </th> 
                <th>
                    Tipo
                </th> 
                <th>
                    codigo de libro
                </th> 
                <th>
                    <a class="btn depth-1 s-margin" href="index.php?page=examenform&mode=INS&book_cod=0">
                    <span class="ion-plus-circled"> </span>
                    </a>
                </th>                   
            </tr>
        </thead>
        <tbody>
            {{foreach books}}
             <tr>
                <td>
                    {{book_id}}
                </td>
                <td>
                  {{book_name}}
                </td>
                <td>
                  {{book_date}}
                </td>
                <td>
                  {{book_author}}
                </td>
                <td>
                  {{book_type}}
                </td>
                <td>
                  {{book_barcode}}
                </td>
                <td class="center">
                    <a class="btn depth-1 s-margin" href="index.php?page=examenform&mode=UPD&bookcod={{book_id}}">
                    <span class="ion-edit"> </span>
                    </a> &nbsp;
                    <a class="btn depth-1 s-margin" href="index.php?page=examenform&mode=DSP&bookcod={{book_id}}">
                    <span class="ion-eye"> </span>
                    </a>&nbsp;
                    <a class="btn depth-1 s-margin" href="index.php?page=examenform&mode=DEL&bookcod={{book_id}}">
                    <span class="ion-trash-a"> </span>
                    </a>
                </td>             
            </tr>
            {{endfor books}}
            </tbody>
            <tfoot>
        </tfoot>
    </table>
</section>

<h1>Trabajando con las vistas de mnt de Libros</h1>
<h1>{{modedsc}}</h1>
<section>
  <form method="post" action="index.php?page=examenform&mode={{mode}}&bookcod={{bookcod}}">
    <input type="hidden" name="mode" value="{{mode}}"/>
    <input type="hidden" name="bookcod" value="{{book_id}}"/>
    <input type="hidden" name="xsstoken" value="{{xsstoken}}"/>
    <div>
    <label for="booknom">Nombre del Libro</label>
    <input {{readonly}} type="text" name="booknom" id="book_name" value="{{book_name}}" placeholder="Nombre del Libro" />
    </div>
    <div>
    <label for="bookdate">fecha del libro</label>
    <input {{readonly}} type="date" name="bookdate" id="bookdate" value="{{book_date}}" />
    </div>
    <div>
      <label for="bookauthor">Autor del libro</label>
      <select name="bookauthor" id="bookauthor" {{readonly}}>
        <option value="FEM" {{book_author}}>Femenino</option>
        <option value="MASC" {{book_author}}>Masculino</option>
      </select>
    </div>
    <div>
      <label for="booktype">Tipo de libro</label>
      <input {{readonly}} type="text" name="book_type" id="booktype" value="{{book_type}}" placeholder="Tipo de libro" />
    </div>
    <div>
      <label for="bookbarcode">Codigo de barraas del libro</label>
      <input {{readonly}} type="text" name="bookbarcode" id="bookbarcode" value="{{book_barcode}}" placeholder="Codigo de barras del libro" />
    </div>   
    <div>
      <label for="bookesta">Estado del libro</label>
      <select name="bookesta" id="bookesta" {{readonly}}>
        <option value="ACT" {{bookesta_ACT}}>Activo</option>
        <option value="INA" {{bookesta_INA}}>Inactivo</option>
      </select>
    </div>
    {{if deletemsg}}
      <div class="alert">
        {{deletemsg}}
      </div>
    {{endif deletemsg}}
    <button id="btnsubmit" name="btnsubmit" type="submit">Enviar</button>
    <button id="btncancel">Cancelar</button>
  </form>
</section>

<script>
  $().ready(function(){
    $("#btncancel").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      location.assign("index.php?page=examenlist");
    });
  });
</script>

<doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Sistema de Customers</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../assets/css/sistema.css" rel="stylesheet">

  </head>
  <body>
        
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <!-- TÍTULO PRINCIPAL -->  
  <h2>Listagem de Customers</h2>
    
    <!-- ÁREA DOS TOTAIS -->
    <div id="totais">
    </div>
    
    <!-- ÁREA DA TABELA -->
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>E-mail</th>
            <th>Gender</th>
            <th>IP Address</th>
          </tr>
        </thead>
        <!-- ÁREA ONDE VÃO OS DADOS CAPTURADOS DO BANCO -->
        <tbody id="tbodyCustomers">

        </tbody>
      </table>
    </div>
  </main>
      
    <!-- IMPORTAÇÃO DO JS, AJAX E JS DO BOOTSTRAP -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <!-- SCRIPTS JS -->
    <script type="text/javascript">
      // CARREGAR OS DADOS QUANDO A PÁGINA CARREGA
      $(document).ready(function() {
        listar();
        filtros();
      });

      //FUNÇÃO PARA LISTAR OS CUSTOMERS
      function listar() {
        $.ajax({
          type: 'POST',
          url: '../controller/selecionar_costumer.php',
          dataType: 'HTML',
          data: {
          },
          success: function(retorno) {
            $('#tbodyCustomers').html(retorno);
          }
        }).fail(function(jqXHR, textStatus, erro) {
          alert(textStatus + ' ' + erro);
        });
      }

      //FUNÇÃO PARA EFETUAR OS FILTROS
      function filtros() {
        $.ajax({
          type: 'POST',
          url: '../controller/filtros.php',
          dataType: 'HTML',
          data: {
          },
          success: function(retorno) {
            $('#totais').html(retorno);
          }
        }).fail(function(jqXHR, textStatus, erro) {
          alert(textStatus + ' ' + erro);
        });
      }
    </script>
  </body>
</html>

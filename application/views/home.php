<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Aplikasi Toko Buku</title>
  
  <!-- favicon -->
  <link rel="shortcut icon" href="assets/img/favicon.png">

  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/datepicker.min.css" rel="stylesheet">
  
  <!-- styles -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Fungsi untuk membatasi karakter yang diinputkan -->
  <script language="javascript">
    function getkey(e)
    {
      if (window.event)
        return window.event.keyCode;
      else if (e)
        return e.which;
      else
        return null;
    }

    function goodchars(e, goods, field)
    {
      var key, keychar;
      key = getkey(e);
      if (key == null) return true;
      
      keychar = String.fromCharCode(key);
      keychar = keychar.toLowerCase();
      goods = goods.toLowerCase();
      
        // check goodkeys
        if (goods.indexOf(keychar) != -1)
          return true;
        // control keys
        if ( key==null || key==0 || key==8 || key==9 || key==27 )
          return true;
        
        if (key == 13) {
          var i;
          for (i = 0; i < field.form.elements.length; i++)
            if (field == field.form.elements[i])
              break;
            i = (i + 1) % field.form.elements.length;
            field.form.elements[i].focus();
            return false;
          };
        // else return false
        return false;
      }
    </script>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand -->
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">
            <i class="glyphicon glyphicon-check"></i>
            Aplikasi Toko Buku
          </a>
        </div>
      </div> <!-- /.container-fluid -->
    </nav>

    <div class="container-fluid">
     <?php 
     if (isset($_POST['cari'])) {
     $cari = $_POST['cari'];
   } else {
   $cari = "";
 }
 ?>

 <div class="row">
  <div class="col-md-12">
    <div class="page-header">
      <h4>
        <i class="glyphicon glyphicon-user"></i> Data Buku
        <a class="btn btn-info" href="?page=data-buku">
          <i class="glyphicon glyphicon-book"></i> Olah data buku
        </a>
        <a class="btn btn-info" href="?page=data-penerbit">
          <i class="glyphicon glyphicon-book"></i> Olah data penerbit
        </a>
        <div class="pull-right btn-tambah">
          <form class="form-inline" method="POST" action="index.php">
            <table>
              <tr>
                <td>&nbsp;</td>
                <td><label for="tcari"></label>

                  <input type="text" class="form-control" name="tcari" id="tcari" placeholder="Cari nama buku ..." value="<?php echo $cari; ?>">
                  <td><input class="btn btn-info"  type="submit" name="button" id="button" value="Cari"></td>
                </tr>
              </table> 
             <!--  <a class="btn btn-info" href="?page=tambah">
                <i class="glyphicon glyphicon-plus"></i> Tambah
              </a> -->
            </form>
          </div>  
        </h4>
      </div>

      <?php  
      if (empty($_GET['alert'])) {
      echo "";
    } elseif ($_GET['alert'] == 1) {
    echo "<div class='alert alert-danger alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      <strong><i class='glyphicon glyphicon-alert'></i> Gagal!</strong> Terjadi kesalahan.
    </div>";
  } elseif ($_GET['alert'] == 2) {
  echo "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data buku berhasil disimpan.
  </div>";
} elseif ($_GET['alert'] == 3) {
echo "<div class='alert alert-success alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
  <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data buku berhasil diubah.
</div>";
} elseif ($_GET['alert'] == 4) {
echo "<div class='alert alert-success alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
  <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data buku berhasil dihapus.
</div>";
}
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Data Buku</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table id="dataTables-example" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th>ID Buku</th>
            <th>Kategori</th>
            <th>Nama Buku</th>
            <th>Pengarang Buku</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Penerbit</th>
            <!-- <th>Aksi</th> -->
          </tr>
        </thead>
        <tbody>
          <?php
          if( ! empty($buku)){ // Jika data buku tidak sama dengan kosong, artinya jika data buku ada
          foreach($buku as $data){
          echo "<tr>
            <td>".$data->id_buku."</td>
            <td>".$data->kategori."</td>
            <td>".$data->nama_buku."</td>
            <td>".$data->pengarang_buku."</td>
            <td>".$data->harga."</td>
            <td>".$data->stok."</td>
            <td>".$data->penerbit."</td>
          </tr>";
        }
      }else{ // Jika data siswa kosong
      echo "<tr><td align='center' colspan='7'>Data Tidak Ada</td></tr>";
    }
    ?>
  </tbody>
</table>
</div>
</div>
</div> <!-- /.panel -->
</div> <!-- /.col -->
</div> <!-- /.row -->
</div> <!-- /.container-fluid -->

<footer class="footer">
  <div class="container-fluid">
    <p class="text-muted pull-right ">Theme by <a href="http://www.getbootstrap.com" target="_blank">Bootstrap</a></p>
  </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
  $(function () {

        //datepicker plugin
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        });

        // toolip
        $('[data-toggle="tooltip"]').tooltip();
      })
    </script>
  </body>
  </html>